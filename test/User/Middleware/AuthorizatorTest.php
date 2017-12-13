<?php

namespace InboxAgency\User\Middleware;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\UriInterface as Uri;
use InboxAgency\Session\SessionInterface as Session;
use InboxAgency\User\Entity\User;

class AuthorizatorTest extends TestCase
{
    /**
     * @test
     */
    public function mustAthorizeWheUserAreLogged()
    {
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $session = $this->createMock(Session::class);
        $user = $this->createMock(User::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(Session::SESSION_ATTRIBUTE))
            ->willReturn($session);

        $session->expects($this->once())
            ->method('get')
            ->with($this->equalTo('user'))
            ->willReturn($user);

        $callable = function() {
            return 'authorized';
        };

        $authorizator = new Authorizator();
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
        $request = $this->createMock(Request::class);
        $response = $this->createMock(Response::class);
        $uri = $this->createMock(Uri::class);
        $session = $this->createMock(Session::class);
        $user = $this->createMock(User::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(Session::SESSION_ATTRIBUTE))
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

        $authorizator = new Authorizator();
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
        $request = $this->createMock(Request::class);
        $response = $this->createMock(\Slim\Http\Response::class);
        $uri = $this->createMock(Uri::class);
        $session = $this->createMock(Session::class);
        $user = $this->createMock(User::class);

        $request->expects($this->once())
            ->method('getAttribute')
            ->with($this->equalTo(Session::SESSION_ATTRIBUTE))
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

        $authorizator = new Authorizator();

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
