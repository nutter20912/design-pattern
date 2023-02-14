<?php
/**
 * Singleton Pattern 單例模式
 *
 * 只能有一個實例
 * 必須自己創建自己的唯一
 * 必須給所有其他對象提供此單例
 *
 * 主要解決全局使用的類 頻繁創建及銷毀
 * 構造函數必須是私有的，需注意多線程是否安全
 */

final class Singleton
{
    /**
     * 單例實例
     */
    private static $instance;

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance()
    {
        if(static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
