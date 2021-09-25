<?php

namespace EOSVN\A2ReviewsClient;

use EOSVN\A2ReviewsClient\Interfaces\SignatureGeneratorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SignatureValidator
 *
 * @package EOSVN\A2ReviewsClient
 *  @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class SignatureValidator
{
    /**
     * @var SignatureGeneratorInterface
     */
    protected $signatureGenerator;

    /**
     * SignatureValidator constructor.
     * @param SignatureGeneratorInterface $signatureGenerator
     */
    public function __construct(SignatureGeneratorInterface $signatureGenerator)
    {
        $this->signatureGenerator = $signatureGenerator;
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function isValid(ServerRequestInterface $request): bool
    {
        $body = $request->getBody()->getContents();
        $authorization = $request->getHeaderLine('X-A2reviews-Hmac');

        if (empty($authorization)) {
            return false;
        }
        if ($this->signatureGenerator->generateSignature($body) !== $authorization) {
            return false;
        }
        return true;
    }
}
