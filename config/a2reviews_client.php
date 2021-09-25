<?php

/**
 * Copyright (c) 2021 A2Reviews, Inc.
 *
 * @company A2Reviews, Inc
 * @email info@a2rev.com
 * @website https://a2rev.com
 */
return [

    /*
    |--------------------------------------------------------------------------
    | A2Reviews user agent
    |--------------------------------------------------------------------------
    |
    | This user agent is used when you call to a2review system.
    | Current is set default 'A2reviews'.
    |
    */

    'a2rev_user_agent' => env('A2REV_USER_AGENT', 'A2reviews'),

    /*
    |--------------------------------------------------------------------------
    | A2Reviews base url
    |--------------------------------------------------------------------------
    |
    | This is the public link of the A2Reviews API system. All APIs in the system start from it.
    | Values may be changed when A2Reviews has other updates.
    |
    */

    'a2rev_base_url' => env('A2REV_BASE_URL', 'https://api.a2rev.com'),

    /*
    |--------------------------------------------------------------------------
    | A2Reviews site api key
    |--------------------------------------------------------------------------
    |
    | This site api key is required config of the package.
    | It is being used to connect to a2reviews api system.
    |
    */

    'a2rev_api_key' => env('A2REV_SITE_API_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | A2Reviews site api secret
    |--------------------------------------------------------------------------
    |
    | This site api secret is required config of the package.
    | It is being used to connect to a2reviews api system.
    |
    */

    'a2rev_api_secret' => env('A2REV_SITE_API_SECRET', null),
];
