<?php

namespace App\Calculator;

use App\Model\ElementGroup;

class GroupProbabilitiesCalculator
{
    public static function calculate(array $groups, int $groupCount): array
    {
        $probabilities = [];
        $attributes = [];

        foreach ($groups as $sequence => $followers) {
            $groupOccurrences = array_sum($followers);

            foreach ($followers as $character => $occurrences) {
                $followers[$character] = $occurrences / $groupOccurrences;
            }

            $attributes[$sequence] = $groupOccurrences / $groupCount;
            $probabilities[$sequence] = $followers;
        }

        return [$probabilities, $attributes];
    }
}
