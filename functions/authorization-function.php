<?php

function authorize($item){
    $user = $_SESSION['user'] ?? '';
    if($user != $item){
        header('Location: no-access.php');
    }
}