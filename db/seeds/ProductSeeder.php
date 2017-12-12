<?php


use Phinx\Seed\AbstractSeed;

class ProductSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Celular',
                'price' => 300.00,
                'created' => '2017-12-01'
            ],
            [
                'name' => 'Notebook',
                'price' => 450.00,
                'created' => '2017-12-01'
            ],
            [
                'name' => 'Tablet',
                'price' => 320.00,
                'created' => '2017-12-01'
            ],
            [
                'name' => 'Playstation 4',
                'price' => 250.00,
                'created' => '2017-12-01'
            ],
            [
                'name' => 'Xbox One',
                'price' => 222.00,
                'created' => '2017-12-01'
            ]
        ];

        $users = $this->table('products');
        $users->insert($data)
            ->save();
    }
}
