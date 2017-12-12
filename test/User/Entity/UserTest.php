<?php

namespace InboxAgency\User\Entity;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $userData;

    private $plainPassword;

    public function setUp()
    {
        $this->plainPassword = '123456';

        $this->userData = [
            'id' => 1,
            'email' => 'teste@teste.com.br',
            'password' => $this->plainPassword,
            'created' => '2017-12-11',
            'updated' => null
        ];
    }

    /**
     * @test
     */
    public function mustConvertUserToArray()
    {

        $user = new User();
        $user->setId($this->userData['id']);
        $user->setEmail($this->userData['email']);
        $user->setPassword($this->userData['password']);
        $user->setCreated($this->userData['created']);
        $user->setUpdated($this->userData['updated']);

        $this->userData['password'] = $user->encrypt($this->plainPassword);

        $this->assertEquals($this->userData, $user->toArray());

        $this->userData['password'] = $this->plainPassword;
    }

    /**
     * @test
     */
    public function mustPopulateUserFromArray()
    {
        $user = new User();
        $user->fromArray($this->userData);

        $this->assertEquals($this->userData['id'], $user->getId());
        $this->assertEquals($this->userData['email'], $user->getEmail());
        $this->assertEquals($this->userData['created'], $user->getCreated());
        $this->assertEquals($this->userData['updated'], $user->getUpdated());
    }

    /**
     * @test
     */
    public function mustEncryptPassword()
    {
        $user = new User();
        $user->setPassword($this->plainPassword);

        $this->assertEquals(
            $user->encrypt($this->plainPassword),
            $user->getPassword()
        );
    }

    /**
     * @test
     */
    public function mustAuthenticateUser()
    {
        $user = new User();
        $user->setPassword($this->plainPassword);

        $this->assertTrue($user->authenticate($this->plainPassword));
        $this->assertFalse($user->authenticate('654321'));
    }
}
