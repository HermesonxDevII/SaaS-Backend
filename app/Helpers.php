<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('loggedUser')) {
    function loggedUser()
    {
        return Auth::user();
    }
}