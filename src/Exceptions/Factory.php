<?php

namespace EOSVN\A2ReviewsClient\Exceptions;

use GuzzleHttp\Exception\RequestException;

/**
 * Class Factory
 *
 * @package EOSVN\A2ReviewsClient\Exceptions
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class Factory
{
    /**
     * @param string $className
     * @param RequestException $exception
     * @return ApiException
     */
    public static function create(string $className, RequestException $exception): ApiException
    {
        return new $className(
            $exception->getMessage(),
            $exception->getRequest(),
            $exception->getResponse(),
            $exception,
            $exception->getHandlerContext()
        );
    }
}
