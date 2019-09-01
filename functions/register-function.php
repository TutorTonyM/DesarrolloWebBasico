<?php
require_once('functions/mail-function.php');
require_once('functions/clean-function.php');
require_once('functions/token-function.php');
require_once('functions/server-validation-function.php');
require_once('functions/alert-function.php');
require_once('functions/field-function.php');
require_once('functions/password-compare-function.php');
require_once('functions/messages-function.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['token']) && compare_token($_POST['token']) && empty($_POST['company'])){
        $fields = [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password'
        ];
    
        $errors = validate($fields);
        $errors = array_merge($errors, passwordCompare($_POST['password'], $_POST['repassword']));
    
        if(empty($errors)){$errors = register();}  
    }
    else{
        createMessage('fail', 'Oh no... The registration failed.');
    }

}


function register(){
    require_once('resources/connection.php');

    $username = clean($_POST['username']);
    $email = clean($_POST['email']);

    $errors = duplication($con, $username, $email);
    if(!empty($errors)){ return $errors; }

    $rawPassword = clean($_POST['password']);
    $password = password_hash($rawPassword, PASSWORD_DEFAULT);
    $emailCode = create_token(false, 15);

    $stmt = $con->prepare("INSERT INTO users (username, email, password, email_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $emailCode);
    $stmt->execute();
    $result = $stmt->affected_rows;
    $id = $con->insert_id;
    $stmt->free_result();
    $stmt->close();

    if($result === 1){
        $_SESSION['user'] = $username;
        createMessage('success', 'Congratulations! you have registered successfully.');
        header('Location: index.php');
        sendWelcomeEmail($email, $username, $emailCode, $id);
        exit;
    }
    else{
        $errors[] = 'We are experiencing problems and we cannot create your account at the time.';
    }
}

function duplication($con, $username, $email){
    $errors = [];

    $stmt = $con->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
    $column = $result->fetch_assoc();
    $stmt->free_result();
    $stmt->close();
    $con->close();
    
    if($count > 0){
        if($username == $column['username']){
            $errors[] = 'The username is not available.';
        }
        if($email == $column['email']){
            $errors[] = 'The email is already in use by another user.';
        }
    }

    return $errors;
}