<?php

namespace SSHTTPServerHandler\UnitTest;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SSHTTPServerHandler\HTTPServerHandler;

class HTTPServerHandlerTest extends TestCase
{
    public function testHandle()
    {
        $handler = new HTTPServerHandler($this->createMock(ResponseInterface::class));

        $request = $this->createMock(ServerRequestInterface::class);

        $this->assertInstanceOf(ResponseInterface::class, $handler->handle($request));
    }

    public function testHandleUsingMiddleware(): void
    {
        $handler = new HTTPServerHandler($this->createMock(ResponseInterface::class));

        $request = $this->createMock(ServerRequestInterface::class);

        $middlware = new class implements MiddlewareInterface {
            public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
            {
                return $handler->handle($request);
            }
        };

        $handler->addMiddleware($middlware);

        $this->assertInstanceOf(ResponseInterface::class, $handler->handle($request));
    }
}
