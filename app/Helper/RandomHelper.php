<?php

namespace App\Helper;

class RandomHelper
{
    /**
     * Generate random float number.
     *
     * @param float|int $min
     * @param float|int $max
     * @return float
     */
    public static function rand($min = 0, $max = 1)
    {
        return ($min + ($max - $min) * (mt_rand() / mt_getrandmax()));
    }
}
