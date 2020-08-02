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
<<<<<<< HEAD
=======

>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
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
<<<<<<< HEAD
        $spec = [['Ընտանեկան բժշկություն', 'Ներքին հիվանդություններ (թերապիա)', 'Մանկաբուժություն', 'Նյարդաբանություն'],
=======
        $spec = [
            ['Ընտանեկան բժշկություն', 'Ներքին հիվանդություններ (թերապիա)', 'Մանկաբուժություն', 'Նյարդաբանություն'],
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
            ['Ընդհանուր (ընտանեկան) ստոմատոլոգիա'],
            ['Ընդհանուր դեղագիտություն'],
            ['ՀԱՆՐԱՅԻՆ ԱՌՈՂՋԱՊԱՀԱԿԱՆ ՄԱՍՆԱԳԻՏՈՒԹՅՈՒՆՆԵՐ'],
            ['Ալերգոլոգիա և իմունոլոգիա', 'Հերիատրիա', 'Հոմեոպաթիա', 'Սեռախտաբանություն', 'Երիկամաբանություն և հեմոդիալիզ', 'Աղեստամոքսաբանություն', 'Ռևմատոլոգիա'],
            ['Վիրաբուժական ստոմատոլոգիա և իմպլանտոլոգիա', 'Օրթոդոնտիա', 'Օրթոպեդիկ ստոմատոլոգիա', 'Մանկական ստոմատոլոգիա'],
            ['Դեղագործության կազմակերպում և կառավարում', 'Դեղաձևերի տեխնոլոգիա', 'Դեղագործական քիմիա և ֆարմակոգնոզիա', 'Կլինիկական դեղագիտություն (ֆարմացիա)'],
<<<<<<< HEAD
            ['Առողջապահության կառավարում և կազմակերպում', 'Շրջակա միջավայրի հիգիենա', 'Համաճարակաբանություն', 'Մանրէաբանություն']];
=======
            ['Առողջապահության կառավարում և կազմակերպում', 'Շրջակա միջավայրի հիգիենա', 'Համաճարակաբանություն', 'Մանրէաբանություն']
        ];
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446

        foreach ($spec as $key => $value) {

            foreach ($value as $items) {
                $item = ['parent_id' => $key + 1,
                    'type_id' => 1,
                    'name' => $items,
                    'icon' => 'fa ',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),];
                Facades\DB::table('specialties')->insert($item);
            }
<<<<<<< HEAD

=======
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
        }
    }
}
