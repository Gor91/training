<?php
// Code within app\Helpers\Helper.php

use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function isAdmin()
{
    $user = $user = Auth::guard('admin')->user();;
    if (!empty($user))
        return $user;
    else
        return false;
}

/**
 * generate a random string
 * @param int $length
 * @return string
 */
function grs($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


/**
 * @param $id
 * @return mixed
 */
function getRegionName($id)
{
    $region = Region::select('name')
        ->where('id', $id)
        ->first();

    return $region->name;
}

function getProfession($id){
    return DB::table('professions AS p')
        ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
        ->join('specialties AS sp', 's.parent_id', '=', 'sp.id')
        ->join('specialties_types AS st', 's.type_id', '=', 'st.id')
        ->select( 's.icon','s.name AS name', 'sp.name AS spec_name','st.name AS prof_name')
        ->where('p.account_id', '=', $id)
        ->first();
}

