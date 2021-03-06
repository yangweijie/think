<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

class Lang
{
    // 语言参数
    private static $lang = [];
    // 语言作用域
    private static $range = '';

    // 设定语言参数的作用域（语言）
    public static function range($range)
    {
        self::$range = $range;
    }

    /**
     * 设置语言定义(不区分大小写)
     * @param string|array $name 语言变量
     * @param string $value 语言值
     * @param string $range 作用域
     * @return mixed
     */
    public static function set($name, $value = null, $range = '')
    {
        $range = $range ? $range : self::$range;
        // 批量定义
        if (!isset(self::$lang[$range])) {
            self::$lang[$range] = [];
        }
        if (is_array($name)) {
            return self::$lang[$range] = array_merge(self::$lang[$range], array_change_key_case($name));
        } else {
            return self::$lang[$range][strtolower($name)] = $value;
        }
    }

    /**
     * 加载语言定义(不区分大小写)
     * @param string $file 语言文件
     * @param string $range 作用域
     * @return mixed
     */
    public static function load($file, $range = '')
    {
        $range = $range ? $range : self::$range;
        $lang  = is_file($file) ? include $file : [];
        if (!isset(self::$lang[$range])) {
            self::$lang[$range] = [];
        }
        // 批量定义
        if(!isset(self::$lang[$range])) {
            self::$lang[$range] = [];
        }
        return self::$lang[$range] = array_merge(self::$lang[$range], array_change_key_case($lang));
    }

    /**
     * 获取语言定义(不区分大小写)
     * @param string|null $name 语言变量
     * @param string $range 作用域
     * @return mixed
     */
    public static function get($name = null, $range = '')
    {
        $range = $range ? $range : self::$range;
        // 空参数返回所有定义
        if (empty($name)) {
            return self::$lang[$range];
        }
        $name = strtolower($name);
        return isset(self::$lang[$range][$name]) ? self::$lang[$range][$name] : $name;
    }
}
