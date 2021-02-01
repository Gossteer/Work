<?php

trait Singleton
{
    private static $instance;

    protected function __clone()
    {
        throw new \Exception("Невозможно клонировать одиночку");
    }

    public function __wakeup()
    {
        throw new \Exception("Невозможно десеериализовать одиночку");
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
