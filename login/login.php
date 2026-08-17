<?php
/*INIT roight?*/
session_start();
require '../config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usr = trim($_POST['username']);
    $pwd = $_POST['password'];
    
    /*Double check verification for idiots*/

    if(strlen($usr) < 3){
        header("Location:./index.php?error=987845653221");
        return;
    }
    if (strlen($pwd) < 8){
        header("Location:./index.php?error=9865325421");
        return;
    }

    /*Goku's Fear Prevention */
    $stmt = $conn->prepare("SELECT id, password_hash from users where username = ?");
    $stmt-> bind_param("s", $usr);
    $stmt-> execute();
    $result = $stmt->get_result();

    if($result->num_rows===1){
        $usr = $result->fetch_assoc();
        if(password_verify($pwd, $usr['password_hash'])){
            session_regenerate_id(true);
            $_SESSION['user_id'] = $usr['id'];
            header("Location: ../expensetracker/");
            $_SESSION['name']=$_POST['username'];
            exit;
        }
    }

    /* MWAHAHAHAH, ERROR MESSAGE. FAK U */
    header("Location: index.php?error=invalid");
    exit();
    //echo "Invalid username or password";
}


?>