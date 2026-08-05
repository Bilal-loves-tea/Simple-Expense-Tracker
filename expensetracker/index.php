<?php session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../expensetracker/");
    exit();
}
$y = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome,<?php echo "<span> $y!</span>"?></h1>
        
    </div>
</body>
</html>