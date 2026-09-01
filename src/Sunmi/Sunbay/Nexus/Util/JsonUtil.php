<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Util;

use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;

/**
 * JSON utility class
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class JsonUtil
{
    /**
     * Convert object to JSON string
     *
     * @param mixed $obj object
     * @return string|null JSON string
     */
    public static function toJson($obj): ?string
    {
        if ($obj === null) {
            return null;
        }

        // Convert object to array recursively
        $array = self::objectToArray($obj);

        $json = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            $error = json_last_error_msg();
            throw new SunbayBusinessException(
                'C17',
                "Failed to serialize object to JSON: {$error}",
                null
            );
        }

        return $json;
    }

    /**
     * Convert object to array recursively
     *
     * @param mixed $obj object
     * @return mixed array
     */
    private static function objectToArray($obj)
    {
        if (is_object($obj)) {
            if ($obj instanceof \BackedEnum) {
                return $obj->value;
            }
            if ($obj instanceof \UnitEnum) {
                return $obj->name;
            }
            $result = [];
            $reflection = new \ReflectionClass($obj);
            
            // Get all properties (including private/protected)
            foreach ($reflection->getProperties() as $property) {
                $value = $property->getValue($obj);
                
                // Skip null values (optional fields)
                if ($value === null) {
                    continue;
                }
                
                $propertyName = $property->getName();
                $result[$propertyName] = self::objectToArray($value);
            }
            
            return $result;
        }

        if (is_array($obj)) {
            $result = [];
            foreach ($obj as $key => $value) {
                $result[$key] = self::objectToArray($value);
            }
            return $result;
        }

        return $obj;
    }

    /**
     * Parse JSON string to object
     *
     * @param string|null $json JSON string
     * @param string $className target class name
     * @return mixed object
     */
    public static function fromJson(?string $json, string $className)
    {
        if ($json === null || $json === '') {
            return null;
        }

        $data = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg();
            throw new SunbayBusinessException(
                'C17',
                "Failed to parse JSON to object: {$error}",
                null
            );
        }

        if ($data === null) {
            return null;
        }

        return self::fromArray($data, $className);
    }

    /**
     * Convert associative array to typed object
     *
     * @param array $data associative array
     * @param string $className target class name
     * @return mixed object
     */
    public static function fromArray(array $data, string $className)
    {
        $object = new $className();
        $reflection = new \ReflectionClass($object);

        foreach ($data as $key => $value) {
            // Handle array of objects (list)
            if (is_array($value) && !empty($value) && self::isList($value)) {
                $property = self::resolveProperty($reflection, $key);

                if ($property !== null) {
                    $type = $property->getType();
                    // Check if property is array type
                    if ($type instanceof \ReflectionNamedType && $type->getName() === 'array') {
                        // Try to get doc comment to find array item type
                        $docComment = $property->getDocComment();
                        if ($docComment && preg_match('/@var\s+([^\s\[\]|]+)\[\]/', $docComment, $matches)) {
                            $itemClassName = self::resolveClassName($matches[1], $reflection);
                            // Convert each array item
                            $convertedArray = [];
                            foreach ($value as $item) {
                                if (is_array($item)) {
                                    $convertedArray[] = self::fromArray($item, $itemClassName);
                                } else {
                                    $convertedArray[] = $item;
                                }
                            }
                            $value = $convertedArray;
                        }
                    }
                }
            }
            // Handle nested objects (associative array)
            elseif (is_array($value) && !empty($value) && !self::isList($value)) {
                $property = self::resolveProperty($reflection, $key);

                if ($property !== null) {
                    $type = $property->getType();
                    if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                        $nestedClassName = $type->getName();
                        $value = self::fromArray($value, $nestedClassName);
                    }
                }
            }

            $method = 'set' . ucfirst(self::camelCase($key));
            if (method_exists($object, $method)) {
                $value = self::convertValueType($object, $method, $value);
                $object->$method($value);
            } else {
                $camelKey = self::camelCase($key);
                $method = 'set' . ucfirst($camelKey);
                if (method_exists($object, $method)) {
                    $value = self::convertValueType($object, $method, $value);
                    $object->$method($value);
                } elseif (property_exists($object, $key)) {
                    $prop = $reflection->getProperty($key);
                    $value = self::convertValueTypeByProperty($prop, $value);
                    $prop->setValue($object, $value);
                } elseif (property_exists($object, $camelKey)) {
                    $prop = $reflection->getProperty($camelKey);
                    $value = self::convertValueTypeByProperty($prop, $value);
                    $prop->setValue($object, $value);
                }
            }
        }

        return $object;
    }

    /**
     * Resolve a property on the reflection class by exact key or camelCase
     *
     * @param \ReflectionClass $reflection target class reflection
     * @param string $key property name to look up
     * @return \ReflectionProperty|null resolved property, or null
     */
    private static function resolveProperty(\ReflectionClass $reflection, string $key): ?\ReflectionProperty
    {
        try {
            return $reflection->getProperty($key);
        } catch (\ReflectionException $e) {
            $camelKey = self::camelCase($key);
            try {
                return $reflection->getProperty($camelKey);
            } catch (\ReflectionException $e2) {
                return null;
            }
        }
    }

    /**
     * Resolve a short class name to its fully-qualified name
     *
     * @param string $className short or fully-qualified class name
     * @param \ReflectionClass $contextClass the class providing namespace context
     * @return string fully-qualified class name
     */
    private static function resolveClassName(string $className, \ReflectionClass $contextClass): string
    {
        if (strpos($className, '\\') !== false) {
            return $className;
        }

        $namespace = $contextClass->getNamespaceName();
        $fullClassName = $namespace . '\\' . $className;
        if (class_exists($fullClassName)) {
            return $fullClassName;
        }

        // Try to find in use statements
        $fileContent = file_get_contents($contextClass->getFileName());
        if (preg_match('/use\s+([^;]+)\s+' . preg_quote($className, '/') . '\s*;/', $fileContent, $useMatches)) {
            return trim($useMatches[1]);
        }

        return $fullClassName;
    }

    /**
     * Check if array is a list (sequential keys starting from 0)
     *
     * @param array $array array to check
     * @return bool true if list
     */
    private static function isList(array $array): bool
    {
        if (empty($array)) {
            return false;
        }
        return array_keys($array) === range(0, count($array) - 1);
    }

    /**
     * Convert snake_case to camelCase
     *
     * @param string $str string in snake_case
     * @return string string in camelCase
     */
    private static function camelCase(string $str): string
    {
        return lcfirst(str_replace('_', '', ucwords($str, '_')));
    }

    /**
     * Convert camelCase to snake_case
     *
     * @param string $str string in camelCase
     * @return string string in snake_case
     */
    private static function snakeCase(string $str): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
    }

    /**
     * Convert value type based on setter method parameter type
     *
     * @param object $object object instance
     * @param string $methodName setter method name
     * @param mixed $value value to convert
     * @return mixed converted value
     */
    private static function convertValueType($object, string $methodName, $value)
    {
        if (!is_string($value) || !method_exists($object, $methodName)) {
            return $value;
        }

        try {
            $reflection = new \ReflectionClass($object);
            $method = $reflection->getMethod($methodName);
            $parameters = $method->getParameters();
            
            if (empty($parameters)) {
                return $value;
            }

            $parameter = $parameters[0];
            $type = $parameter->getType();

            if ($type instanceof \ReflectionNamedType && $type->isBuiltin()) {
                $typeName = $type->getName();
                
                // Convert string to float/int if needed
                if (($typeName === 'float' || $typeName === 'int') && is_numeric($value)) {
                    return $typeName === 'float' ? (float)$value : (int)$value;
                }
            }
        } catch (\ReflectionException $e) {
            // If reflection fails, return original value
        }

        return $value;
    }

    /**
     * Convert value type based on property type
     *
     * @param \ReflectionProperty $property property reflection
     * @param mixed $value value to convert
     * @return mixed converted value
     */
    private static function convertValueTypeByProperty(\ReflectionProperty $property, $value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $type = $property->getType();
        
        if ($type instanceof \ReflectionNamedType && $type->isBuiltin()) {
            $typeName = $type->getName();
            
            // Convert string to float/int if needed
            if (($typeName === 'float' || $typeName === 'int') && is_numeric($value)) {
                return $typeName === 'float' ? (float)$value : (int)$value;
            }
        }

        return $value;
    }
}

