<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Info | Anime Society</title>
        <link href="css/info.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<style>
    
.error{
    border: 2px solid black;
    background-color: pink;
    color: brown;
    list-style-position: inside;
}

.error, .correct{
    margin: 5px;
    padding:5px;
    width: 70%;
}

.correct {
    border: 2px solid black;
    background-color: lightblue;
    color: navy;
    font-size: larger;
}
</style>
    </head>
    <body>
        <?php 
         require_once './config/helper.php';
         
            if (!isset($_COOKIE['userid'])) {
                header('Location: login.php');
                }
        ?>
        
        <h1>Complete Your Ticket Detail</h1>
        
        <?php 
        global $tid, $username, $email, $contact;
        if (!empty($_POST)){
            
            (isset($_POST['tid']))?
            $tid = trim($_POST['tid']):
            $tid = "";
            (isset($_POST['username']))?
            $username = trim($_POST['username']):
            $username = "";
            (isset($_POST['email']))?
            $email = trim($_POST['email']):
            $email = "";
            (isset($_POST['contact']))?
            $contact = trim($_POST['contact']):
            $contact = "";

            
            $error['tid'] = checkTicketID($tid);
            $error['username'] = checkUsernameError($username);
            $error['email'] = checkEmailError($email);
            $error['contact'] = checkContact($contact);
            $error = array_filter($error);
            
            if (empty($error)) {
                //GOOD insert record later
                $connection = new mysqli(HOST, USER, PASS, NAME);
                $sql = "INSERT INTO ticket (TicketID,UserName,ticket_email,ticket_contact) VALUES (?,?,?,?)";
                $statement = $connection -> prepare($sql);
                $statement ->bind_param('ssss', $tid, $username, $email, $contact);
                $statement ->execute();
                if ($statement->affected_rows > 0){
                    //record successfully
                    echo "<div class='correct'><a href='complete.php'>
                       Next to complete</a>
                       Personal info $username is completed
                       </div>";
                }else{
                    //records are unable to be inserted
                    echo "<div class='error'>
                     <a href='payment.php'>Back to lists</a>
                     Incomplete Ticket Details</div>";
                }
                $connection ->close();
                $statement -> close();
            } else {
                //Not GOOD display error
                echo "<ul class='error'>";
                foreach ($error as $value) {
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
        }
        ?>
        
        <form action="" method="POST">
            <table>
            <h2><b>Personal Information</b></h2>
            </br>
            </br>
		<div class="buyer">
                        <label for="un"><b>Customization Your Ticket Id</b></label>
			<input type="text" placeholder="Enter ticket id" name="tid" value="<?php echo $tid;?>" required>
                    
			<label for="un"><b>Participant Name</b></label>
			<input type="text" placeholder="Enter username" name="username" value="<?php echo $username;?>" required>

			<label for="mail"><b>Email</b></label>
			<input type="text" placeholder="Enter email" name="email" value="<?php echo $email;?>" required>

                        <label for="phone"><b>Contact Number</b></label>
                        <input type="text" placeholder="Enter contact number" name="contact" value="<?php echo $contact;?>"required>  
                        
                        <input type="button" value="Return to Menu" name="btnBack" onclick="location='home.php'" />
                        <input type="submit" value="Continue" name="btnSubmit" /> 
                        
		</div>
        </table>
 
        </form>
    </body>
     
</html>
