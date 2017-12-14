<?php

namespace InboxAgency\User\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\SessionInterface;
use InboxAgency\User\Entity\UserInterface;
use InboxAgency\User\Repository\UserRepositoryInterface;

class UserTestService extends TestCase
{
    /**
     * @test
     */
    public function mustLoginWithValidUser()
    {
        $session = $this->createMock(SessionInterface::class);
        $repository = $this->createMock(UserRepositoryInterface::class);
        $user = $this->createMock(UserInterface::class);

        $userService = new UserService($session, $repository);

        $email = 'john@due.com';
        $password = '1234';
        $user->method('authenticate')->willReturn(true);

        $repository->expects($this->once())
            ->method('findByEmail')
            ->willReturn($user);

        $session->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('user'),
                $this->equalTo($user)
            );

        $this->assertTrue($userService->login($email, $password));
    }

    /**
     * @test
     */
    public function mustDenyUserWhenCredentialHasInvalid()
    {
        $session = $this->createMock(SessionInterface::class);
        $repository = $this->createMock(UserRepositoryInterface::class);

        $userService = new UserService($session, $repository);

        $email = 'john@due.com';
        $password = '123456';

        $user = $this->createMock(UserInterface::class);
        $user->expects($this->once())
            ->method('authenticate')
            ->willReturn(false);

        $repository->expects($this->once())
            ->method('findByEmail')
            ->willReturn($user);

        $this->assertFalse($userService->login($email, $password));
    }

    /**
     * @test
     */
    public function mustDestroySessionWhenLogout()
    {
        $session = $this->createMock(SessionInterface::class);
        $repository = $this->createMock(UserRepositoryInterface::class);

        $userService = new UserService($session, $repository);

        $session->expects($this->once())
            ->method('destroy');

        $userService->logout();
    }
}
