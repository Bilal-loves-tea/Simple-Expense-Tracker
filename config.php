<?php
$hostname = 'localhost';
$user = 'root';
$password = '';
$database = 'expense_tracker_1';

$conn = new mysqli($hostname, $user, $password, $database);

if($conn->connect_error){
    die("Server Connection Failed");
}
?>