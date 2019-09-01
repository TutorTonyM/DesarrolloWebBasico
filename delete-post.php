<?php
require_once('functions/messages-function.php');
require_once('resources/connection.php');

$id = $_GET['post'];

$stmt = $con->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->affected_rows;
$stmt->free_result();
$stmt->close();
$con->close();

if($result === 1){
    createMessageSweet('success', 'Congratulations! you post was delted successfully.');
    header('Location: my-posts.php');
    exit;
}
else{
    createMessage('fail', 'Oh no... We are experiencing tecnical difficulties and cannont delete your post at this time.');
}