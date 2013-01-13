<?php

class StringCalculator{
    function add($string){
        $string = explode(',', $string);
        $total = array_sum($string);
        return $total;
    }
}