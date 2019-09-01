<?php

function field($name, $variable = ''){
    echo $_POST[$name] ?? $variable;
}

function selected($name, $option, $variable = ''){
    if(isset($_POST[$name]) && $_POST[$name] == $option){
        echo 'selected';
    }
    else if($variable == $option){
        echo 'selected';
    }
}

function selectedDb($name, $option, $variable = ''){
    if(isset($_POST[$name]) && $_POST[$name] == $option){
        return 'selected';
    }
    else if($variable == $option){
        return 'selected';
    }
}