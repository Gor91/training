<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Config;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getData();
        $this->setData($data, 'region');
    }

    public function setData($data, $status, $i = null)
    {
        $regions = [
            2 => [
                'ashtarak' => 'Աշտարակ',
                'aparan' => 'Ապարան',
                'alagyaz' => 'Ալագյազ',
                'avan' => 'Ավան',
                'aragatsavan' => 'Արագածավան',
                'sasunik' => 'Սասունիկ',
                'tsaghkahovit' => 'Ծաղկահովիտ',
                'mastara' => 'Մաստարա',
            ],
            3 => [
                'urtsadzor' => 'Ուրցաձոր',
            ],
            4 => ['parakar' => 'Փարաքար',
            ],
            5 => [
                'tchambarak' => 'Ճամբարակ',
                'g_akunk' => 'Ակունք',
                'vardenis' => 'Վարդենիս',
                'geghamasar' => 'Գեղամասար',
                'geghovit' => 'Գեղհովիտ',
                'shoghakat' => 'Շողակաթ',
                'sevan' => 'Սևան',
            ],
            6 => [
                'byureghavan' => 'Բյուրեղավան',
                'yeghvard' => 'Եղվարդ',
                'charentsavan' => 'Չարենցավան',
                'akunk' => 'Ակունք',
                'meghradzor' => 'Մեղրաձոր',
                'jrvedj' => 'Ջրվեժ',
            ],
            7 => ['alaverdi' => 'Ալավերդի',
                'akhtala' => 'Ախթալա',
                'tumanyan' => 'Թումանյան',
                'stepanavan' => 'Ստեփանավան',
                'tashir' => 'Տաշիր',
                'gyulagarak' => 'Գյուլագարակ',
                'lori_berd' => 'Լոռի Բերդ',
                'shnogh' => 'Շնող',
                'sarchapet' => 'Սարչապետ',
                'odzoun' => 'Օձուն',
                'metsavan' => 'Մեծավան',
                'halavar' => 'Հալավար'
            ],
            8 => [
                'arpi' => 'Արփի',
                'akhuryan' => 'Ախուրյան',
                'ani' => 'Անի',
                'amasia' => 'Ամասիա',
                'ashotsk' => 'Աշոցք',
                'gharibjanyan' => 'Ղարիբջանյան',
                'marmashen' => 'Մարմաշեն',
                'sarapat' => 'Սարապատ',
            ],
            9 => [
                'kapan' => 'Կապան',
                'goris' => 'Գորիս',
                'sisian' => 'Սիսիան',
                'meghri' => 'Մեղրի',
                'kajaran' => 'Քաջարան',
                'gorayk' => 'Գորայք',
                'tatev' => 'Տաթև',
                'tegh' => 'Տեղ',
            ],
            10 => ['ayrum' => 'Այրում',
                'berd' => 'Բերդ',
                'dilijan' => 'Դիլիջան',
                'noyemberyan' => 'Նոյեմբերյան',
                'koghb' => 'Կողբ',
            ],
            11 => [
                'areni' => 'Արենի',
                'vayk' => 'Վայք',
                'gladzor' => 'Գլաձոր',
                'yeghegis' => 'Եղեգիս',
                'zaritap' => 'Զառիթափ',
                'jermuk' => 'Ջերմուկ',
            ]
        ];
        $keys = array_keys($data);

        foreach ($data as $index) {
            $this->setTerritory($index, $i, $status);
        }
        for ($id = 1; $id < 11; $id++) {
            $key = $keys[$id];

            $city_path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . Config::get('constants.CITY') . DIRECTORY_SEPARATOR . $key . Config::get('constants.FILE_EX');

            $this->setTerritoryByFile($city_path, Config::get('constants.TERRITORY'), $id + 1);

            foreach ($regions[$id + 1] as $i_key => $item) {
                $residence_path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . Config::get('constants.TERRITORY') . DIRECTORY_SEPARATOR . $i_key . Config::get('constants.FILE_EX');
                $t_id = $this->setTerritory($item, $id + 1, Config::get('constants.TERRITORY'));
                $this->setTerritoryByFile($residence_path, Config::get('constants.RESIDENCE'), $t_id);
            }
            $village_path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . Config::get('constants.VILLAGE') . DIRECTORY_SEPARATOR . $key . Config::get('constants.FILE_EX');
            $this->setTerritoryByFile($village_path, Config::get('constants.TERRITORY'), $id + 1);
        }
    }


    public function setTerritory($index, $i, $status)
    {
        $row = [
            'name' => trim($index),
            'region_id' => $i,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Facades\DB::table('regions')->insert($row);
        return Facades\DB::getPdo()->lastInsertId();
    }

    /**
     * @param $path
     * @param $id
     */
    public function setTerritoryByFile($path, $status, $id): void
    {
        if (file_exists($path)) {
            $contents = file($path);
            if (!empty($contents))
                foreach ($contents as $index => $content) {
                    if(!empty($content))
                    $this->setTerritory(trim($content), $id, $status);
                }
        }
    }

    public function getData()
    {
        return [
            'yerevan' => 'Երևան',
            'aragatsotn' => 'Արագածոտն',
            'ararat' => 'Արարատ',
            'armavir' => 'Արմավիր',
            'gegharkunik' => 'Գեղարքունիք',
            'kotayk' => 'Կոտայք',
            'lori' => 'Լոռի',
            'shirak' => 'Շիրակ',
            'syunik' => 'Սյունիք',
            'tavush' => 'Տավուշ',
            'vayots' => 'Վայոց Ձոր',
        ];
    }

    public function getRegions()
    {

    }
}
