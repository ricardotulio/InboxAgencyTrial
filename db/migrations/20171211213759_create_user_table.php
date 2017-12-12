<?php


use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->create();
    }
}
