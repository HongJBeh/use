<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link href="CSS/regcss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require_once './config/helper.php';
        ?>
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr/>
        <?php
        global $id, $name, $gender, $phone, $email, $password, $confirmpw;
        if (!empty($_POST)){
            (isset($_POST['mid']))?
            $id = trim($_POST['mid']):
                $id = "";
            (isset($_POST['mname']))?
            $name = trim($_POST['mname']):
                $name = "";
            (isset($_POST['rbgender']))?
            $gender = trim($_POST['rbgender']):
                $gender = "rbgender";
            (isset($_POST['mphone']))?
            $phone = trim($_POST['mphone']):
                $phone = "";
            (isset($_POST['eb']))?
            $email = trim($_POST['eb']):
                $email = "";
            (isset($_POST['pw']))?
            $password = trim($_POST['pw']):
                $password = "";
            (isset($_POST['cpw']))?
            $confirmpw = trim($_POST['cpw']):
                $confirmpw = "";
            
            $error['mid'] = checkMemberID($id);
            $error['name'] = checkMemberName($name);
            $error['gender'] = checkGender($gender);
            $error['phone'] = checkPhoneNumber($phone);
            $error['email'] = checkEmail($email);
            $error['password'] = checkPassword($password);
            $error['confirmpw'] = checkConfirmPassword($confirmpw, $password);
            $error = array_filter($error);
            
            if (empty($error)){
                $connection = new mysqli(HOST, USER, PASS, NAME);
                $sql = "INSERT INTO member (MemberID, MemberName,Gender,PhoneNumber,Email,Password,ConfirmPassword) VALUES (?,?,?,?,?,?,?)";
                $statement = $connection ->prepare($sql);
                $statement ->bind_param('sssssss', $id, $name, $gender, $phone, $email, $password, $confirmpw);
                $statement ->execute();
                if ($statement -> affected_rows > 0){
                    echo "<div class='va'>
                        User $name is registration is complete, Please <a href = 'login.php'>login</a>.
                         </div>";
                } else {
                    echo "<div class='va'>
                        Unable Register, Please <a href = 'register.php'>Register</a> again!
                         </div>";
                }
                $connection ->close();
                $statement ->close();
            } else {
                echo "<ul class = 'gy'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
        }
        ?>
        <form action="" method="POST">
            <form  id="register">
            
            <div class="you">
            <table>
                <tr>
                    <td>Member/Student ID:</td>
                    <td><input type="text" name="mid" value="<?php echo $id?>" /></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="mname" value="<?php echo $name;?>" /></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <?php
                        $genders = getAllGender();
                        foreach ($genders as $sex => $sexs){
                            printf("<input type='radio' name='rbgender' %s value='%s' />%s", ($gender == $sex)? 'checked' : "", $sex, $sexs);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="text" name="mphone" value="<?php echo $phone;?>" /></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="email" name="eb" value="<?php echo $email;?>"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pw" value="<?php echo $password;?>"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="cpw" value="<?php echo $confirmpw;?>"/></td>
                </tr>
                <tr class="butt">
                    <td><input type="submit" value="Register" name="btnregister" />
                        <input type="button" value="Cancel" name="btncancel" onclick="location='login.php'" />
                    </td>
                </tr>
            </table>
            </div>
             <p>Already have an account? <a href="login.php">Sign in</a>.</p>
            </form>
        </form>
        <?php
        // put your code here
        ?>
        <script src="js/regjs.js" type="text/javascript"></script>
    </body>
</html>
