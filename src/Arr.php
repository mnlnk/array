<?php

namespace Manuylenko\ArrayHelper;

class Arr
{
    /**
     * Устанавливает значение в массив.
     *
     * @param array &$array
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public static function set(array &$array, $key, $value)
    {
        $parts = explode('.', $key);

        while (count($parts) > 1) {
            $key = array_shift($parts);

            if (! isset($array[$key]) || ! is_array($array[$key])) {
                $array[$key] = array();
            }

            $array = &$array[$key];
        }

        $array[array_shift($parts)] = $value;
    }

    /**
     * Получает значение из массива.
     *
     * @param array $array
     * @param string $key
     * @param mixed|null $fallback
     *
     * @return mixed
     */
    public static function get(array $array, $key, $fallback = null)
    {
        if ($array === []) {
            return $fallback;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        if (strpos($key, '.') === false) {
            return isset($array[$key]) ? $array[$key] : $fallback;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && isset($array[$segment])) {
                $array = $array[$segment];
            } else {
                return $fallback;
            }
        }

        return $array;
    }

    /**
     * Проверяет существование значения в массиве.
     *
     * @param array $array
     * @param string $key
     *
     * @return bool
     */
    public static function has(array $array, $key)
    {
        if (empty($array)) {
            return false;
        }

        if (is_null($key)) {
            return false;
        }

        if (isset($array[$key])) {
            return true;
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($array) && isset($array[$segment])) {
                $array = $array[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Удаляет значение из массива.
     *
     * @param array &$array
     * @param string|array $keys
     *
     * @return void
     */
    public static function remove(array &$array, $keys)
    {
        $original = &$array;

        $keys = self::wrap($keys);

        if (count($keys) === 0) {
            return;
        }

        foreach ($keys as $key) {
            if (isset($array[$key])) {
                unset($array[$key]);
                continue;
            }

            $array = &$original;
            $parts = explode('.', $key);

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }

    /**
     * Оборачивает значение в массив.
     *
     * @param mixed $value
     *
     * @return array
     */
    public static function wrap($value = null)
    {
        return (is_null($value) ? [] : (is_array($value) ? $value : array($value)));
    }
}
