<?php session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../");
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
    <div class="div-form hidden" id="form">
        <div class="div-flex-for-not-breaking hidden" id="transaction-type">
            <!-- Type Form Content -->
            <div class="div-form-types">
                <h2 class="heading-trasaction-type">Type of Transaction</h2>        
                <div class="container-trasaction-type-1">
                        <div class="div-container-buying-something" id="sel01">
                            <img width="48" height="48" src="assets/icons/buying_something.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Buying Something</p>
                        </div>
                        <div class="div-container-buying-something" id="sel02">
                            <img width="48" height="48" src="assets/icons/income.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Income</p>
                        </div>
                        <div class="div-container-buying-something" id="sel03">
                            <img width="48" height="48" src="assets/icons/food.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Bought Food</p>
                        </div>
                        <div class="div-container-buying-something" id="sel04">
                            <img width="48" height="48" src="assets/icons/health.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Health/Care</p>
                        </div>
                        <div class="div-container-buying-something" id="sel05">
                            <img width="48" height="48" src="assets/icons/concurring_fee.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Subscription/ Service</p>
                        </div>
                        <div class="div-container-buying-something" id="sel06">
                            <img width="48" height="48" src="assets/icons/clothes.png" alt="shopping-cart-loaded"/>
                            <p class="text-buying-something">Clothings</p>
                        </div>
                </div>
            </div>
            <hr class="dividing-line">
            <div class="div-container-other-types">
                <h3>Other Types: </h3>
                <select id="transactiontype" class="form-transtype" autocomplete="off">
                    <option hidden disabled selected value> -- select an option -- </option>
                    <option value="Maintenance">Maintenance/Repair</option>
                    <option value="Entertainment">Entertainment/Fun</option>
                    <option value="Transport">Transport</option>
                    <option value="Utilities">Daily Utilities</option>                                                            
                    <option value="Repayment">Debt Repayment</option>
                    <option value="Loan">Lent a Loan</option>                
                    <option value="Income">Gift Income</option>
                </select>
                <div class="for-alignment"></div>
                <div class="div-next-button"><button id="button-next-form" class="button-action button-next">Next</button></div>
            </div>
            <hr class="dividing-line dividing-line-1">
            <div class="div-next-button-1"><button class="button-action button-next-1" id="button-next-form-1">Next</button></div>
        </div>
   <!-- Dumb Div, nobody knows -> </div> -->
    

        <!-- Amount and Description Content -->
        <div class="div-flex-for-not-breaking-1 hidden" id="transaction-amount">
            <div class="div-form-amount">
                <input class="input-amount" placeholder="Amount" id="input-amount" type="number">
            </div>
            <div class="div-form-description">
                <input class="input-description" placeholder="Description" id="input-description">
            </div>
            <div class="div-form-button"><button class="button-submit" id="button-submit">Done</button></div>
        </div>
    </div>

    <div class="div-background-blur hidden" id="background-blur"></div>



    <div class="container-logout-button">
        <div class="extra-space"></div>
        <a href="../logout.php" ><button class="button-logout">Logout</button></a>
    </div>
    <div class="container">
        <h1 class="text-welcome">Welcome, <?php echo "<span> $y!</span>"?></h1>
        <div class="container-buttons">
            <button class="button-action" id="button-1">Record</button>
            <div class="container-buttons-2">
                <button class="button-action" id="button-2">View/Edit</button>            
                <button class="button-action" id="button-3">Summary</button>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>