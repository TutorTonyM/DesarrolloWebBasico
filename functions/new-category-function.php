<?php
require_once('functions/clean-function.php');
require_once('functions/token-function.php');
require_once('functions/server-validation-function.php');
require_once('functions/alert-function.php');
require_once('functions/field-function.php');
require_once('functions/messages-function.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['token']) && compare_token($_POST['token']) && empty($_POST['company'])){
        $fields = [
            'category' => 'Category Name'
        ];

        $errors = validate($fields);

        if(empty($errors)){saveNewCategory();}
    }
    else{
        createMessage('fail', 'Oh no... Your category could not be created due to irregularities in your form.');
    }

}


function saveNewCategory(){
    require_once('resources/connection.php');    

    $category = clean($_POST['category']);

    $stmt = $con->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->affected_rows;
    $stmt->free_result();
    $stmt->close();
    $con->close();

    if($result === 1){
        createMessageSweet('success', 'Congratulations! you category was created successfully.');
        header('Location: new-post.php');
        exit;
    }
    else{
        createMessage('fail', 'Oh no... We are experiencing tecnical difficulties and cannont create the new category at this time.');
    }

    
}