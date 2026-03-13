<?php


namespace Site;


use Exception;
use ReflectionClass;

class App
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function get($id)
    {
        return $this->container[$id];
    }

    public function set($id, $value)
    {
        $this->container[$id] = $value;
    }

    private static function build(string $class, array $vars = [])
    {
        $ref = new ReflectionClass($class);
        if (! $ref->isInstantiable()) {
            throw new Exception("Class {$class} does not exist");
        }
        $constructor = $ref->getConstructor();
        if (is_null($constructor)) {
            return new $class();
        }
        $params        = $constructor->getParameters();
        $resolveParams = [];
        foreach ($params as $key => $value) {
            $name = $value->getName();
            if (isset($vars[$name])) {
                $resolveParams[] = $vars[$name];
            } else {
                $default = $value->isDefaultValueAvailable() ? $value->getDefaultValue() : null;
                if (is_null($default)) {
                    if ($value->getClass()) {
                        $resolveParams[] = static::build(
                            $value->getClass()->getName(),
                            $vars
                        );
                    } else {
                        throw new Exception(
                            "{$name} no value passed and no default"
                        );
                    }
                } else {
                    $resolveParams[] = $default;
                }
            }
        }

        return $ref->newInstanceArgs($resolveParams);
    }

    public static function actionFactory(string $class, array $vars = [])
    {
        return static::build($class, $vars);
    }
}