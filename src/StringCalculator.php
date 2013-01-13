<?php

class StringCalculator {

    function add($string) {
        $array = $this->buildNumberArray($string);
        $array = $this->checkForNumbersGreaterThan1000($array);
        $this->checkForNegatives($array);
        $total = array_sum($array);
        return $total;
    }

    private function buildNumberArray($string) {
        $matches = array();
        $delimiters = ',|\n';
        if (preg_match("/^\/\/\[?(.*?)\]?\\n/", $string, $matches)) {
            $delimiters = $this->getCustomDelimiters($matches[1]);
            $count = 1;
            $string = str_replace($matches[0], '', $string, $count);
        }
        $array = preg_split("/[" . $delimiters . "]/", $string);
        return $array;
    }

    private function getCustomDelimiters($delimiters) {
        if (strpos($delimiters, '][') !== false) {
            $delimiters = explode('][', $delimiters);
            array_walk($delimiters, 'preg_quote');
            $delimiters = implode('|', $delimiters);
        }
        return $delimiters;
    }

    private function checkForNumbersGreaterThan1000($array) {
        foreach ($array as &$a) {
            if ($a > 1000) {
                $a = 0;
            }
        }
        return $array;
    }

    private function checkForNegatives($array) {
        $negatives = array();
        foreach ($array as $s) {
            if ($s < 0) {
                $negatives[] = $s;
            }
        }
        if (!empty($negatives)) {
            throw new StringCalculatorNegativeNumberException('negatives not allowed ' . implode(',', $negatives));
        }
    }

}

class StringCalculatorNegativeNumberException extends Exception {
    
}