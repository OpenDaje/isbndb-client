# IsbnDb Client

[![CD/CI](https://github.com/OpenDaje/isbndb-client/actions/workflows/cd-ci.yaml/badge.svg)](https://github.com/OpenDaje/isbndb-client/actions/workflows/cd-ci.yaml)

⚠ Launching early stage releases (0.x.x) could break the API according to [Semantic Versioning 2.0](https://semver.org/). We are using *minor* for breaking changes.
This will change with the release of the stable `1.0.0` version.


## INSTALL

```sh
composer require opendaje/isbndb-client

// add a PSR Http client

composer require http-interop/http-factory-guzzle php-http/guzzle6-adapter
```