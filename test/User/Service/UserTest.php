<?php

namespace InboxAgency\User\Service;

use PHPUnit\Framework\TestCase;
use InboxAgency\Session\Session;
use InboxAgency\User\Entity\User as UserEntity;
use InboxAgency\User\Repository\UserRepository;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function mustLoginWithValidUser()
    {
        $session = $this->createMock(Session::class);
        $repository = $this->createMock(UserRepository::class);

        $service = new User($session, $repository);

        $email = 'john@due.com';
        $password = '123456';

        $user = new UserEntity();
        $user->setEmail($email);
        $user->setPassword($password);

        $repository->expects($this->once())
            ->method('findByEmail')
            ->with($this->equalTo($email))
            ->willReturn($user);

        $session->expects($this->once())
            ->method('set')
            ->with(
                $this->equalTo('user'),
                $this->equalTo($user)
            );

        $this->assertTrue($service->login($email, $password));
    }

    /**
     * @test
     */
    public function mustDenyUserWhenCredentialHasInvalid()
    {
        $session = $this->createMock(Session::class);
        $repository = $this->createMock(UserRepository::class);

        $service = new User($session, $repository);
        
        $email = 'john@due.com';
        $password = '123456';

        $user = $this->createMock(UserEntity::class);
        $user->expects($this->once())
            ->method('authenticate')
            ->willReturn(false);

        $repository->expects($this->once())
            ->method('findByEmail')
            ->willReturn($user);

        $this->assertFalse($service->login($email, $password));
    }

    /**
     * @test
     */
    public function mustDestroySessionWhenLogout()
    {
        $session = $this->createMock(Session::class);
        $repository = $this->createMock(UserRepository::class);

        $service = new User($session, $repository);

        $session->expects($this->once())
            ->method('destroy');

        $service->logout(); 
    }
}
