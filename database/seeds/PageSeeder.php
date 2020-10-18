<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class PageSeeder extends Seeder
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
            Facades\DB::table('pages')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                "id" => 1,
                "title" => "Մեր Մասին",
                "slug" => "about",
                "description" => "There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station.\r\n\r\nIt’s exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first telescope exciting is time to buy that first.",
                "homedescription" => "There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station.\r\n\r\nIt’s exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that it is time to buy that first telescope exciting is time to buy that first.",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ];
    }
}
