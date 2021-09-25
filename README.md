<p align="center">
<a href="https://a2rev.com" target="_blank">
<img src="https://a2rev.com/_nuxt/img/f463df2.svg" height="148">
</a>
</p>


<p align="center">
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://img.shields.io/packagist/dt/eosvn/a2reviews-client-api" alt="Total Downloads">
</a>
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://img.shields.io/packagist/v/eosvn/a2reviews-client-api" alt="Latest Stable Version">
</a>
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://img.shields.io/packagist/l/eosvn/a2reviews-client-api" alt="License">
</a>
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://poser.pugx.org/eosvn/a2reviews-client-api/v/stable" alt="Latest Stable Version">
</a>
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://poser.pugx.org/eosvn/a2reviews-client-api/v/unstable" alt="Latest Unstable Version">
</a>
<a href="https://packagist.org/packages/eosvn/a2reviews-client-api">
<img src="https://poser.pugx.org/eosvn/a2reviews-client-api/composerlock" alt="composer.lock">
</a>
</p>

## Overview

[A2Reviews Client API](https://github.com/eosvn/a2reviews-client-api) lets you build apps, extensions or plugins to get reviews from the A2reviews APP. Including adding reviews to a store's products. It is used to import and export reviews through the API. This is the official package built and developed by A2Reviews, Inc.

## Requirements

* PHP >= 7.2
* [Composer](https://getcomposer.org/download/)
* [Guzzle](https://guzzle.readthedocs.io/en/latest/overview.html#requirements)

## Installation

Execute the following command to get the package:

```console
composer require eosvn/a2reviews-client-api
```

## Usage

Create an instance of the A2Reviews Client, then used to access the A2Reviews Client API.

```php
<?php

require_once __DIR__ . "/vendor/autoload.php";

$a2Review = new EOSVN\A2ReviewsClient\A2ReviewsClient([
    'api_key' => '{A2Review_API_Key}',
    'api_secret' => '{A2Review_API_Secret}',
]);
```

## Examples

In the examples below we just used some parameters as a demo. For detailed parameters please visit our [documentation](https://api.a2rev.com).

### Product Reviews

APIs for reviews of product, allows to get the reviews of a product or all products. Make it possible to deploy on different platforms.

##### Get product reviews

```php
$response = $a2Review->review->getProductReviews([
    'handle' => '{product_handle}',
    'limit' => 2 // Number record per page
]);
```

##### Get feature reviews

```php
$response = $a2Review->review->getFeatureReviews([
    'limit' => 2
]);
```

##### Get block list reviews

```php
$response = $a2Review->review->getBlockListReviews([
    'limit' => 2
]);
```

##### Get block reviews

```php
$response = $a2Review->review->getBlockReviews([
    'limit' => 2
]);
```

##### Write review to product

```php
$response = $a2Review->review->postReviewToProduct([
    'handle' => '{product_handle}',
    'review' => [
        'rating' => 4,
        'title' => 'Package title review.',
        'author' => 'Author name',
        'email' => 'author_email@gmail.com',
        'content' => 'Package content review.'
    ]
]);
```

##### Update a review

```php
$response = $a2Review->review->updateReview([
    'id' => '{review_id}',
    'handle' => '{product_handle}',
    'review' => [
        'rating' => 2,
        'title' => 'Package title review (update).',
        'author' => 'Author name',
        'email' => 'author_email@gmail.com',
        'content' => 'Package content review.'
    ]
]);
```

##### Update image review

```php
$response = $a2Review->review->updateImageReview([
    'id' => '{review_id}',
    'handle' => '{product_handle}',
    'image' => [
        'attachment' => '{image data base64}',
        'filename' => '{filename}'
    ]
]);
```

### Client Site Settings

APIs for client site, allows to get the settings global, setting languages.

##### Get global settings

```php
$response = $a2Review->setting->getGlobalSettings();
```

##### Get reviews languages

```php
$response = $a2Review->setting->getReviewLanguages();
```

##### Get questions answers language

```php
$response = $a2Review->setting->getQuestionAnswerLanguages();
```

##### Get common languages
 
```php
$response = $a2Review->setting->getCommonLanguages();
```

After request, using below way to get data

```php
$response->getData();
```

## Documentation

[A2Reviews - Official Client API Documentation](https://api.a2rev.com)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover a security vulnerability within [a2reviews-client-api](https://github.com/eosvn/a2reviews-client-api), please send an e-mail to [A2Reviews, Inc](https://github.com/eosvn) via [info@a2rev.com](mailto:info@a2rev.com). All security vulnerabilities will be promptly addressed.

## Credits

- [Be Duc Tai](https://github.com/eosvn)
- [Phi Hoang](https://github.com/hoangphidev)
- [All Contributors](../../contributors)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
