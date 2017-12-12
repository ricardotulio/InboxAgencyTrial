<?php


use Phinx\Migration\AbstractMigration;

class CreateProductTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('products');
        $table->addColumn('name', 'string')
            ->addColumn('price', 'decimal')
            ->create();
    }
}
