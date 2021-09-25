<?php

namespace EOSVN\A2ReviewsClient\Interfaces;

/**
 * Interface RequestParametersInterface
 *
 * @package EOSVN\A2ReviewsClient\Interfaces
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
interface RequestParametersInterface
{
    /**
     * @param array $parameters
     * @return $this
     */
    public function fromArray(array $parameters);

    /**
     * @return array
     */
    public function toArray(): array;
}
