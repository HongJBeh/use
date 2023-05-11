<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="CSS/logincss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once './config/helper.php';
        ?>
        <h1>Login</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $id = $_POST["userid"];
            $password = $_POST["password"];

            $conn = new mysqli(HOST, USER, PASS, NAME);
            $sql = "SELECT * FROM member WHERE MemberID = '$id' AND Password = '$password'";
            $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $_SESSION["userid"] = $id;
            setcookie('userid', $id, time() + 365 * 24 * 60 * 60, '/');
            echo "Login succeeded!";
            header('Location: home.php');
        }else {
            echo "Invalid name or password.";
        }if ($id == 'shadow' && $password == '0813'){
            echo "login succeeded!";
            header('Location: adminpanel.php');
        }
        $conn->close();
        }
        ?>
        <form action="" method="POST">
		<div class="log">
			<label for="un"><b>UserID</b></label>
                        <input type="text" placeholder="Enter UserID" name="userid" >

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" >

                        <input type="submit" value="Login" name="loginbtn" />
			<label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
			</label>
		</div>

		<div class="log">
			<p class="psw">Forgot <a href="resetpassword.php">password?</a></p>
                        <p>No account <a href="register.php">register</a>?</p>
			<p><a href="home.php">Back To Menu</a></p>
		</div>
            </form>
        <?php
        // put your code here
        ?>
        <script src="js/loginjs.js" type="text/javascript"></script>
    </body>
</html>
