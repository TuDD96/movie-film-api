<?php
if (!function_exists('convertCurrency')) {
    function convertCurrency($num)
    {
        return number_format($num, 0);
    }       
}