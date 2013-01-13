<?php

class StringCalculator{
    function add($string){
        $matches = array();
        if(preg_match("/^\/\/(.)\\n/", $string, $matches)){
            $delimiter = $matches[1];
            $count = 1;
            $string = str_replace($matches[0], '', $string, $count);
            $string = explode($delimiter, $string);
        } else {
            $string = preg_split("/[,|\n]/", $string);
        }
        $negatives = array();
        foreach($string as $s){
            if($s < 0){
                $negatives[] = $s;
            }
        }
        if(!empty($negatives)){
            throw new StringCalculatorNegativeNumberException(implode(',', $negatives));
        }
        $total = array_sum($string);
        return $total;
    }
}

class StringCalculatorNegativeNumberException extends Exception{}