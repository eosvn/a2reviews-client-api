<?php

namespace EOSVN\A2ReviewsClient\Abstracts;

use ReflectionClass;
use EOSVN\A2ReviewsClient\Interfaces\RequestParametersInterface;

/**
 * Class RequestParameters
 *
 * @package EOSVN\A2ReviewsClient\Abstracts
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
abstract class RequestParameters implements RequestParametersInterface
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * RequestParameters constructor.
     * @param array $parameters
     * @throws \ReflectionException
     */
    public function __construct(array $parameters = [])
    {
        $this->fromArray($parameters);
    }

    /**
     * @param string $name
     * @param bool $lcfirst
     * @return string
     */
    protected function toCamelcase(string $name, bool $lcfirst = false): string
    {
        $name = str_replace('_', '', ucwords($name, '_'));
        if ($lcfirst) {
            $name = lcfirst($name);
        }

        return $name;
    }

    /**
     * @param array $parameters
     * @return $this
     * @throws \ReflectionException
     */
    public function fromArray(array $parameters)
    {
        $reflectionClass = new ReflectionClass($this);

        foreach ($parameters as $name => $parameter) {
            $method = 'set' . $this->toCamelcase($name, true);
            if (method_exists($this, $method)) {
                $reflectionMethod = $reflectionClass->getMethod($method);
                $parameterType = $reflectionMethod->getParameters()[0]->getType();
                if ($parameterType && !$parameterType->isBuiltin()) {
                    $className = $parameterType->getName();
                    $parameter = new $className($parameter);
                }

                $this->$method($parameter);
                continue;
            }
            $this->parameters[$name] = $parameter;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        ksort($this->parameters);

        return array_map(function ($value) {
            if ($value instanceof RequestParametersInterface) {
                return $value->toArray();
            }
            return $value;
        }, $this->parameters);
    }
}
