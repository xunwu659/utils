<?php

namespace spore\utils;

/**
 * 字符串操作帮助类
 * Class Str
 * @package utils
 */
class Str
{
    /**
     * @param $action
     * @param $controller
     * @param $module
     * @param $route
     * @return string
     */
    public static function getAuthName(string $action, string $controller, string $module, $route)
    {
        return strtolower($module . '/' . $controller . '/' . $action . '/' . self::paramStr($route));
    }

    /**
     * @param $params
     * @return string
     */
    public static function paramStr($params)
    {
        if (!is_array($params)) $params = json_decode($params, true) ?: [];
        $p = [];
        foreach ($params as $key => $param) {
            $p[] = $key;
            $p[] = $param;
        }
        return implode('/', $p);
    }

    /**
     * 截取中文指定字节
     * @param string $str
     * @param int $utf8len
     * @param string $chaet
     * @param string $file
     * @return string
     */
    public static function substrUTf8($str, $utf8len = 100, $chaet = 'UTF-8', $file = '....')
    {
        if (mb_strlen($str, $chaet) > $utf8len) {
            $str = mb_substr($str, 0, $utf8len, $chaet) . $file;
        }
        return $str;
    }
}
