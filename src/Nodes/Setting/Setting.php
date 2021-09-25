<?php

namespace EOSVN\A2ReviewsClient\Nodes\Setting;

use EOSVN\A2ReviewsClient\Abstracts\NodeAbstract;
use EOSVN\A2ReviewsClient\ResponseData;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Setting
 *
 * @package EOSVN\A2ReviewsClient\Nodes\Setting
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
class Setting extends NodeAbstract
{
    /**
     * Get global settings
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getGlobalSettings($parameters = [])
    {
        return $this->method('/v1/settings', 'GET', $parameters);
    }

    /**
     * Get reviews languages
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getReviewLanguages($parameters = [])
    {
        return $this->method('/v1/languages/reviews', 'GET', $parameters);
    }


    /**
     * Get questions answers language
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getQuestionAnswerLanguages($parameters = [])
    {
        return $this->method('/v1/languages/qa', 'GET', $parameters);
    }

    /**
     * Get common languages
     *
     * @param array $parameters
     * @return ResponseData
     * @throws GuzzleException
     */
    public function getCommonLanguages($parameters = [])
    {
        return $this->method('/v1/languages/common', 'GET', $parameters);
    }

}
