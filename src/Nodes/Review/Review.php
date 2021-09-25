<?php

namespace EOSVN\A2ReviewsClient\Nodes\Review;

use EOSVN\A2ReviewsClient\Abstracts\NodeAbstract;
use EOSVN\A2ReviewsClient\ResponseData;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

/**
 * Class Reviews
 *
 * @package EOSVN\A2ReviewsClient\Nodes\Reviews
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class Review extends NodeAbstract
{
    /**
     * Get product reviews
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getProductReviews($parameters = []): ResponseData
    {
        return $this->method('/v1/reviews', 'GET', $parameters);
    }

    /**
     * Get feature reviews
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getFeatureReviews($parameters = []): ResponseData
    {
        return $this->method('/v1/feature-reviews', 'GET', $parameters);
    }

    /**
     * Get block list reviews
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getBlockListReviews($parameters = []): ResponseData
    {
        return $this->method('/v1/blocks', 'GET', $parameters);
    }

    /**
     * Get block list reviews
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getBlockReviews($parameters = []): ResponseData
    {
        $parameters['block_id'] = $parameters['block_id'] ?? 0;
        return $this->method('/v1/blocks/' . $parameters['block_id'] . '/reviews', 'GET', $parameters);
    }

    /**
     * Write review to product
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function addReviewToProduct($parameters = []): ResponseData
    {
        return $this->method('/v1/reviews', 'POST', $parameters);
    }

    /**
     * Update a review
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function updateReview($parameters = []): ResponseData
    {
        $parameters['id'] = $parameters['id'] ?? Str::uuid();
        return $this->method('/v1/reviews/' . $parameters['id'], 'PUT', $parameters);
    }

    /**
     * Update image review
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function updateImageReview($parameters = []): ResponseData
    {
        return $this->method('/v1/review-images', 'POST', $parameters);
    }

}
