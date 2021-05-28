<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringConverterController extends Controller
{
    const MISSING_SENTENCE_ERROR = "Sentence is missing or empty! Please insert sentences in your request with sentences as the key";
    const CSV_CREATED = "CSV created! Please check a file called result_api.csv in public folder";

    public function capsLock(Request $request) {
        $sentences = $request->query('sentences','You need to insert sentences in the query parameter with setences as the key');
        return Response(['result' => strtoupper(trim($sentences))]);
    }

    public function alternate(Request $request) {
        $sentences = trim($request->get('sentences'));
        if(is_null($sentences) || empty($sentences)) {
            return Response(['result' => self::MISSING_SENTENCE_ERROR], 500);
        }
        else {
            $sentenceIndex = 0;
            $explodedSentences = collect(str_split($sentences));
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
            return Response(['result' => implode("", $formattedSentences->toArray())]);
        }
    }

    public function savecsv(Request $request) {
        $sentences = trim($request->get('sentences'));
        if(is_null($sentences) || empty($sentences)) {
            return Response(['result' => self::MISSING_SENTENCE_ERROR], 500);
        }
        else {
            $fp = fopen('result_api.csv', 'w');
            $formattedSentences = str_replace('"', '', str_split($sentences));
            fputcsv($fp, $formattedSentences);
            fclose($fp);

            return Response(['result' => self::CSV_CREATED]);
        }
    }
}
