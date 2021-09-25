<?php

namespace EOSVN\A2ReviewsClient\Abstracts;

use EOSVN\A2ReviewsClient\A2ReviewsClient;
use EOSVN\A2ReviewsClient\Interfaces\RequestParametersInterface;
use EOSVN\A2ReviewsClient\ResponseData;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\UriInterface;

/**
 * Class NodeAbstract
 *
 * @package EOSVN\A2ReviewsClient\Abstracts
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
abstract class NodeAbstract
{
    protected $client;

    public function __construct(A2ReviewsClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string|UriInterface $uri
     * @param $method
     * @param array|RequestParameters $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function method($uri, $method, $parameters)
    {
        if ($parameters instanceof RequestParametersInterface) {
            $parameters = $parameters->toArray();
        }

        $request = $this->client->newRequest($uri, $method, [], $parameters);
        $response = $this->client->send($request);

        return new ResponseData($response);
    }
}
