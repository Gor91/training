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
        $regions = $this->getRegions();
        foreach ($regions as $index => $region) {
            $this->setData($region, 'territory', $index);
        }
    }

    public function setData($data, $status, $i = null)
    {
        foreach ($data as $key => $index) {
            $row = ['name' => $index,
                'region_id' => $i,
                'status' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            Facades\DB::table('regions')->insert($row);
            $id = Facades\DB::getPdo()->lastInsertId();
            $region_path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . $status . DIRECTORY_SEPARATOR . $key . Config::get('constants.FILE_EX');
            if ($status === Config::get('constants.TERRITORY')) {
                $path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . 'region' . DIRECTORY_SEPARATOR . $key . Config::get('constants.FILE_EX');
                if (file_exists($path)) {

                    $contents = file($path);
                    if (!empty($contents))
                        $this->setData($contents, Config::get('constants.VILLAGE'), $id);
                }
            }
            else if ($status === Config::get('constants.REGION')) {
                $city_path = storage_path() . Config::get('constants.APP') . Config::get('constants.REGIONS') . "city" . DIRECTORY_SEPARATOR . $key . Config::get('constants.FILE_EX');

                if (file_exists($city_path)) {
                    $contents = file($city_path);
                    if (!empty($contents))
                        $this->setData($contents, Config::get('constants.CITY'), $id);
                }
                if (file_exists($region_path)) {
                    $contents = file($region_path);
                    if (!empty($contents))
                        $this->setData($contents, Config::get('constants.TERRITORY'), $id);
                }
            }
        }
    }

    public function getData()
    {
        return [
            'aragatsotn' => 'Արագածոտն',
            'ararat' => 'Արարատ',
            'armavir' => 'Արմավիր',
            'gegharkunik' => 'Գեղարքունիք',
            'kotayk' => 'Կոտայք', 'lori' => 'Լոռի',
            'shirak' => 'Շիրակ', 'syunik' => 'Սյունիք',
            'tavush' => 'Տավուշ', 'vayots' => 'Վայոց Ձոր',
        ];
    }

    public function getRegions()
    {
        return [
            2 => ['ashtarak' => 'Աշտարակ', 'aparan' => 'Ապարան', 'alagyaz' => 'Ալագյազ',
                'artashatavan' => 'Արտաշատավան', 'avan' => 'Ավան',
                'aragatsavan' => 'Արագածավան', 'tsaghkahovit' => 'Ծաղկահովիտ',
                'mastara' => 'Մաստարա', 'sasunik' => 'Սասունիկ'],
            3 => ['bardzrashen' => 'Բարձրաշեն', 'paryur' => 'Պարույր Սևակ', 'urtsadzor' => 'Ուրցաձոր'],
            4 => ['parakar' => 'Փարաքար'],
            5 => ['tchambarak' => 'Ճամբարակ', 'sevan' => 'Սևան', 'martuni' => 'Մարտունի', 'vardenis' => 'Վարդենիս', 'geghamasar' => 'Գեղամասար',
                'geghovit' => 'Գեղհովիտ', 'shoghakat' => 'Շողակաթ'],
            6 => ['byureghavan' => 'Բյուրեղավան', 'yeghvard' => 'Եղվարդ', 'charentsavan' => 'Չարենցավան', 'akunk' => 'Ակունք', 'meghradzor' => 'Մեղրաձոր', 'jrvedj' => 'Ջրվեժ'],
            7 => ['alaverdi' => 'Ալավերդի', 'akhtala' => 'Ախթալա', 'tumanyan' => 'Թումանյան', 'stepanavan' => 'Ստեփանավան',
                'lermontovo' => 'Լերմոնտովո', 'tashir' => 'Տաշիր', 'gyulagarak' => 'Գյուլագարակ',
                'lori_berd' => 'Լոռի Բերդ', 'halavar' => 'Հալավար', 'shnogh' => 'Շնող', 'sarchapet' => 'Սարչապետ', 'odzoun' => 'Օձուն', 'metsavan' => 'Մեծավան'],
            8 => ['arpi' => 'Արփի', 'akhuryan' => 'Ախուրյան', 'ani' => 'Անի', 'amasia' => 'Ամասիա',
                'ashotsk' => 'Աշոցք', 'gharibjanyan' => 'Ղարիբջանյան', 'marmashen' => 'Մարմաշեն', 'sarapat' => 'Սարապատ'],
            9 => ['kapan' => 'Կապան', 'goris' => 'Գորիս', 'sisian' => 'Սիսիան', 'meghri' => 'Մեղրի', 'kajaran' => 'Քաջարան',
                'gorayk' => 'Գորայք', 'tatev' => 'Տաթև', 'tegh' => 'Տեղ'],
            10 => ['ijevan' => 'Իջևան', 'berd' => 'Բերդ', 'dilijan' => 'Դիլիջան', 'noyemberyan' => 'Նոյեմբերյան', 'koghb' => 'Կողբ'],
            11 => ['vayk' => 'Վայք', 'areni' => 'Արենի', 'gladzor' => 'Գլաձոր', 'jermuk' => 'Ջերմուկ', 'zaritap' => 'Զառիթափ', 'yeghegis' => 'Եղեգիս']
        ];
    }
}
