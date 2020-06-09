<?php
// Code within app\Helpers\Helper.php

use Illuminate\Support\Facades\Auth;

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
