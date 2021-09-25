<?php

use Illuminate\Contracts\Foundation\Application;

/**
 *  Copyright (c) 2021 A2Reviews, Inc.
 *
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */

if (!function_exists('a2_config')) {

    /**
     * @param null $key
     * @param null $default
     * @return Application|mixed
     */
    function a2_config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            $keys = [];
            foreach ($key as $k => $v) {
                $keys[] = [
                    'a2reviews_client.a2rev_' . $k => $v
                ];
            }

            $a2_key = array_flatten($keys);

            return app('config')->set($a2_key);
        }

        return app('config')->get('a2reviews_client.a2rev_' . $key, $default);
    }
}

if (!function_exists('array_flatten')) {

    /**
     * Flatten arrays
     *
     * @param $array
     * @return array|false
     */
    function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
