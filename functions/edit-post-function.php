<?php
require_once('functions/clean-function.php');
require_once('functions/token-function.php');
require_once('functions/server-validation-function.php');
require_once('functions/alert-function.php');
require_once('functions/field-function.php');
require_once('functions/messages-function.php');
require_once('functions/authorization-function.php');
require_once('resources/connection.php');

$id = $_GET['post'] ?? '';
$stmt = $con->prepare("SELECT id, category, title, created_by, created_at, post FROM posts WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$count = mysqli_num_rows($result);
$column = $result->fetch_assoc();
$stmt->free_result();
$stmt->close();

if($count === 1){
    authorize($column['created_by']);
    $id = $column['id'];
    $category = $column['category'];
    $title = $column['title'];
    $post = $column['post'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['token']) && compare_token($_POST['token']) && empty($_POST['company'])){
        $fields = [
            'category' => 'Category',
            'title' => 'Title',
            'post' => 'Post'
        ];

        $errors = validate($fields);

        if(empty($errors)){updatePost($con, $id);}
    }
    else{
        createMessage('fail', 'Oh no... Your post could not be updated due to irregularities in your form.');
    }

}


function updatePost($con, $id){    

    $category = clean($_POST['category']);
    $title = clean($_POST['title']);
    $post = clean($_POST['post']);

    $stmt = $con->prepare("UPDATE posts SET category = ?, title = ?, post = ? WHERE id = ?");
    $stmt->bind_param("sssi", $category, $title, $post, $id);
    $stmt->execute();
    $result = $stmt->affected_rows;
    $stmt->free_result();
    $stmt->close();
    $con->close();

    if($result === 1){
        createMessageSweet('success', 'Congratulations! you post was updated successfully.');
        header('Location: my-posts.php');
        exit;
    }
    else{
        createMessage('fail', 'Oh no... We are experiencing tecnical difficulties and cannont update your post at this time.');
    }

    
}