<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class SpecialtiesTypeSeeder extends Seeder
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
            Facades\DB::table('specialties_types')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                'name' => 'ԲԺԻՇԿ',
                'description' => 'ԲԺՇԿԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ԲՈՒԺՔՈՒՅՐ',
                'description' => 'ՍՏՈՄԱՏՈԼՈԳԻԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ԴԵՂԱԳԵՏ',
                'description' => 'ԴԵՂԱԳԻՏԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ԴԵՂԱԳՈՐԾ',
                'description' => 'ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
    }
}
