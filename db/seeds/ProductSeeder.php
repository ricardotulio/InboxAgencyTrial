<?php


use Phinx\Seed\AbstractSeed;

class ProductSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Celular',
                'price' => 300.00
            ],
            [
                'name' => 'Notebook',
                'price' => 450.00
            ],
            [
                'name' => 'Tablet',
                'price' => 320.00
            ],
            [
                'name' => 'Playstation 4',
                'price' => 250.00
            ],
            [
                'name' => 'Xbox One',
                'price' => 222.00
            ]
        ];

        $users = $this->table('products');
        $users->insert($data)
            ->save();
    }
}
