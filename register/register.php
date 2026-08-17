<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usr = trim($_POST['username']);
    $pwd = $_POST['password'];

    if(strlen($usr) < 3){
        header("Location:./index.php?error=987845653221");
        return;
    }
    if (strlen($pwd) < 8){
        header("Location:./index.php?error=9865325421");
        return;
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $usr);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        header("Location:./index.php?error=8754653221");
        return;
    }

    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(username, password_hash) VALUES(?, ?)");
    $stmt-> bind_param("ss", $usr, $hash);
    $stmt-> execute();

    header("Location:../login/index.php?status=success");
    //echo "Register Complete, You can Log in now";
}
?>