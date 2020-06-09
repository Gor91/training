<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class EducationSeeder extends Seeder
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
            Facades\DB::table('educations')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                'name' => 'ԲԺՇԿԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ՍՏՈՄԱՏՈԼՈԳԻԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ԴԵՂԱԳԻՏԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
    }
}
