<?php

namespace InboxAgency\Session;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class SessionMiddelwareTest extends TestCase
{
    /**
     * @test
     */
    public function mustDefineSessionAttribute()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $session = $this->createMock(Session::class);

        $request->expects($this->once())
            ->method('withAttribute')
            ->with(
                $this->equalTo(Session::SESSION_ATTRIBUTE),
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
