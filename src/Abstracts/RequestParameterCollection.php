<?php

namespace EOSVN\A2ReviewsClient\Abstracts;

use EOSVN\A2ReviewsClient\Interfaces\RequestParametersInterface;

/**
 * Class RequestParameterCollection
 *
 * @package EOSVN\A2ReviewsClient\Abstracts
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
abstract class RequestParameterCollection implements RequestParametersInterface
{
    /**
     * @var array Parameter
     */
    protected $parameters = [];

    /**
     * RequestParameterCollection constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->fromArray($parameters);
    }

    /**
     * @param RequestParametersInterface $parameter
     * @return $this
     */
    public function add(RequestParametersInterface $parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    abstract public function fromArray(array $parameters);

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function (RequestParametersInterface $parameter) {
            return $parameter->toArray();
        }, $this->parameters);
    }
}
