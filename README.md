# IsbnDb Client

[![Latest Stable Version](http://poser.pugx.org/opendaje/isbndb-client/v)](https://packagist.org/packages/opendaje/isbndb-client) [![Total Downloads](http://poser.pugx.org/opendaje/isbndb-client/downloads)](https://packagist.org/packages/opendaje/isbndb-client) [![Latest Unstable Version](http://poser.pugx.org/opendaje/isbndb-client/v/unstable)](https://packagist.org/packages/opendaje/isbndb-client) [![License](http://poser.pugx.org/opendaje/isbndb-client/license)](https://packagist.org/packages/opendaje/isbndb-client) [![PHP Version Require](http://poser.pugx.org/opendaje/isbndb-client/require/php)](https://packagist.org/packages/opendaje/isbndb-client)

[![CD/CI](https://github.com/OpenDaje/isbndb-client/actions/workflows/cd-ci.yaml/badge.svg)](https://github.com/OpenDaje/isbndb-client/actions/workflows/cd-ci.yaml)

⚠ Launching early stage releases (0.x.x) could break the API according to [Semantic Versioning 2.0](https://semver.org/). We are using *minor* for breaking changes.
This will change with the release of the stable `1.0.0` version.

PHP api client for [ISBNdb](https://isbndb.com/) database.

## Install

```sh
composer require opendaje/isbndb-client

// add a PSR Http client

composer require http-interop/http-factory-guzzle php-http/guzzle6-adapter
```

## Usage

Register for your API KEY at [https://isbndb.com/isbn-database](https://isbndb.com/isbn-database)

```php
<?php declare(strict_types=1);

use IsbnDbClient\IsbnDbClient;

require_once __DIR__ . '/../vendor/autoload.php';

$token = 'YOUR_API_KEY';

$client = new IsbnDbClient();
$client->authenticate($token);

try {
    $response = $client->api('author')->searchAuthors('eric evans');

    print_r($response);
} catch (Exception $exception){
    print_r($exception->getMessage());
}


```
