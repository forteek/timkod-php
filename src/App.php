<?php

namespace App;

use App\Calculator\ConditionalEntropyCalculator;
use App\Calculator\GroupProbabilitiesCalculator;
use App\Factory\GroupFactory;
use Fortek\Console\Console;
use App\Calculator\ProbabilitiesCalculator;
use App\Calculator\EntropyCalculator;

class App
{
    protected readonly Console $console;

    public function __construct()
    {
        $this->console = new Console();
    }

    public function run()
    {
        $file = file_get_contents('./resource/norm_wiki_en.txt');

        $chars = str_split($file);
        $probabilities = ProbabilitiesCalculator::calculate($chars);
        $entropy = EntropyCalculator::calculate($probabilities);
        $this->console->print('[color=blue]Character entropy[/color]: ' . $entropy);

        $words = explode(' ', $file);
        $probabilities = ProbabilitiesCalculator::calculate($words);
        $entropy = EntropyCalculator::calculate($probabilities);
        $this->console->print('[color=blue]Word entropy[/color]: ' . $entropy);

        $files = glob('./resource/*.txt');
        foreach ($files as $file) {
            $this->console->print(PHP_EOL . '[color=magenta]' . $file . '[/color]');
            $file = file_get_contents($file);

            foreach ([1, 2, 3, 4] as $groupSize) {
                $this->console->print('[color=blue]Group size[/color]: ' . $groupSize);
                $chars = str_split($file);
                $groups = GroupFactory::create($chars, $groupSize);
                $groupCount = count($chars) - $groupSize + 1;

                [$probabilities, $attributes] = GroupProbabilitiesCalculator::calculate($groups, $groupCount);
                $entropy = ConditionalEntropyCalculator::calculate($probabilities, $attributes);
                $this->console->print("\t[color=blue]Character[/color]: " . $entropy);

                $words = explode(' ', $file);
                $groups = GroupFactory::create($words, $groupSize);
                $groupCount = count($words) - $groupSize + 1;

                [$probabilities, $attributes] = GroupProbabilitiesCalculator::calculate($groups, $groupCount);
                $entropy = ConditionalEntropyCalculator::calculate($probabilities, $attributes);
                $this->console->print("\t[color=blue]Word[/color]: " . $entropy);
            }
        }
    }
}
