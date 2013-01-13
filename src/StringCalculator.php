<?php

class StringCalculator{
    function add($string){
        $matches = array();
        if(preg_match("/^\/\/(.*)\\n/", $string, $matches)){
            $delimiter = $matches[1];
            $count = 1;
            $string = str_replace($matches[0], '', $string, $count);
            if(strpos($delimiter, '][') !== false){
                $delimiter = preg_replace('/^\[/', '', $delimiter);
                $delimiter = preg_replace('/\]$/', '', $delimiter);
                $delimiter = explode('][', $delimiter);
                $array = preg_split("/[".implode('|', $delimiter)."]/", $string);
            } else {
                $array = explode($delimiter, $string);
            }
        } else {
            $array = preg_split("/[,|\n]/", $string);
        }
        $array = $this->checkForNumbersGreaterThan1000($array);
        $this->checkForNegatives($array);
        $total = array_sum($array);
        return $total;
    }
    
    private function checkForNumbersGreaterThan1000($array){
        foreach($array as &$a){
            if($a > 1000){
                $a = 0;
            }
        }
        return $array;
    }
    
    private function checkForNegatives($array){
        $negatives = array();
        foreach($array as $s){
            if($s < 0){
                $negatives[] = $s;
            }
        }
        if(!empty($negatives)){
            throw new StringCalculatorNegativeNumberException('negatives not allowed ' . implode(',', $negatives));
        }
    }
}

class StringCalculatorNegativeNumberException extends Exception{}