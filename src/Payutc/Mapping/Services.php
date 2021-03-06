<?php

namespace Payutc\Mapping;

class Services {
    protected static $services = array(
        'POSS2',
        'POSS2WithExceptions',
        'POSS3',
        'AADMIN',
        'MADMIN',
        'STATS',
        'KEY',
        'ADMINRIGHT',
        'BLOCKED',
        'GESARTICLE'
    );
    
    public static function get($name) {
        static::checkExist($name);
        $name = "Payutc\\Service\\$name";
        return new $name();
    }
    
    public static function checkExist($name) {
        if (!in_array($name, static::$services)) {
            throw new \Payutc\Exception\ServiceNotFound("Service $name does not exist");
        }
    }
    
    public static function getServices() {
        return static::$services;
    }
}

