<?php

namespace App\Calculator;

class ProbabilitiesCalculator
{
    public static function calculate(array $elements): array
    {
        $probabilities = [];
        $total = count($elements);

        foreach (array_count_values($elements) as $element => $count) {
            $probabilities[$element] = $count / $total;
        }

        return $probabilities;
    }
}
