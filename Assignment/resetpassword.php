<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="CSS/resetcss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once './config/helper.php';
        ?>
        <h1>Reset Password</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            (isset($_GET["id"]))?
            $id = strtoupper(trim($_GET["id"])):
                $id = "";
            
            $con = new mysqli(HOST, USER, PASS, NAME);
            
            $sql = "SELECT * FROM member WHERE MemberID = '$id'";
            
            $result = $con->query($sql);
            if($record = $result->fetch_object()){
                $id = $record->MemberID;
                $password = $record->Password;
                $confirmpw = $record->ConfirmPassword;
            } else {
                echo "<div>Unable to reset the password. [ <a href='login.php'>Back to login</a> ]</div>";
                $hideForm = true;
            }
            $con->close();
            $result->free();
        }else {
            $password = trim($_POST["pw"]);
            $confirmpw = trim($_POST['cpw']);
            $id = strtoupper(trim($_POST["id"]));
            
            $error['mid'] = checkMemberID($id);
            $error['password'] = checkPassword($password);
            $error['confirmpw'] = checkConfirmPassword($confirmpw, $password);
            
            $error = array_filter($error);
            
            if (empty($error)){
                $con = new mysqli(HOST, USER, PASS, NAME);
                
                $sql = "UPDATE member SET Password = ?, ConfirmPassword = ? WHERE MemberID = ?";
                
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sss", $password, $confirmpw, $id);
                
                if ($stmt->execute()){
                    echo "<div class='ad'>
                         Reset Password Completed!
                         <a href= 'login.php'>Back to login</a>
                         </div>";
                } else {
                    echo "<div class='da'>
                        Unable to Reset Password!
                        <a href= 'login.php'>Back to login</a>
                         </div>";
                }
                $con->close();
                $stmt->close();
            }else {
                echo "<ul class='ad'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
        }
            
        ?>
        <?php if($hideForm != false) : ?>
        <form id="reset-password-form" action="" method="POST">
            <table>
                <tr>
                    <td>Member ID:</td>
                    <td>
                    
                    <input type="text" name="id" value="" />
                </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" id="password" name="password" minlength="8" required>
                    </td>
                </tr>
                <tr>
                    <td>Confirm New Password:</td>
                    <td>
                        <input type="password" id="confirm-password" name="confirm-password" minlength="8" required>
                    </td>
                </tr>
            </table>   
            <button class="cen" type="submit" id="submit-btn">Reset Password</button>
        </form>
        <?php endif; ?>
        <script src="js/resetjs.js" type="text/javascript"></script>
    </body>
</html>
