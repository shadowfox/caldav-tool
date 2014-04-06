<?php
namespace AppUtils;

/**
 * Checks if multiple keys exist in a given array
 *
 * @param  array $keys      The keys to check
 * @param  array $search    The array to search
 * @return bool             rue if ALL keys exist, false otherwise
 */
public static function arrayKeysExist($keys, $search) {
    foreach($keys as $key) {
        if (!array_key_exists($key, $array)) {
            return false;
        }
    }

    return true;
}

/**
 * Slugifies a string, replacing any non-basic characters
 * and forcing the string to lower case
 * 
 * @param string $string The input string
 * @return string        The slugified string
 */
function function slugify($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('~[^\\pL\d]+~u', '_', $string);

    return $string;
}