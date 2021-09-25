<?php

namespace EOSVN\A2ReviewsClient\Interfaces;

/**
 * Interface SignatureGeneratorInterface
 *
 * @package EOSVN\A2ReviewsClient\Interfaces
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
interface SignatureGeneratorInterface
{
    /**
     * @param string $body
     * @return string
     */
    public function generateSignature(string $body): string;
}
