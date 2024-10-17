<?php

require "Database.php";

function colorLog(string $str, string $type = 'i'): void
{
    $colors = [
        'e' => 31, //error
        's' => 32, //success
        'w' => 33, //warning
        'i' => 36  //info
    ];
    $color = $colors[$type] ?? 0;
    echo "\033[".$color."m".$str."\033[0m\n";
}