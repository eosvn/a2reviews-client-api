<?php

namespace EOSVN\A2ReviewsClient;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseData
 *
 * @package EOSVN\A2ReviewsClient
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class ResponseData
{
    /** @var ResponseInterface */
    private $response;

    /** @var array */
    private $data;

    /**
     * ResponseData constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $json = $response->getBody()->getContents();
        $data = json_decode($json, true);

        $this->response = $response;
        $this->data = $data;
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
    public function getData(): array
    {
        return $this->data;
    }
}
