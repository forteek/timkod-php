<?php

namespace App\Calculator;

class ConditionalEntropyCalculator
{
    public static function calculate(array $probabilities, array $attributes): float
    {
        $entropy = 0;

        foreach ($attributes as $sequence => $probability) {
            foreach ($probabilities[$sequence] as $value) {
                $entropy += $probability * $value * log($value, 2);
            }
        }

        return -$entropy;
    }
}
