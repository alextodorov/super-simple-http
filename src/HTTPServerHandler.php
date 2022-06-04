<?php

declare(strict_types=1);

namespace SSHTTPServerHandler;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HTTPServerHandler implements RequestHandlerInterface
{
    private array $middlewares = [];

    public function __construct(private ResponseInterface $defaultResponse)
    {
    }

    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->middlewares) {
            return $this->defaultResponse;
        }

        $middleware = array_shift($this->middlewares);

        return $middleware->process($request, $this);
    }
}
