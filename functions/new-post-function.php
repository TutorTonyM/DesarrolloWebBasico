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
            'category' => 'Category',
            'title' => 'Title',
            'post' => 'Post'
        ];

        $errors = validate($fields);

        if(empty($errors)){$errors = saveNewPost();}
    }
    else{
        createMessage('fail', 'Oh no... Your post could not be created due to irregularities in your form.');
    }

}


function saveNewPost(){
    require_once('resources/connection.php');
    

    $category = clean($_POST['category']);
    $title = clean($_POST['title']);
    $post = clean($_POST['post']);
    $username = $_SESSION['user'];
    $image = imageUploader();

    if($image['success']){
        $stmt = $con->prepare("INSERT INTO posts (category, title, post, created_by, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $category, $title, $post, $username, $image['text']);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->free_result();
        $stmt->close();
        $con->close();
    
        if($result === 1){
            createMessageSweet('success', 'Congratulations! you post was published successfully.');
            header('Location: index.php');
            exit;
        }
        else{
            createMessage('fail', 'Oh no... We are experiencing tecnical difficulties and cannont publish your post at this time.');
        }
    }
    else{
        $errors = [];
        $errors[] = $image['text'];
        return $errors;
    }
       
}

function categories(){
    require_once('resources/connection.php');

    $stmt = $con->prepare("SELECT name FROM categories");
    $stmt->execute();
    $stmt->store_result();
    $con->close();

    return $stmt;
}

function imageUploader(){
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $file = $_FILES['image'];

        $imageName = $file['name'];
        $imageTmpName = $file['tmp_name'];
        $imageError = $file['error'];
        $imageSize = $file['size'];

        $imageExtSeparator = explode('.', $imageName);
        $imageNameNoExt = strtolower(current($imageExtSeparator));
        $imageExt = strtolower(end($imageExtSeparator));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($imageExt, $allowed)){
            if($imageError === 0){
                if($imageSize <= 500000){
                    $imageNewName = $imageNameNoExt.'_'.uniqid('', true).'.'.$imageExt; //laravel_1264876354846.png
                    $imageDestination = 'images/posts/'.$imageNewName;
                    move_uploaded_file($imageTmpName, $imageDestination);
                    return array('success' => true, 'text' => $imageDestination);
                }
                else{
                    return array('success' => false, 'text' => 'The image is too big. The maximum size allowed is 500kb');
                }
            }
            else{
                return array('success' => false, 'text' => 'There was an error uploading your image!');
            }
        }
        else{
            return array('success' => false, 'text' => 'You cannot upload files of this type!');
        }
    }
    else{
        return array('success' => true, 'text' => 'images/posts/no-image-available.jpg');
    }
}