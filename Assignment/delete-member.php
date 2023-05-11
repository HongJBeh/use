<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Member</title>
        <link href="CSS/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body>
        <?php
        include './adminheader.php';
        require_once './config/helper.php';
        ?>
        <h1>Delete Member</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"]== 'GET'){
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
                printf("<p class='tg'>Are you sure you want to delete the following member? </p>
                    <table border =1>
                    <tr>
                    <td>Member ID : </td>
                    <td> %s </td>
                    </tr>
                    <tr>
                    <td>Member Name : </td>
                    <td> %s </td>
                    </tr>
                    <tr>
                    <td>Gender : </td>
                    <td> %s </td>
                    </tr>
                    <tr>
                    <td>Phone Number : </td>
                    <td> %s </td>
                    </tr>
                    <tr>
                    <td>Email : </td>
                    <td> %s </td>
                    </tr>
                    </table>
                    <form action = '' method = 'POST'>
                    <input type='hidden' name='hfid' value='%s' />
                    <input type='hidden' name='hfname' value='%s' />
                    <input type='submit' value='Yes' name='btnyes' />
                    <input type='button' value='Cancel' name='btncancel' onclick = 'location = \"adminmember.php\"' />
                    </form>
                    ", $id, $name, $gender, $phone, $email, $id, $name);
            } else {
                echo "<div style='padding-left:80px; padding-top:80px;'>Unable to retrieve record![ <a href= 'adminmember.php'>Back to list.</a> ]</div>";
            }
        } else {
            $id = strtoupper(trim($_POST["hfid"]));
            $name = trim($_POST["hfname"]);
            
            $con = new mysqli(HOST, USER, PASS, NAME);
            
            $sql = "DELETE FROM member WHERE MemberID = ?";
            
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                echo "<div style='padding-left:80px; padding-top:80px;'>
                    <a href = 'adminmember.php'>Back to list</a>
                        Member $name is deleted!
                        </div>";
            } else {
                echo "<div style='padding-left:80px; padding-top:80px;'>
                    <a href = 'adminmember.php'>Back to lists</a>
                    Unable to deleted
                    </div>";
            }
            $con->close();
            $stmt->close();
        }
        ?>
    </body>
</html>
