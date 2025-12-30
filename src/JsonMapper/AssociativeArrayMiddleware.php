<?php

/**
 * TODO: 1. figure out how to restrict this to only the instance we need it for (MiningEndpointsTest). 2. figure is it already solved by the library.
 */

namespace BrianHenryIE\BtcRpcExplorer\JsonMapper;

use JsonMapper\JsonMapperInterface;
use JsonMapper\Middleware\AbstractMiddleware;
use JsonMapper\ValueObjects\PropertyMap;
use JsonMapper\Wrapper\ObjectWrapper;

/**
 * Middleware to convert stdClass objects to arrays for properties that expect associative arrays.
 *
 * JsonMapper doesn't automatically convert JSON objects (parsed as stdClass) to PHP arrays
 * when the type hint is array<string, SomeClass>. This middleware handles that conversion.
 */
class AssociativeArrayMiddleware extends AbstractMiddleware
{
    public function handle(
        \stdClass $json,
        ObjectWrapper $object,
        PropertyMap $propertyMap,
        JsonMapperInterface $mapper
    ): void {
        // Iterate through all properties in the JSON object
        foreach (get_object_vars($json) as $key => $value) {
            // Only process stdClass values (potential associative arrays)
            if (!$value instanceof \stdClass) {
                continue;
            }

            // Check if this property exists in the property map
            if (!$propertyMap->hasProperty($key)) {
                continue;
            }

            $property = $propertyMap->getProperty($key);

            // Check if any of the property types is an array
            foreach ($property->getPropertyTypes() as $propertyType) {
                if ($propertyType->isArray()) {
                    // Convert stdClass to array so JsonMapper can process it as an array type
                    $json->$key = (array) $value;
                    break;
                }
            }
        }
    }
}
