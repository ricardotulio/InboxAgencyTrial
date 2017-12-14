<?php

namespace InboxAgency\User\Middleware;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use InboxAgency\Session\SessionInterface;
use InboxAgency\User\Entity\UserInterface;

class AuthorizatorMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function mustAthorizeWheUserAreLogged()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $session = $this->createMock(SessionInterface::class);
        $user = $this->createMock(UserInterface::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(SessionInterface::SESSION_ATTRIBUTE))
            ->willReturn($session);

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('user'))
            ->willReturn($user);

        $callable = function() {
            return 'authorized';
        };

        $authorizator = new AuthorizatorMiddleware();
        $this->assertEquals(
            'authorized',
            $authorizator(
                $request,
                $response,
                $callable
            )
        );
    }

    /**
     * @test
     */
    public function mustAuthorizeWhenIsLoginPage()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $uri = $this->createMock(UriInterface::class);
        $session = $this->createMock(SessionInterface::class);
        $user = $this->createMock(UserInterface::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(SessionInterface::SESSION_ATTRIBUTE))
            ->willReturn($session);

        $request->expects($this->once())
            ->method('getUri')
            ->willReturn($uri);

        $uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/login/');

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('user'))
            ->willReturn(null);

        $callable = function() {
            return 'authorized';
        };

        $authorizator = new AuthorizatorMiddleware();
        $this->assertEquals(
            'authorized',
            $authorizator(
                $request,
                $response,
                $callable
            )
        );
    }

    /**
     * @test
     */
    public function mustUnauthorizeUserWhenNotLogged()
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(\Slim\Http\Response::class);
        $uri = $this->createMock(UriInterface::class);
        $session = $this->createMock(SessionInterface::class);
        $user = $this->createMock(UserInterface::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(SessionInterface::SESSION_ATTRIBUTE))
            ->willReturn($session);

        $request->expects($this->once())
            ->method('getUri')
            ->willReturn($uri);

        $uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/other/');

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('user'))
            ->willReturn(null);

        $response->expects($this->once())
            ->method('withRedirect')
            ->with(
                $this->equalTo('/login/'),
                $this->equalTo(301)
            )
            ->willReturn($response);

        $callable = function() {
            return 'authorized';
        };

        $authorizator = new AuthorizatorMiddleware();

        $this->assertSame(
            $response,
            $authorizator(
                $request,
                $response,
                $callable
            )
        );
    }
}
