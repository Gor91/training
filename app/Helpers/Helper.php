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
