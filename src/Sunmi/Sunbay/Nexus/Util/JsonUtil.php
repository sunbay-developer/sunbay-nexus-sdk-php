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

        // Convert array to object
        $object = new $className();
        foreach ($data as $key => $value) {
            // Handle array of objects (list)
            if (is_array($value) && !empty($value) && self::isList($value)) {
                // Try to determine the array item class name from property type hints
                $reflection = new \ReflectionClass($object);
                $property = null;
                try {
                    $property = $reflection->getProperty($key);
                } catch (\ReflectionException $e) {
                    // Property doesn't exist, try camelCase
                    $camelKey = self::camelCase($key);
                    try {
                        $property = $reflection->getProperty($camelKey);
                    } catch (\ReflectionException $e2) {
                        // Property still doesn't exist
                    }
                }

                if ($property !== null) {
                    $type = $property->getType();
                    // Check if property is array type
                    if ($type instanceof \ReflectionNamedType && $type->getName() === 'array') {
                        // Try to get doc comment to find array item type
                        $docComment = $property->getDocComment();
                        if ($docComment && preg_match('/@var\s+([^\s\[\]|]+)\[\]/', $docComment, $matches)) {
                            $itemClassName = $matches[1];
                            // Check if it's a fully qualified class name or needs namespace resolution
                            if (strpos($itemClassName, '\\') === false) {
                                // Try to resolve from use statements or same namespace
                                $namespace = $reflection->getNamespaceName();
                                // Check if class exists in current namespace
                                $fullClassName = $namespace . '\\' . $itemClassName;
                                if (class_exists($fullClassName)) {
                                    $itemClassName = $fullClassName;
                                } else {
                                    // Try to find in use statements
                                    $fileContent = file_get_contents($reflection->getFileName());
                                    if (preg_match('/use\s+([^;]+)\s+' . preg_quote($itemClassName, '/') . '\s*;/', $fileContent, $useMatches)) {
                                        $itemClassName = trim($useMatches[1]);
                                    } else {
                                        // Fallback to same namespace
                                        $itemClassName = $fullClassName;
                                    }
                                }
                            }
                            // Convert each array item
                            $convertedArray = [];
                            foreach ($value as $item) {
                                if (is_array($item)) {
                                    $convertedArray[] = self::fromJson(json_encode($item), $itemClassName);
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
                // Try to determine the nested class name from property type hints
                $reflection = new \ReflectionClass($object);
                $property = null;
                try {
                    $property = $reflection->getProperty($key);
                } catch (\ReflectionException $e) {
                    // Property doesn't exist, try camelCase
                    $camelKey = self::camelCase($key);
                    try {
                        $property = $reflection->getProperty($camelKey);
                    } catch (\ReflectionException $e2) {
                        // Property still doesn't exist
                    }
                }

                if ($property !== null) {
                    $type = $property->getType();
                    if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                        $nestedClassName = $type->getName();
                        $value = self::fromJson(json_encode($value), $nestedClassName);
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
                    $reflection = new \ReflectionClass($object);
                    $property = $reflection->getProperty($key);
                    $value = self::convertValueTypeByProperty($property, $value);
                    $property->setValue($object, $value);
                } elseif (property_exists($object, $camelKey)) {
                    $reflection = new \ReflectionClass($object);
                    $property = $reflection->getProperty($camelKey);
                    $value = self::convertValueTypeByProperty($property, $value);
                    $property->setValue($object, $value);
                }
            }
        }

        return $object;
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

