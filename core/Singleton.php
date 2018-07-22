<?php


namespace core;


trait Singleton
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance() {
        if (!is_object(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}