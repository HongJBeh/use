<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>LogOut</title>
        <link href="CSS/logincss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once './config/helper.php';
        ?>
        <h1>Log Out</h1>
        <?php
        $_SESSION["userid"] = null;
        $_SESSION["loggedin"] = false;
        
        setcookie('userid', '', time() - 365 * 24 * 60 * 60, '/');
        
        header('Location: home.php');
        exit;
        ?>
        <p>Are you sure you want to log out?</p>
        <form method="POST">
            <button type="submit" name="logoutbtn">Log Out</button>
        </form>
    </body>
</html>
