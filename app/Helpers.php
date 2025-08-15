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

if (!function_exists('removeEspecialChar')) {
    function removeEspecialChar(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }
}