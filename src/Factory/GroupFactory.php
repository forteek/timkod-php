<?php

namespace App\Factory;

class GroupFactory
{
    public static function create(array $elements, int $groupLength): array
    {
        $groups = [];
        $textLength = count($elements);

        for ($index = 0; $index < $textLength - $groupLength; $index++) {
            $sequence = implode('', array_slice($elements, $index, $groupLength));
            $follower = array_slice($elements, $index + $groupLength, 1)[0];

            if (!isset($groups[$sequence])) {
                $groups[$sequence] = [];
            }

            if (!isset($groups[$sequence][$follower])) {
                $groups[$sequence][$follower] = 0;
            }

            $groups[$sequence][$follower]++;
        }

        return $groups;
    }
}
