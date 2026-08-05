<?php
$hostname = 'localhost';
$user = 'bilal';
$password = '';
$database = 'expense_tracker';

$conn = new mysqli($hostname, $user, $password, $database);

if($conn->connect_error){
    die("Connection Failed");
}
?>