<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class DocumentSeeder extends Seeder
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
            Facades\DB::table('documents')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                "id" => 1,
                "type" => "orders_of_the_minister",
                "doc_path" => "naxararihramanner.pdf",
                "page_id" => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            ["id" => 2,
                "type" => "health_care_orders",
                "doc_path" => "aroxjapahutyanvolortihramanner.pdf",
                "page_id" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),


            ]
        ];
    }
}
