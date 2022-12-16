<?php

namespace App\Calculator;

class EntropyCalculator
{
    public static function calculate(array $probabilities): float
    {
        $entropy = 0;

        foreach ($probabilities as $probability) {
            $entropy += $probability * log($probability, 2);
        }

        return -$entropy;
    }
}
