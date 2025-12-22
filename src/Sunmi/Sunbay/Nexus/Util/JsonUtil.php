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
                $property->setAccessible(true);
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
            // Handle nested objects
            if (is_array($value) && !empty($value) && !self::isList($value)) {
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
                $object->$method($value);
            } else {
                $camelKey = self::camelCase($key);
                $method = 'set' . ucfirst($camelKey);
                if (method_exists($object, $method)) {
                    $object->$method($value);
                } elseif (property_exists($object, $key)) {
                    $reflection = new \ReflectionClass($object);
                    $property = $reflection->getProperty($key);
                    $property->setAccessible(true);
                    $property->setValue($object, $value);
                } elseif (property_exists($object, $camelKey)) {
                    $reflection = new \ReflectionClass($object);
                    $property = $reflection->getProperty($camelKey);
                    $property->setAccessible(true);
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
}


