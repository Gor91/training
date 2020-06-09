<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class SpecialtySeeder extends Seeder
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
            Facades\DB::table('specialties')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                'parent_id' => null,
                'type_id' => 1,
                'name' => 'ԲԺՇԿԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 1,
                'name' => 'ՍՏՈՄԱՏՈԼՈԳԻԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 1,
                'name' => 'ԴԵՂԱԳԻՏԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 1,
                'name' => 'ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
    }
}
