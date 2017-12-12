<?php

namespace InboxAgency\User\Service;

use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\TestCase;

class SessionAuthorizatorTest extends TestCase
{
    /**
     * @test
     */
    public function mustVerifyIfHasAuthorized()
    {
        $request = $this->createMock(Request::class);

        $_SESSION['logged'] = true;

        $authorizator = new SessionAuthorizator();

        $this->assertTrue($authorizator->hasAuthorized($request));
    }

    /**
     * @test
     */
    public function mustVerifyIfIsLoginPage()
    {
        $authorizator = new SessionAuthorizator();

        $request1 = $this->createMock(Request::class);
        $request1->method('getUri')
            ->willReturn(getenv('BASE_URL') . '/login/');

        $request2 = $this->createMock(Request::class);
        $request2->method('getUri')
            ->willReturn(getenv('BASE_URL') . '/cart/');

        $this->assertTrue($authorizator->isLoginPage($request1));
        $this->assertFalse($authorizator->isLoginPage($request2));
    }
}
