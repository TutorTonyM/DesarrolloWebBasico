<?php

function alerts($errors){
    $result = '<div class="alert alert-danger"><ul>';
    foreach($errors as $error){
      $result .= "<li>$error</li>";
    }
    $result .= '</ul></div>';
    return $result;
}