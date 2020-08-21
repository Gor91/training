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

        $this->setData();
    }

    /**
     * @return array
     */
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
                'type_id' => 2,
                'name' => 'ՍՏՈՄԱՏՈԼՈԳԻԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 3,
                'name' => 'ԴԵՂԱԳԻՏԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 4,
                'name' => 'ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 1,
                'name' => 'ԲԺՇԿԱԿԱՆ ՆԵՂ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐԻ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 2,
                'name' => 'ՍՏՈՄԱՏՈԼՈԳԻԱԿԱՆ ՆԵՂ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 3,
                'name' => 'ԴԵՂԱԳԻՏԱԿԱՆ ՆԵՂ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => null,
                'type_id' => 4,
                'name' => 'ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՆԵՂ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ',
                'icon' => 'fa ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
    }

    public function setData()
    {

        $spec = [
            [1 => ['Ընտանեկան բժշկություն', 'Ներքին հիվանդություններ (թերապիա)', 'Մանկաբուժություն', 'Նյարդաբանություն']],
            [2 => ['Ընդհանուր (ընտանեկան) ստոմատոլոգիա']],
            [3 => ['Ընդհանուր դեղագիտություն']],
            [4 => ['ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ']],
            [1 => ['Ալերգոլոգիա և իմունոլոգիա', 'Հերիատրիա', 'Հոմեոպաթիա', 'Սեռախտաբանություն', 'Երիկամաբանություն և հեմոդիալիզ', 'Աղեստամոքսաբանություն', 'Ռևմատոլոգիա']],
            [2 => ['Վիրաբուժական ստոմատոլոգիա և իմպլանտոլոգիա', 'Օրթոդոնտիա', 'Օրթոպեդիկ ստոմատոլոգիա', 'Մանկական ստոմատոլոգիա']],
            [3 => ['Դեղագործության կազմակերպում և կառավարում', 'Դեղաձևերի տեխնոլոգիա', 'Դեղագործական քիմիա և ֆարմակոգնոզիա', 'Կլինիկական դեղագիտություն (ֆարմացիա)']],
            [4 => ['Առողջապահության կառավարում և կազմակերպում', 'Շրջակա միջավայրի հիգիենա', 'Համաճարակաբանություն', 'Մանրէաբանություն']]
        ];

        foreach ($spec as $key => $value) {

            foreach ($value as $i => $items) {
                foreach ($items as $it) {
                    $item = ['parent_id' => $key + 1,
                        'type_id' => $i,
                        'name' => $it,
                        'icon' => 'fa ',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),];
                    Facades\DB::table('specialties')->insert($item);
                }
            }

        }
    }
}
