<?php

namespace EOSVN\A2ReviewsClient\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiException
 *
 * @package EOSVN\A2ReviewsClient\Exceptions
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class ApiException extends \RuntimeException
{
    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface|null */
    private $response;

    /** @var array */
    private $context;

    /**
     * ApiException constructor.
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param \Exception|null $previous
     * @param array $context
     */
    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null,
        array $context = []
    )
    {
        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->request = $request;
        $this->response = $response;
        $this->context = $context;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
