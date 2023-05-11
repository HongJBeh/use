<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Status | Anime Society</title>
        
        <style>
            table, td, input{
                margin: auto;
                font-size: 20px;
                border-collapse: collapse;
            }
            
            table{
                 border: 20px outset black;
                 background-color: lightblue;

            }
            
            body{
                margin: auto;
            }
            
            td{
                padding: 10px;
            }
            
            div input{
                margin: 20px 150px;
                padding: 5pt 50pt;
                font-size: 20px;
            }
            
            textArea{
                resize: none;
                font-size: 15pt;
            }
                      
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

                 
</style>
        
    </head>
    <body>
        <?php
        include './adminheader.php';
        require_once './config/helper.php';
        ?>


        <br>
        <br>
        <br>
        <br>

        
        <h1>Edit Ticket Status</h1>
        
        <hr>
        <br>
      
        <?php
        
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            (isset($_GET["id"]))?
            $id = strtoupper(trim($_GET['id'])):
            $id = "";
            $con = new mysqli(HOST, USER, PASS, NAME);
            $sql = "SELECT * FROM manage WHERE EventID = '$id'";
            $result = $con->query($sql);
            if($record = $result->fetch_object())
            {
                $id = $record->EventID;
                $name = $record->EventName;
                $price = $record->TicketPrice;
                $seat = $record->Seat;
            }
            else
            {
                printf("Record not found, Please try again.");
            }
            $con->close();
            $result->free();
        }else{
                 $name = $_POST['name'];
                 $seat = $_POST['seat'];
                 $price = $_POST['price'];
                 $id = $_POST['hideEventId'];
                 
                    $error["name"] = checkEventName($name);
                    $error['price'] = checkPriceError($price);
                    $error['seat'] = checkSeatError($seat);

                    $error = array_filter($error);

                if(empty($error))
                {
                    $con = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "UPDATE manage SET EventName= ?, TicketPrice= ?, Seat= ? WHERE EventID=?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param('ssss', $name, $price, $seat, $id);

                    if($stmt->execute())
                    {
                        $message = "Event Ticket Status Edit Successful";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        echo "<meta http-equiv='refresh' content='0; url=manage-status.php'>";
                    }
                    else
                    {
                        printf("Error Edit. Please try again.");
                    }
                    $stmt->close();
                    $con->close();
                }
                else {
                //WITH ERROR, display error
                echo "<ul class='error'>";
                foreach ($error as $value) {
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
                }
 
        ?>
        
        <form action="" method="POST">
            <table class="formEdit">      
                <tr>
                    <td>Event ID :</td>
                    <td><?php echo $id;?></td>
                    <td><input type="hidden" name="hideEventId" value="<?php echo $id;?>" /></td>
                </tr>

                <tr>
                    <td>Event Name :</td>
                    <td><input type="textarea" name="name" value="<?php echo $name;?>" /></td>
                </tr>
               
                
                <tr>
                    <td>Ticket Price :</td>
                    <td><input type="text" name="price" value="<?php echo $price;?>" /></td>
                </tr>

                <tr>
                    <td>Available Seat :</td>
                    <td><input type="text" name="seat" value="<?php echo $seat;?>" /></td>
                </tr>
                
                <tr>
                <td class="nextBtn"><input type="submit" value="Edit Event" name="edit" /></td>
                <td class="nextBtn"><input type="button" value="Cancel" name="cancel" onclick="location='manage-status.php'" /></td>                     
                </tr>    
            </table>   
        </form>     
    </body>
</html>

