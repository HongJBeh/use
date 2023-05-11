<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage status | Anime Society</title>
<style>        
body{
    font-size: 17pt;   
}

table{
    margin: auto;
    border-collapse: collapse;
   width: 90%;
   background-color: lightblue;
    
}

table td.name, table td.price, table td.seat, table td a.listBtn {
    white-space:nowrap;
}

td{
    border: 6pt;
    padding: 15pt;
    text-align: center;
}


table td.name, table td.price, table td.seat, table td a.listBtn, table td.button{
    white-space:nowrap;
}

thead{
    text-align: center;
    font-size: 25pt;
    text-decoration: underline;
    padding: 30pt;
    background-color: pink;
    font-size: 25pt;
    border: 6pt ridge black;
    color: black;

}

tr.status, tr.footer{
    border: 6pt ridge black;
    background-color: pink;
    padding: 15pt;
    color: black;
}

td{
    border: 6pt ridge black;
    padding: 15pt;
}
.head{
    font-weight: bold;
    text-align: center;

}


button.button{
    float : right;
}


button{
    margin: 10pt;
    padding: 5pt;
    float: left;
    font-size: 13pt;
    width: 200px;
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
        
        
        <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-map"></i>
                        <span class="text">Manage ticket System</span>
                    </div>
                </div>
                </div>
            </div>
             
    
    <div>
        <table>
            <tbody>
            <tr id="list" class="status">
                <td width = "200" >Event Name</td>
                <td class="price" width = "50pt" >Price of Ticket</td>
                <td width = "50" >Seat Availability</td>
                <td class="price" width = "100pt" >Action</td>

            </tr>
            
            <tr>
                <?php
                $con = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT * FROM manage";
                
                if($result = $con->query($sql))
            {
                while($record = $result->fetch_object())
                {
                    printf("
                        <tr>
                        
                            <td class = 'name'>%s</td>
                            <td class='price'>RM %s</td>
                            <td class = 'seat'>%s</td>
                            <td class = 'button'><a class='listBtn' href='edit-status.php?id=%s'>Edit</a> | <a class='listBtn' href='delete-status.php?id=%s'>Delete</a></td>
                        </tr>
                            ", $record->EventName,
                               $record->TicketPrice,
                               $record->Seat,
                               $record->EventID,
                               $record->EventID);
                    
                            }
            } 
          ?>   
            </tr>
        </tbody>

            <tfoot>
                <tr class="footer">
                    <td>    
                    <?php
                echo '<div class="listTotal">';
                printf("
                        <td class='totals' colspan='3'>Total of %d Event(s) Ticket Status added.
                        [<a href ='insert-status.php'> Insert Event Ticket Status </a>]</td>", $result->num_rows);
                echo '</div>';
                ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
