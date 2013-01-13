<?php

class StringCalculator{
    function add($string){
        $string = preg_split("/[,|\n]/", $string);
        $total = array_sum($string);
        return $total;
    }
}