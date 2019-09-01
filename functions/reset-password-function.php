<?php
require_once('functions/clean-function.php');
require_once('resources/connection.php');
require_once('functions/token-function.php');
require_once('functions/server-validation-function.php');
require_once('functions/alert-function.php');
require_once('functions/field-function.php');
require_once('functions/password-compare-function.php');
require_once('functions/messages-function.php');

$result = false;

if(isset($_GET['transaction']) && isset($_GET['code'])){
    $id = clean($_GET['transaction']);
    $code = clean($_GET['code']);

    $stmt = $con->prepare("SELECT reset_code FROM users WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $db_result = $stmt->get_result();
    $count = mysqli_num_rows($db_result);
    $column = $db_result->fetch_assoc();
    $stmt->free_result();
    $stmt->close();

    if($count == 1){
        if($code === $column['reset_code']){
            $result = true;
        }
        else{
            $result = false;
        }
    }
    else{
        $result = false;
    }

}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['token']) && compare_token($_POST['token']) && empty($_POST['company'])){
        $fields = [
            'password' => 'Password'
        ];
    
        $errors = validate($fields);
        $errors = array_merge($errors, passwordCompare($_POST['password'], $_POST['repassword']));
    
        if(empty($errors)){resetPassword($con, $id);}  
    }
    else{
        createMessage('fail', 'Oh no... Your password could not be reseted.');
    }

}

function resetPassword($con, $id){
    $code = null;
    $rawPassword = clean($_POST['password']);
    $password = password_hash($rawPassword, PASSWORD_DEFAULT);

    $stmt = $con->prepare("UPDATE users SET reset_code = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sss", $code, $password, $id);
    $stmt->execute();
    $count = $stmt->affected_rows;
    $stmt->free_result();
    $stmt->close();
    $con->close();

    if($count == 1){
        createMessage('success', 'Congratulations! Your password has been successfully changed.');
        header('Location: login.php');
    }
    else{
        createMessage('fail', 'Oh no... Your password could not be reseted.');
    }

}