<?php

function passwordCompare($value1, $value2){

    $errors = [];

    if($value1 !== $value2){
       $errors[] = 'The passwords don\'t match';
    }

    return $errors;

}