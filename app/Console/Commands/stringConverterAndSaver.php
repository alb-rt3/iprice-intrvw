<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class stringConverterAndSaver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:stringConverterAndSaver';

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
        print("Welcome to Albert's program!.\n");
        print("Write as many word as possible. End your input by pressing enter with empty or space in next line \n");
        $sentences = [];
        do {
            $sentence = trim(readline());
            if (empty($sentence)) {
                break;
            } else {
                array_push($sentences, trim($sentence));
            }
        } while (end($sentences) != "");
        print_r(strtoupper(implode("\n", $sentences)) . "\n");

        collect($sentences)->each(function ($item, $index) {
            $sentenceIndex = 0;
            $explodedSentence = collect(str_split($item));
            $formattedSentence = $explodedSentence->map(function ($item, $index) use (&$sentenceIndex) {
                if (empty(trim($item))) {
                    $sentenceIndex = 0;
                } else if (ctype_alpha($item)) {
                    $transformedLetter = $sentenceIndex % 2 == 0 ? strtolower($item) : strtoupper($item);
                    $sentenceIndex++;
                    return $transformedLetter;
                }
                return $item;
            });
            print_r(collect($formattedSentence)->implode('') . "\n");
        });

        if(count($sentences) > 0) {
            $fp = fopen('file.csv', 'w');

            foreach ($sentences as $fields) {
                $formattedArray = str_replace('"', '', str_split($fields));
                fputcsv($fp, $formattedArray);
            }
            fclose($fp);
            print_r("CSV created!");
        }
        return 0;
    }
}
