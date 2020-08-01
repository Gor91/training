<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Carbon\Carbon;

class MessagesSeeder extends Seeder
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
            Facades\DB::table('messages')->insert($index);
        }
    }

    public function getData()
    {
        return [
            [
                "name" => "Մասնակցին հաստատելու հաղորդագրություն",
                "key" => "approved_user",
                "value" => "Մասնակցին հաստատելու հաղորդագրություն  Մասնակցին հաստատելու հաղորդագրություն Մասնակցին հաստատելու հաղորդագրություն",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Մասնակցին հեռացնելու հաղորդագրություն",
                "key" => "rejected_user",
                "value" => "Մասնակցին հեռացնելու հաղորդագրություն Մասնակցին հեռացնելու հաղորդագրություն Մասնակցին հեռացնելու հաղորդագրություն",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Գրանցված օգտատեր",
                "key" => "registered_user",
                "value" => "Բարի գալուստ։  \r\nԳրանցված օգտատեր\r\nԳրանցված օգտատեր\r\nԳրանցված օգտատեր\r\nԳրանցված օգտատեր\r\nԳրանցված օգտատեր",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                "name" => "Դասավանդում",
                "key" => "registered_lecture",
                "value" => "Դասավանդում, դասավանդում դասավանդում դասավանդումդասավանդումդասավանդում",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ];
    }
}
