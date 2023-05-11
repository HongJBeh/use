<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Member</title>
        <link href="CSS/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body>
        <?php
        include './adminheader.php';
        require_once './config/helper.php';
        ?>
        <h1>Edit Member</h1>
        <?php
        global $hideForm;
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            (isset($_GET["id"]))?
            $id = strtoupper(trim($_GET["id"])):
                $id = "";
            
            $con = new mysqli(HOST, USER, PASS, NAME);
            
            $sql = "SELECT * FROM member WHERE MemberID = '$id'";
            
            $result = $con->query($sql);
            if($record = $result->fetch_object()){
                $id = $record->MemberID;
                $name = $record->MemberName;
                $gender = $record->Gender;
                $phone = $record->PhoneNumber;
                $email = $record->Email;
                $password = $record->Password;
            } else {
                echo "<div style='padding-left:80px; padding-top:80px;'>Unable to retrieve record. [ <a href='adminmember.php'>Back to Admin Member</a> ]</div>";
                $hideForm = true;
            }
            $con->close();
            $result->free();
        } else {
            $name = trim($_POST["mname"]);
            $gender = trim($_POST['rbgender']);
            $phone = trim($_POST["mphone"]);
            $email = trim($_POST["eb"]);
            $password = trim($_POST["pw"]);
            $id = strtoupper(trim($_POST["hfid"]));
            
            $error['name'] = checkMemberName($name);
            $error['gender'] = checkGender($gender);
            $error['phone'] = checkPhoneNumber($phone);
            $error['email'] = checkEmail($email);
            $error['password'] = checkPassword($password);
            
            $error = array_filter($error);
            
            if (empty($error)){
                $con = new mysqli(HOST, USER, PASS, NAME);
                
                $sql = "UPDATE member SET MemberName = ?, Gender = ?, PhoneNumber = ?, Email = ?, Password = ? WHERE MemberID = ?";
                
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssssss", $name, $gender, $phone, $email, $password, $id);
                
                if ($stmt->execute()){
                    echo "<div style='padding-left:80px; padding-top:80px;'>
                         Edit Completed!
                         <a href= 'adminmember.php'>Back to Admin Member</a>
                         </div>";
                } else {
                    echo "<div style='padding-left:80px; padding-top:80px;''>
                        Unable to Edit!
                        <a href= 'adminmember.php'>Back to Admin Member</a>
                         </div>";
                }
                $con->close();
                $stmt->close();
            } else {
                echo "<ul style='padding-left:80px; padding-top:80px;'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
        }
        ?>
        <?php if($hideForm == false) : ?>
        <form action="" method="POST">
            <table class="tg">
                <tr>
                    <td>Member ID:</td>
                    <td>
                        <?php echo $id; ?>
                        <input type="hidden" name="hfid" value="<?php echo $id; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="mname" value="<?php echo $name;?>" />
                    </td>
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
                    <td>
                        <input type="phone" name="mphone" value="<?php echo $phone;?>" />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="eb" value="<?php echo $email;?>" />
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="pw" value="<?php echo $password;?>" />
                    </td>
                </tr>
            </table>
            <input type="submit" value="Update" name="btnupdate" />
            <input type="button" value="Cancel" name="btncancel" onclick="location='adminmember.php'"/>
        </form>
        <?php endif; ?>
    </body>
</html>
