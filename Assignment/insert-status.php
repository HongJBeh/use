<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert Status | Anime Society</title>
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
    include './adminheader.php';
    require_once './config/helper.php';
    ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>Insert Ticket Status</h1>
        <hr>
        <br>
        <?php 
        global $id, $name, $price, $seat;
        if (!empty($_POST)){
            
            (isset($_POST['id']))?
            $id = trim($_POST['id']):
                $id = "";
            (isset($_POST['name']))?
            $name = trim($_POST['name']):
                $name = "";
            (isset($_POST['price']))?
            $price = trim($_POST['price']):
                $price = "";
            (isset($_POST['seat']))?
            $seat = trim($_POST['seat']):
                $seat = "";
            
            $error['id'] = checkEventID($id);
            $error['name'] = checkEventName($name);
            $error['price'] = checkPriceError($price);
            $error['seat'] = checkSeatError($seat);
            $error = array_filter($error);
            
            if (empty($error)) {
                //GOOD insert record later
                $connection = new mysqli(HOST, USER, PASS, NAME);
                $sql = "INSERT INTO manage (EventID,EventName,TicketPrice,Seat) VALUES (?,?,?,?)";
                $statement = $connection -> prepare($sql);
                $statement ->bind_param('ssss', $id, $name, $price, $seat);
                $statement ->execute();
                if ($statement->affected_rows > 0){
                    //record insert successfully
                    echo "<div class='correct'><a href='manage-status.php'>
                       Back to lists</a>
                       Event $name ticket status is inserted
                       </div>";
                }else{
                    //records are unable to be inserted
                    echo "<div class='error'>
                     <a href='manage-status.php'>Back to lists</a>
                     unable to insert records</div>";
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
                <tr>
                    <td>Event ID:</td>
                    <td><input type="text" name="id" value="<?php echo $id;?>" /></td>
                </tr>
                <tr>
                    <td>Event Name:</td>
                    <td><input type="text" name="name" value="<?php echo $name;?>" /></td>
                </tr>
            <tr>
               
                <td>Event Price (RM) :  </td>
                 <td><input type = "text" name="price" value="<?php echo $price;?>"/></td>                  
            </tr>
            <tr>
                    <td>Event Seat Availability : </td>
                    <td><input type = "text" name="seat" value="<?php echo $seat;?>"/></td>
            </tr>
            <tr>
                <td colspan='3'>
                        
                <div class="nextBtn">
                <input type="submit" value="Insert" name="edit" />
                <input type="button" value="Cancel" name="cancel" onclick="location='manage-status.php'" />
                </div>
                        
                    </td>
                                      
                </tr>
            </table>
            
    </body>
</html>
