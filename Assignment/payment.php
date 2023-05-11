<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8"> 
        <title>Payment | Anime Society</title>
        <link href="css/payment.css" rel="stylesheet" type="text/css"/>
        <script src="https://kit.fontawesome.com/6de56e32bf.js" crossorigin="anonymous"></script>
    </head>
    <script>
        function myPayment() {
            alert("You have completed your transaction. Thank You.");
        }
    </script>
    <body>
        <form action="info.php" method="post">    
        <h2>Payment Form</h2>
            <i style="font-size:60px" class ="fab fa-cc-apple-pay"></i>
            <i style="font-size:60px" class ="fab fa-cc-mastercard"></i>
            <i style="font-size:60px" class ="fab fa-cc-paypal"></i>
            <i style="font-size:60px" class ="fab fa-cc-visa"></i>
            <div class="information">
        <div class="group">
            <label for="card"><i class="fa-solid fa-user"></i>Name On Card :</label><br>
            <input type="text" id="card" placeholder="Name on card">
        </div>
        <div class="group">
            <label for="credit"><i class="fa-solid fa-credit-card"></i>Credit Card Number :</label><br>
            <input type="text" id="credit" placeholder="xxxx - xxxx - xxxx - xxxx">
        </div>
        <div class="group">
            <label for="month">Expired Month :</label><br>
            <input type="text" id="month" placeholder="January">
        </div>
        <div class="group">
            <label for="year">Expired year :</label><br>
            <input type="text" id="year" placeholder="2022">
        </div>
        <div class="group">
            <label for="cvv">CVV :</label><br>
            <input type="text" id="cvv" placeholder="123">
        </div>
        <div class="buttom">
            <input type="submit" onclick="myPayment()" value="Confrim">
        </div>
    </div>
  </div>

    </form>
    <body>
</html>
