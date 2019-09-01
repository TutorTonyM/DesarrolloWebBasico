<?php
require_once('functions/clean-function.php');
require_once('functions/token-function.php');
require_once('functions/server-validation-function.php');
require_once('functions/alert-function.php');
require_once('functions/field-function.php');
require_once('functions/messages-function.php');
require_once('functions/token-function.php');
require_once('functions/mail-function.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['token']) && compare_token($_POST['token']) && empty($_POST['company'])){
        $fields = [
            'email' => 'Email'
        ];

        $errors = validate($fields);

        if(empty($errors)){forgotPassword();}
    }
    else{
        createMessage('fail', 'Oh no... The reset password email could not be snet.');
    }

}


function forgotPassword(){
    require_once('resources/connection.php');
    $errors = [];

    $email = clean($_POST['email']);

    $stmt = $con->prepare("SELECT email, username, id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
    $column = $result->fetch_assoc();
    $stmt->free_result();
    $stmt->close();

    if($count === 1){
        $id = $column['id'];
        $username = $column['username'];
        $code = create_token(false, 32);

        $stmt = $con->prepare("UPDATE users SET reset_code = ? WHERE email = ?");
        $stmt->bind_param("ss", $code, $email);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->free_result();
        $stmt->close();
        $con->close();
        
        if($result === 1){
            createMessage('success', 'Great! an email with a link to reset your password has been snet to you.');
            header('Location: login.php');
            sendResetPasswordEmail($email, $username, $code, $id);
            exit;
        }
        else{
            $errors[] = 'There was an error and we cannot send you the reset password email.';
        }
    }
    else{
        $errors[] = 'The email provided could not be virified.';
    }

    return $errors;
}