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
        return redirect('/login');;
}

/**
 * generate a random string
 * @param int $length
 * @return string
 */
function grs($length = 6)
{
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

function getAccountName($id)
{
    $account = \App\Models\Account::select('name', 'surname')
        ->where('id', $id)
        ->first();

    return $account->name . " " . $account->surname;
}

function getCourseName($id)
{
    $course = \App\Models\Courses::select('name')
        ->where('id', $id)
        ->first();

    return $course->name;
}

function getNotificationforCourses()
{
    $course = \App\Models\AccountCourse::select('name')
        ->where('panding', 'unread')
        ->count();

    return $course;
}

function getProfession($id)
{
    return DB::table('professions AS p')
        ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
        ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
        ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
        ->select('s.icon', 'sp.name as edu_name',
            's.name AS spec_name')
        ->where('p.account_id', '=', $id)
        ->first();
}

function getErrorMessage($code)
{
    $message = "";
    switch ($code) {
        case 23000:
            $message = "duplicate_entry";
            break;
        case 4200:
            $message = "syntax_error";
            break;
    }
    return $message;
}

function creditNameByKey($credit)
{
    $test = "";
    if (!empty($credit)) {
        $credit = json_decode($credit, true);
        $test .= "<ul>";
        foreach ($credit as $index => $item) {
            switch ($item['name']) {
                case 'practical':
                    $test .="<li>". __('messages.practical').": ".$item['credit']."</li>" ;
                    break;
                case 'theoretical':
                    $test .= "<li>".__('messages.theoretical').": ".$item['credit']."</li>";
                    break;
                case 'selfeducation':
                    $test .= "<li>".__('messages.selfeducation').": ".$item['credit']."</li>";
                    break;
            }
        }
        $test .= "</ul>";
    }
    return  $test;
}


