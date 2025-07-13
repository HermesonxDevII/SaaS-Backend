<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('loggedUser')) {
    function loggedUser()
    {
        return Auth::user();
    }
}

if (!function_exists('getStatus')) {
    function getStatus(int $value): string {
        if ($value === 1) {
            return 'Ativo';
        } else {
            return 'Inativo';
        }
    }
}