# Super Simple Http H`~andler

A Super Simple HTTP Handler library implementing the PSR-15.

![Build Status](https://github.com/alextodorov/super-simple-http-handler/actions/workflows/phpunit.yml/badge.svg?branch=main)

Install
-------

```sh
composer require super-simple/http-server-handler
```

Requires PHP 8.1 or newer.

Usage
-----

Basic usage:

```php

// Create a handler, the $defaultResponse must implement Psr\Http\Message\ResponseInterface.
$handler = new HTTPServerHandler($defaultResponse);

// Handle the request

$response = $handler->handle($request);

```

It's possible to add Middlewares.

```php
//.... create a handler

// The $middleware must implement Psr\Http\Server\MiddlewareInterface
$handler->addMiddleware($middlware);

// ... handle the request.

```

For more details check out the [wiki].

[wiki]: https://github.com/alextodorov/super-simple-http-handler/wiki