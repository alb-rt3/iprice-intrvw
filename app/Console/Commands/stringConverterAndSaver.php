<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StringConverterAndSaver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:stringConverterAndSaver {text?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'String Converter and Save the result in CSV for iPrice';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $sentences = [];
        $inputArgument = $this->argument('text');
        if(is_null($inputArgument)){
            print("\nWelcome to Albert's program!.\n");
            print("Write as many word as possible. End your input by pressing enter with empty or space in next line\n");
            do {
                $sentence = trim(readline());
                if (empty($sentence)) {
                    break;
                } else {
                    array_push($sentences, $sentence);
                }
            } while (end($sentences) != "");
        }
        else {
            array_push($sentences, $inputArgument);
        }


        $upperCaseString = $this->printCapsLockStrings($sentences);
        $alternateString = $this->printAlternateStrings($sentences);
        $this->saveStringInCsv($sentences);
    }

    private function printCapsLockStrings($sentences) {
        $formattedSentences = collect($sentences)->map(function ($sentence, $index) {
            return strtoupper($sentence);
        })->toArray();
        print_r(implode("\n", $formattedSentences). "\n");
        return $formattedSentences;
    }

    private function printAlternateStrings($sentences) {
        return collect($sentences)->each(function ($item, $index) {
            $sentenceIndex = 0;
            $explodedSentences = collect(str_split($item));
            $formattedSentences = $explodedSentences->map(function ($item, $index) use (&$sentenceIndex) {
                if (empty(trim($item))) {
                    $sentenceIndex = 0;
                } else if (ctype_alpha($item)) {
                    $transformedLetter = $sentenceIndex % 2 == 0 ? strtolower($item) : strtoupper($item);
                    $sentenceIndex++;
                    return $transformedLetter;
                }
                return $item;
            });
            $mergedFormattedSentences = collect($formattedSentences)->implode('');
            print_r($mergedFormattedSentences. "\n");
            return $formattedSentences->toArray();
        });
    }

    private function saveStringInCsv($sentences) {
        if(count($sentences) > 0) {
            $fp = fopen('result.csv', 'w');

            foreach ($sentences as $fields) {
                $formattedArray = str_replace('"', '', str_split($fields));
                fputcsv($fp, $formattedArray);
            }
            fclose($fp);
            print_r("CSV created!");
        }
    }
}
