<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class CreditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getData();
        foreach ($data as $index) {
            Facades\DB::table('credit_types')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                'key' => 'theoretical',
                'order' => 1
            ],
            [
                'key' => 'practical',
                'order' => 2
            ],
            [
                'key' => 'selfeducation',
                'order' => 3
            ]
        ];
    }
}
