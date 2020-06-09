<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class AdminSeeder extends Seeder
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
            Facades\DB::table('admins')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                'name' => 'admin',
                'email' =>'admin@gmail.com',
                'password'=> password_hash('11111111', PASSWORD_BCRYPT),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'admin',
                'email' =>'admin@admin.com',
                'password'=> password_hash('11111111', PASSWORD_BCRYPT),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
    }
}
