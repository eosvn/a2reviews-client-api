<?php

namespace EOSVN\A2ReviewsClient;

use EOSVN\A2ReviewsClient\Interfaces\SignatureGeneratorInterface;

/**
 * Class SignatureGenerator
 *
 * @package EOSVN\A2ReviewsClient
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class SignatureGenerator implements SignatureGeneratorInterface
{
    /**
     * @var string
     */
    private $a2ReviewApiKey;

    /**
     * SignatureGenerator constructor.
     * @param string $a2ReviewApiKey
     */
    public function __construct(string $a2ReviewApiKey)
    {
        $this->a2ReviewApiKey = $a2ReviewApiKey;
    }


    /**
     * @param string $body
     * @return string
     */
    public function generateSignature(string $body): string
    {
        return hash_hmac('sha256', $body, $this->a2ReviewApiKey);
    }
}
