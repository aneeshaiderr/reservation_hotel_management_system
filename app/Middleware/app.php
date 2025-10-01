<?php
namespace App\Middleware;

class App
{
    /**
     * Simple resolver without container
     */
    public static function resolve($class)
    {
        return new $class();
    }
}
