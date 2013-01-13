<?php

class StringCalculator{
    function add($string){
        $matches = array();
        if(preg_match("/^\/\/(.)\\n/", $string, $matches)){
            $delimiter = $matches[1];
            $count = 1;
            $string = str_replace($matches[0], '', $string, $count);
            $array = explode($delimiter, $string);
        } else {
            $array = preg_split("/[,|\n]/", $string);
        }
        $this->checkForNegatives($array);
        $total = array_sum($array);
        return $total;
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