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
        padding: 5pt 45pt;
        font-size: 20px;
}
            
            
</style>
        
    </head>
    <body>
        <?php
        include './adminheader.php';
        require_once './config/helper.php';
        ?>
        
        <h1>Delete Ticket Status</h1>
        <br>
        <hr>
        <?php     
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            (isset($_GET["id"]))?
            $id = strtoupper(trim($_GET['id'])):
            $id = "";
            $con = new mysqli(HOST, USER, PASS, NAME);
            $sql = "SELECT * FROM manage WHERE EventID='$id'";
            $result = $con->query($sql);
            
            if($record = $result->fetch_object())
            {
                $id = $record->EventID;
                $name = $record->EventName;
                $price = $record->TicketPrice;
                $seat = $record->Seat;
       

                
                printf("
                    <br>
                    <br>
                    <h1>Delete Ticket Status</h1>
                    <hr>
                    <br>
                    <p>Are you sure you want to <b style='color: red; text-decoration: underline;'>DELETE</b> the following Event Ticket Status?</p>
                    <form action='' method ='POST'>
                        <table class='deleteList'>
                            
                            <tr>
                                <td>Event ID :</td>
                                <td>%s</td>
                                <input type='hidden' name='hideEventId' value='%s'>
                            </tr>
                            
                            
                            <tr>
                                <td>Event Name :</td>
                                <td>%s</td>
                                <input type='hidden' name='hideEventName' value='%s'>
                            </tr>
                            
                            <tr>
                                <td>Price :</td>
                                <td>RM %d</td>
                            </tr>
                            
                            <tr>
                                <td>Seat :</td>
                                <td>%d</td>
                            </tr>
                            
                            <tr>
                            
                            <div class='nextBtn'>
                            <td><input type='submit' value='Yes' name='delete' /></td>
                            <td><input type='button' value='Cancel' name='cancel' onclick='location=\"manage-status.php\"' /></td>
                            </div>

                            </tr>
                        </table>
                        
                    </form>
                        ",$id, $id, $name, $name, $price, $seat);
            }
        }
        else
        {
            $id = $_POST['hideEventId'];
            $eName = $_POST['hideEventName'];
            
            $con = new mysqli(HOST, USER, PASS, NAME);
            $sql = "DELETE FROM manage WHERE EventID =? ";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $id);
            $stmt->execute();
            
            if($stmt->affected_rows > 0 )
            {
                $message = "Event Ticket Status Deleted Successful";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<meta http-equiv='refresh' content='0; url=manage-status.php'>";
            }
            else{ 
                echo "<div class='error'>
                    <a href='manage-status.php'>
                       Back to lists</a>
                       unable to delete records</div>";
                       
            }
            $con->close();
            $stmt->close();  
        }
        ?>
        
        <br>
        <br>
        <br>
        <br>
    </body>
</html>

