<?php
namespace App\Helpers;

class Helper {

    public static function array_to_object($array)
    {
        return collect($array)->map(fn($value) => (object) $value);
    }
    public static function is_duplicated($objectArray, $key, $errorMessage)
    {
        $seen = [];
        foreach ($objectArray as $object) {
            if (in_array($object->$key, $seen)) {
                throw new \Exception($errorMessage);
            }
            $seen[] = $object->$key;
        }
    }
}