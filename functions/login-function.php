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
            'username-or-email' => 'Username or Email',
            'password' => 'Password'
        ];
    
        $errors = validate($fields);
    
        if(empty($errors)){$errors = login();}  
    }
    else{
        createMessage('fail', 'Oh no... The login proccess failed.');
    }

}


function login(){
    require_once('resources/connection.php');
    $errors = [];

    $usernameOrEmail = clean($_POST['username-or-email']);
    $password = clean($_POST['password']);

    $stmt = $con->prepare("SELECT username, password, id, attempt, blocked FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = mysqli_num_rows($result);
    $column = $result->fetch_assoc();
    $stmt->free_result();
    $stmt->close();

    if($count === 1){

        $errors = bruteForce($con, $column['id'], $column['attempt'], $column['blocked']);
        if(!empty($errors)){return $errors;}

        if(password_verify($password, $column['password'])){
            $attempt = 0;
            $blocked = Null;
            $id = $column['id'];
            $stmt = $con->prepare("UPDATE users SET attempt = ?, blocked = ?  WHERE id = ?");
            $stmt->bind_param("isi", $attempt, $blocked, $id);
            $stmt->execute();
            $stmt->free_result();
            $stmt->close();
            $con->close();

            $username = $column['username'];
            $_SESSION['user'] = $username;
            createMessage('success', "Welcome $username! you have successfully logged in.");
            header('Location: index.php');
            exit;
        }
        else{
            $errors[] = 'The credentials provided do not match our records';
        }
    }
    else{
        $errors[] = 'The credentials provided do not match our records';
    }

    return $errors;
}

function bruteForce($con, $id, $attempt, $blocked){
    $errors = [];
    $attempt = $attempt + 1;

    $stmt = $con->prepare("UPDATE users SET attempt = ? WHERE id = ?");
    $stmt->bind_param("ii", $attempt, $id);
    $stmt->execute();
    $stmt->free_result();
    $stmt->close();

    if($attempt == 5){
        $time = date('Y-m-d H:i:s');
        $stmt = $con->prepare("UPDATE users SET blocked = ? WHERE id = ?");
        $stmt->bind_param("si", $time, $id);
        $stmt->execute();
        $stmt->free_result();
        $stmt->close();
        $con->close();
        $errors[] = 'This account has been blocked for the next 15 minutes';
    }
    elseif($attempt > 5){
        $elapsedTime = strtotime(date('Y-m-d H:i:s')) - strtotime($blocked);
        $waitTime = ceil((900 - $elapsedTime) / 60);
        if($elapsedTime < 60){
            $errors[] = "This account has been blocked for the next $waitTime minutes";
        }
        else{
            $attempt = 1;
            $blocked = Null;
            $stmt = $con->prepare("UPDATE users SET attempt = ?, blocked = ? WHERE id = ?");
            $stmt->bind_param("isi", $attempt, $blocked, $id);
            $stmt->execute();
            $stmt->free_result();
            $stmt->close();
        }
    }

    return $errors;
}