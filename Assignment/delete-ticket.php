<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Status | Anime Society</title>
               <style>
table, td{
          margin: auto;
          font-size: 20px;
          border-collapse: collapse;  
}
            
table{
        border: 20px outset black;
        width: 80%;
        background-color: lightblue;
}
            
            
input, select{
             font-size: 20px;
}
            
body{
     margin: auto;
}

p{
   font-size: 20px;
}
            
td{
   padding: 20px;
}
            
td input{
        margin: 0px 150px;
        padding: 5pt 60pt;
        font-size: 20px;
}
            
            
</style>
        
    </head>
    <body>
        <?php
        require_once './config/helper.php';
        ?>
        <h1>Delete Student</h1>
        
        <?php
        if($_SERVER['REQUEST_METHOD']== 'GET'){
            //get method, retrieve record from DB
            (isset($_GET["tid"]))?
            $tid = strtoupper(trim($_GET["tid"])):
            $tid = "";
            $con = new mysqli(HOST, USER, PASS, NAME);
            
            $sql = "SELECT * FROM ticket WHERE TicketID = '$tid'";
            $result = $con->query($sql);
            if($record = $result->fetch_object()){
                //record found
                $tid = $record->TicketID;
                $username = $record->UserName;
                $email = $record->ticket_email;
                $contact = $record->ticket_contact;
                
                printf("<p>Are you sure you want to delete following Records?</p>
                        <table border = 1>
                        <tr>
                        <td>Ticket ID :</td>
                        <td>%s</td>
                        </tr>
                        
                        <tr>
                        <td>Participant name :</td>
                        <td>%s</td>
                        </tr>
                        
                        <tr>
                        <td>Email :</td>
                        <td>%s</td>
                        </tr>
                        
                        <tr>
                        <td>Contact Number :</td>
                        <td>%s</td>
                        </tr>



                        </table>
                        <form action='' method='post'>
                        <input type='hidden' name='htID' value='%s' />
                        <input type='hidden' name='htName' value='%s' />
                        <input type='submit'value='Yes'name='btnYes'/>
                        <input type='button'value='Cancel'name='btnCancel'
                        onclick = 'location = \"ticketrecord.php\"'/>

                        </form>
                        ", $tid, $username, $email, $contact, $tid, $username);
            }else{
                //record not found    
                echo "<div class='error'>
                 Unable to retrieve record.
                 [ <a href='ticketrecord.php'>
                 Back to list</a> ]
                 </div>";
            }
        }else{
            //post method, delete record
            //retreive hidden field
            $tid = strtoupper(trim($_POST["htID"]));
            $username = trim($_POST["htName"]);
            
            //step 1: establish connection
            $con = new mysqli (HOST, USER, PASS, NAME);
            
            //step 2: sql statement
            $sql = "DELETE FROM ticket WHERE TicketID = ?";
            
            //step 3: run sql
            $stmt = $con ->prepare($sql);
            $stmt->bind_param("s", $tid);
            $stmt->execute();
            
            if($stmt->affected_rows > 0){
                //record deleted
               echo "<div class='info'>
                   <a href='ticketrecord.php'>
                       Back to lists</a>
                       Record $username is deleted.
                       </div>";
            }else{
                //unable to deleted
                echo "<div class='error'>
                    <a href='ticketrecord.php'>
                       Back to lists</a>
                       unable to delete records</div>";
                       
            }
            $con->close();
            $stmt->close();
    
        }
        ?>
        <?php 
        include './footer.php';
        ?>
    </body>
</html>