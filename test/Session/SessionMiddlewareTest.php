<?php

namespace InboxAgency\Session;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SessionMiddelwareTest extends TestCase
{
    /**
     * @test
     */
    public function mustDefineSessionAttribute()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $session = $this->createMock(SessionInterface::class);

        $request->expects($this->once())
            ->method('withAttribute')
            ->with(
                $this->equalTo(SessionInterface::SESSION_ATTRIBUTE),
                $this->equalTo($session)
            );

        $callable = function($request, $response) {
            return $response;
        };

        $middleware = new SessionMiddleware($session);
        $this->assertSame(
            $response,
            $middleware(
                $request,
                $response,
                $callable
            )
        );
    }
}
