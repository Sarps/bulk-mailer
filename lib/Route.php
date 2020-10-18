<?php


namespace Sarps;


use Sarps\Providers\RouteBuilder;


class Route
{
    private static $rb;

    public function __set($name, $path)
    {
        if (self::$rb == null) self::$rb = new RouteBuilder();
        self::$rb->add($name, $path);
    }

    public static function __callStatic($name, $path)
    {
        if (self::$rb == null) self::$rb = new RouteBuilder();
        self::$rb->add($name, $path[0]);
    }

    public static function attributes()
    {
        if (self::$rb == null) self::$rb = new RouteBuilder();
        try {
            return self::$rb->match();
        } catch (\Exception $e) {
            return null;
        }
    }

}