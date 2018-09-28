<?php

/**
 * @param $str
 * @param string $color
 * @return bool|string
 * CLI上の文字色を変更する.
 */
function color($str, $color = 'white')
{
    $colors = [
        'black' => '0;30',
        'blue' => '0;34',
        'green' => '0;32',
        'cyan' => '0;36',
        'red' => '0;31',
        'purple' => '0;35',
        'brown' => '0;33',
        'light-gray' => '0;37',
        'dark-gray' => '1;30',
        'light-blue' => '1;34',
        'light-green' => '1;32',
        'light-cyan' => '1;36',
        'light-red' => '1;31',
        'light-purple' => '1;35',
        'yellow' => '1;33',
        'white' => '1;37',
    ];

    if (is_null($str) || is_null($color)) return false;

    $color = strtolower($color);
    if (!isset($colors[$color])) return false;

    echo "\033[$colors[$color]m$str\033[0m\n";
}