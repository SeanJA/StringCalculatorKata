<?php

class StringCalculator{
    function add($string){
        return ($string === "")? 0:(int)$string;
    }
}