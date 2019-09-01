<?php

function rules(){
    $validation = [
        'username' => [
            'pattern' => '/^[a-z][\w]{2,30}$/i',
            'error' => 'Username must be at least 3 characters long. It must start with a letter and it can only have letters, numbers and underscores.'
        ],
        'email' => [
            'pattern' => '/^[a-z]+[\w\-\.]+@([\w\-]{2,}\.)+[\w\-]{2,4}$/i',
            'error' => 'Email must be in a valid format.'
        ],
        'username-or-email' => [
            'pattern' => '/(?=^[a-z]+[\w@\.]{2,50}$)/i',
            'error' => 'Use a valid Username or Email.'
        ],
        'password' => [
            'pattern' => '/(?=^[\w\!@#\$%\^&\*\?]{6,30}$)(?=(.*\d)+)(?=(.*[a-z])+)(?=(.*[A-Z])+)(?=(.*[\!@#\$%\^&\*\?_])*)^.*/',
            'error' => 'Enter a valid password. Password must consist of at least 1 lowercase, 1 uppercase and 1 numbers (special characters are optional).'
        ],
        'category' => [
            'pattern' => '/^[a-z]{4,20}$/i',
            'error' => 'Category can only contain letters.'
        ],
        'title' => [
            'pattern' => '/^[a-z][\w \'#-(),]{4,100}$/i',
            'error' => 'Title can only contain letters, spaces, numbers and the following characters (\' # - ( ) ,). It must start with a letter.'
        ],
        'post' => [
            'pattern' => '/^[a-z][\w \'#-(),\.\?!]{20,}$/i',
            'error' => 'Post can oly contain letters, spaces, numbers and the following characters (\' # - ( ) , . ? !). It must start with a letter.'
        ]
    ];
    return $validation;
}

function validate($fields){

    $errors = [];

    foreach($fields as $name => $display){
        if(!isset($_POST[$name]) || $_POST[$name] == NULL){
            $errors[] = $display.' is a required field.';
        }
        else{
            $rules = rules();
            foreach($rules as $field => $option){
                if($name == $field){
                    if(!preg_match($option['pattern'], $_POST[$name])){
                        $errors[] = $option['error'];
                    }
                }
            }
        }
    }

    return $errors;

}