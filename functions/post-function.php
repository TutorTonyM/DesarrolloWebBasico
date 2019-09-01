<?php

require_once('functions/messages-function.php');

function allPosts(){
    require_once('resources/connection.php');

    $active = true;

    $stmt = $con->prepare("SELECT id, category, title, created_by, created_at, post, image FROM posts WHERE active = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $active);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $category, $title, $created_by, $created_at, $post, $image);
        while($stmt->fetch()){
            $post = substr($post, 0, 200);
            $post = substr($post, 0, strrpos($post, ' ')).'...<a href="post.php?post='.$id.'">read more</a>';
            echo '
                <div class="post">
                    <img src="'.$image.'">
                    <p class="category">'.$category.'</p>
                    <h1>'.$title.'</h1>
                    <span>Posted by <em>'.$created_by.'</em> on <em>'.$created_at.'</em></span>
                    <p>'.$post.'</p>
                </div>
            ';
        }
    }
    else{
        echo '
            <div class="post">
                <h1>There are no posts.</h1>
            </div>
        ';
    }

    $stmt->free_result();
    $stmt->close();
    $con->close();
}

function myPosts(){
    require_once('resources/connection.php');

    $user = $_SESSION['user'] ?? '';

    $stmt = $con->prepare("SELECT id, category, title, created_by, created_at, post, image FROM posts WHERE created_by = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $category, $title, $created_by, $created_at, $post, $image);
        while($stmt->fetch()){
            $post = substr($post, 0, 200);
            $post = substr($post, 0, strrpos($post, ' ')).'...<a href="post.php?post='.$id.'">read more</a>';
            echo '
                <div class="post card card-body bg-light w-50 mx-auto mb-5">
                    <img src="'.$image.'">
                    <p class="category">'.$category.'</p>
                    <h1>'.$title.'</h1>
                    <span>Posted by <em>'.$created_by.'</em> on <em>'.$created_at.'</em></span>
                    <p>'.$post.'</p>
                </div>
            ';
        }
    }
    else{
        echo '
            <div class="post">
                <h1 class="text-center">There are no posts.</h1>
            </div>
        ';
    }

    $stmt->free_result();
    $stmt->close();
    $con->close();
}

function singlePost(){
    require_once('resources/connection.php');

    $id = $_GET['post'] ?? '';

    $stmt = $con->prepare("SELECT id, category, title, created_by, created_at, post, image FROM posts WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
    $column = $result->fetch_assoc();
    $stmt->free_result();
    $stmt->close();
    $con->close();

    if($count === 1){
        $editButton = editButton($column['created_by'], $column['id']);
        echo '
            <div class="post card card-body bg-light w-50 mx-auto mb-5">
                <img src="'.$column['image'].'">
                <p class="category">'.$column['category'].'</p>
                <h1>'.$column['title'].'</h1>
                <span>Posted by <em>'.$column['created_by'].'</em> on <em>'.$column['created_at'].'</em></span>
                <p>'.$column['post'].'</p>
                <button class="btn btn-primary btn-lg" onclick="goBack()"><- Back</button>
                '.$editButton.'
            </div>
        ';
    }
    else{
        echo '
            <div class="post">
                <h1 class="text-center">There are no posts.</h1>
            </div>
        ';
    }    
}

function editButton($author, $id){
    $user = $_SESSION['user'] ?? '';
    if($user == $author){
        return '<a class="btn btn-success btn-lg mt-3" href="edit-post.php?post='.$id.'">Edit Post</a>';
    }
}