<?php

namespace EOSVN\A2ReviewsClient;

use EOSVN\A2ReviewsClient\Abstracts\NodeAbstract;
use EOSVN\A2ReviewsClient\Interfaces\SignatureGeneratorInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class A2ReviewsClient
 *
 * @property Nodes\Review\Review $review
 * @property Nodes\Setting\Setting $setting
 *
 * @package EOSVN\A2ReviewsClient
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class A2ReviewsClient
{
    public const A2REV_BASE_URL = 'https://api.a2rev.com';

    public const A2REV_USER_AGENT = 'A2reviews';

    public const A2REV_SITE_API_KEY = 'A2REV_SITE_API_KEY';

    public const A2REV_SITE_API_SECRET = 'A2REV_SITE_API_SECRET';

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Base url endpoint
     * @var
     */
    protected $baseUrl;

    /**
     * User agent
     *
     * @var
     */
    protected $userAgent;

    /**
     * A2Review API Key
     *
     * @var Application|mixed
     */
    protected $a2ReviewApiKey;

    /**
     * A2Review API Secret
     *
     * @var Application|mixed
     */
    protected $a2ReviewApiSecret;

    /**
     * @var SignatureGeneratorInterface
     */
    protected $signatureGenerator;

    /**
     * @var array NodeAbstract[]
     */
    protected $nodes = [];

    /**
     * A2ReviewsClient constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config = array_merge([
            'http_client' => null,
            'user_agent' => self::A2REV_USER_AGENT,
            'base_url' => self::A2REV_BASE_URL,
            'api_key' => getenv(self::A2REV_SITE_API_KEY),
            'api_secret' => getenv(self::A2REV_SITE_API_SECRET),
            SignatureGeneratorInterface::class => null,
        ], $config);

        $this->httpClient = $config['http_client'] ?: new HttpClient([
            'verify' => false
        ]);

        $this->setUserAgent($config['user_agent']);
        $this->setBaseUrl($config['base_url']);
        $this->a2ReviewApiKey = $config['api_key'];
        $this->a2ReviewApiSecret = $config['api_secret'];

        // Check valid authenticate
        $signatureGenerator = $config[SignatureGeneratorInterface::class];
        if (is_null($signatureGenerator)) {
            $this->signatureGenerator = new SignatureGenerator($this->a2ReviewApiSecret);
        } elseif ($signatureGenerator instanceof SignatureGeneratorInterface) {
            $this->signatureGenerator = $signatureGenerator;
        } else {
            throw new InvalidArgumentException('Signature generator not implement SignatureGeneratorInterface');
        }

        // Node API
        $this->nodes['review'] = new Nodes\Review\Review($this);
        $this->nodes['setting'] = new Nodes\Setting\Setting($this);

    }

    /**
     * @param string $name
     * @return NodeAbstract
     */
    public function __get(string $name)
    {
        if (!array_key_exists($name, $this->nodes)) {
            throw new InvalidArgumentException(sprintf('Property "%s" not exists', $name));
        }

        return $this->nodes[$name];
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param ClientInterface $client
     * @return $this
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * Get user agent
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Set user agent
     *
     * @param string $userAgent
     * @return $this
     */
    public function setUserAgent(string $userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Get base url endpoint
     *
     * @return mixed
     */
    public function getBaseUrl(): UriInterface
    {
        return $this->baseUrl;
    }

    /**
     * Set base url endpoint
     *
     * @param string $url
     * @return $this
     */
    public function setBaseUrl(string $url)
    {
        $this->baseUrl = new Uri($url);
        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'timestamp' => time(), // Put the current UNIX timestamp when making a request
        ];
    }

    /**
     * Generate an HMAC-SHA256 signature for a HTTP request
     *
     * @param $body
     * @return string
     */
    protected function signature($body = []): string
    {
        $body = http_build_query($body);
        return $this->signatureGenerator->generateSignature($body);
    }

    /**
     * New request
     *
     * @param $uri
     * @param $method
     * @param array $headers
     * @param array $data
     * @return RequestInterface
     */
    public function newRequest($uri, $method, array $headers = [], $data = []): RequestInterface
    {
        $uri = Utils::uriFor($uri);
        $path = $this->baseUrl->getPath() . $uri->getPath();

        $uri = $uri
            ->withScheme($this->baseUrl->getScheme())
            ->withUserInfo($this->baseUrl->getUserInfo())
            ->withHost($this->baseUrl->getHost())
            ->withPort($this->baseUrl->getPort())
            ->withPath($path);

        $data = array_merge($this->getDefaultParameters(), $data);
        $jsonBody = json_encode($data, true);

        $headers['User-Agent'] = $this->userAgent;
        $headers['X-A2reviews-Hmac'] = $this->signature($data);
        $headers['X-A2reviews-APIKey'] = $this->a2ReviewApiKey;
        $headers['Content-Type'] = 'application/json';

        return new Request(
            $method,
            $uri,
            $headers,
            $jsonBody
        );
    }

    /**
     * Send request
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->httpClient->send($request);
        } catch (GuzzleClientException $exception) {
            $response = $exception->getResponse();
        } catch (GuzzleServerException $exception) {
            $response = $exception->getResponse();
        }
        return $response;
    }
}
