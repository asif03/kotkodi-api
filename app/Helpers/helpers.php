<?php

if (!function_exists('public_path')) {
    /**
     * Return the path to public dir
     *
     * @param null $path
     *
     * @return string
     */
    function public_path($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

function generateOrderCode($strCount, $numCount)
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    return substr(str_shuffle($str), 0, $strCount) . substr(str_shuffle($num), 0, $numCount);
}

function getCurrentUser()
{
    return auth('api')->user();
}

function getCurrentUserId()
{
    return auth('api')->user()->id;
}