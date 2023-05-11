<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket History | Anime Society</title>
        <style>        
body{
    font-size: 17pt;
}

table.trecord{
    margin: auto;
    border-collapse: collapse;
   width: 90%;
   background-color: lightblue;
    
}

table td.username, table td.email, table td.contact, table td a.listBtn {
    white-space:nowrap;
}


.trecord, .cha, .ga{
    padding: 15pt;
    text-align: center;
    border: 2px ridge black;
    padding: 10pt;
}

.wo{
    border: 5px ridge black;
    background-color: white;
    padding: 15pt;
    color: black;
}



table td.username, table td.email, table td.contact, table td a.listBtn, table td.buttonb{
    white-space:nowrap;
}


.head{
    font-weight: bold;
    text-align: center;

}


button.buttonb{
    float : right;
}


buttonb{
    margin: 10pt;
    padding: 5pt;
    float: left;
    font-size: 13pt;
    width: 200px;
}

.title {
    text-align: center ;
    background-color: #d9a7c7;
    width: auto;
    margin: 0px;
}
        
</style>
    </head>
    <?php 
    include './header.php';
    require_once './config/helper.php';
    ?>
    <body>
        <h1 class="title">Ticket History</h1>
        <br>
            <div>
        <table class="trecord">
            <tbody class="wo">
            <tr id="list" class="cha">
                <td class="ga" width = "150" >Participant name</td>
                <td class="ga" width = "100pt" >Email</td>
                <td class="ga" width = "100pt" >Contact Number</td>
                <td class="ga" width = "100pt" >Action</td>

            </tr>
            
            <tr>
                <?php
                $con = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT * FROM ticket";
                
                if($result = $con->query($sql))
            {
                while($record = $result->fetch_object())
                {
                    printf("
                        <tr class='cha'>
                            <td class='ga' name='username'>%s</td>
                            <td class='ga' name='email'>%s</td>
                            <td class='ga' name='contact'>%s</td>
                            <td class='ga' name='buttonb'><a class='listBtn' href='ticket-records1.php?id=%s'>View</a></td>
                        </tr>
                            ", $record->UserName,
                               $record->ticket_email,
                               $record->ticket_contact,
                               $record->TicketID,
                               $record->TicketID);
                    
                            }
            } 
          ?>   
            </tr>
        </tbody>
        </table>
    </div>
</body>
     <?php include './footer.php';?>
</html>

