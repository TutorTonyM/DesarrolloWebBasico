<?php

function create_token($session = true, $lenght = 32){

    $token = bin2hex(random_bytes($lenght));

    if($session){
        $_SESSION['token'] = $token;
    }

    return $token;

}

function compare_token($token){
    if(isset($_SESSION['token']) && $_SESSION['token'] === $token){
        unset($_SESSION['token']);
        return true;
    }
    return false;
}