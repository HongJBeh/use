<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Adminpanel</title>
        <link href="CSS/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        
        
    </head>
    <body>
        <?php 
        require_once './config/helper.php';
        include './adminheader.php';
        
        $header = array(
            'MemberID' => 'Member ID',
            'MemberName' => 'Member Name',
            'Gender' => 'Gender',
            'PhoneNumber' => 'Phone Number',
            'Email' => 'E-mail'
        );
        ?>
            <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="text">Dashboard</span>
                    </div>
                    <div class="boxes">
                        <div class="box box1">
                            <i class="uil uil-user"></i>
                            <span class="text">Total Member</span>
                            
                        </div>
                        <div class="box box2">
                            <i class="uil uil-book"></i>
                            <span class="text">Booking</span>
                            
                        </div>
                    </div>
                </div>
                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Recent New Member</span>
                    </div>
                    <form action="" method="POST">
                        <table>
                            <thead>
                                <tr>
                                    <th><?php echo $header['MemberID']; ?></th>
                                    <th><?php echo $header['MemberName']; ?></th>
                                    <th><?php echo $header['Gender']; ?></th>
                                    <th><?php echo $header['PhoneNumber']; ?></th>
                                    <th><?php echo $header['Email']; ?></th>
                                </tr>
                            </thead>
                            <?php
                        $con = new mysqli(HOST, USER, PASS, NAME);
                        
                        $sql = "SELECT * FROM member";
                      
                        if ($result = $con -> query($sql)){
                            while ($record = $result->fetch_object()){
                                printf("<tr>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                        </tr>"
                                        ,$record->MemberID
                                        ,$record->MemberName
                                        , getAllGender()[$record->Gender]
                                        ,$record->PhoneNumber
                                        ,$record->Email);
                            }
                            printf("<tr><td colspan='5'></td></tr>");
                        }
                        $result->free();
                        $con->close();
                        ?>
                    </table>
                    </form>
                </div>
            </div>
        </section>
        <?php
        // put your code here
        ?>
    </body>
</html>
