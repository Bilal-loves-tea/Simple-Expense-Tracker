<!--REDIRECT THE FLIPPING BASTARD. Trying to be smart eh?-->
<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: ../expensetracker/");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../assets/cash-machine.png">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="start-container">

        <form class="form-register" method="post" action="login.php">
            <h1 class="">Login</h1>
            
            <!--Shows Error Message-->
            <?php 
                if(isset($_GET['error']) && $_GET['error'] === 'invalid'){
                    echo "<span>Invalid Username or Password</span>";
            
                }
                if(isset($_GET['status']) && $_GET['status'] === 'success'){
                    echo "<span>Registration Successful, Now Login</span>";
                    return;
                }
                if(isset($_GET['error']) && $_GET['error'] === '987845653221'){
                    echo "<span>Username must be 3+ characters</span>";
                }
                if(isset($_GET['error']) && $_GET['error'] === '9865325421'){
                    echo "<span>Password must at least 8+ characters</span>";
                }
            ?>
            <div class="div-register-input">
                <input class="form-input" type="text" name="username" placeholder="username" id="username" required>
                <input class="form-input" type="password" name="password" placeholder="password" id="password" required>
            </div>
            <button class="button-submit" id="submit-login">Login</button>
            <p>Don't have an Account? <a href="../register/">register</a></p>
        </form>
    </div>

    <!--Removes URL Parametres-->
    <script>
        if (window.history.replaceState){
            window.history.replaceState(null,null,window.location.pathname)
        }
    </script>


</body>
</html>