<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'email' => 'teste@teste.com',
                'password' => sha1('123456'),
                'created' => '2017-12-11'
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)
            ->save();
    }
}
