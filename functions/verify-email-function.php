<?php
require_once('functions/clean-function.php');
require_once('resources/connection.php');

$result = validateLink($con);

function validateLink($con){

    $result = false;

    if(isset($_GET['transaction']) && isset($_GET['code'])){
        $id = clean($_GET['transaction']);
        $code = clean($_GET['code']);
        
        $stmt = $con->prepare("SELECT email_code FROM users WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $db_result = $stmt->get_result();
        $count = mysqli_num_rows($db_result);
        $column = $db_result->fetch_assoc();
        $stmt->free_result();
        $stmt->close();

        if($count == 1){
            if($code === $column['email_code']){
                $result = confirmEmail($con, $id);
            }
            else{
                $result = false;
            }
        }
        else{
            $result = false;
        }
    }

    return $result;
}

function confirmEmail($con, $id){
    $verified = 1;
    $code = null;

    $stmt = $con->prepare("UPDATE users SET email_code = ?, email_verified = ? WHERE id = ?");
    $stmt->bind_param("sis", $code, $verified, $id);
    $stmt->execute();
    $count = $stmt->affected_rows;
    $stmt->free_result();
    $stmt->close();
    $con->close();

    if($count == 1){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}