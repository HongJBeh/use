<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>member</title>
        <link href="CSS/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body>
        <?php include './adminheader.php';
        require_once './config/helper.php';
        
        $header = array(
            'MemberID' => 'Member ID',
            'MemberName' => 'Member Name',
            'Gender' => 'Gender',
            'PhoneNumber' => 'Phone Number',
            'Email' => 'E-mail'
        );
        global $sort, $order;
        if (isset($_GET['sort']) && isset($_GET['order'])){
            $sort = (array_key_exists($_GET['sort'], $header)?$_GET['sort'] : 'MemberID');
            $order = ($_GET['order']== 'DESC')? 'DESC' : 'ASC';
        } else {
            $sort="MemberID";
            $order="ASC";
        }
        if (isset($_GET['gender'])){
            $gender = (array_key_exists($_GET['gender'], getAllGender())? $_GET['gender'] : "%");
        } else {
            $gender = "%";
        }
        ?>
            <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-user"></i>
                        <span class="text">Member</span>
                    </div>
                    <div class="boxes">
                        <div class="box box1">
                            <i class="uil uil-user"></i>
                            <span class="text">Total Member</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
                <div class="activity">
                    <div class="title">
                        <h3>All Member</h3>
                    </div>
                    <form action="" method="POST">
                    <table>
                        <tr>
                            <?php
                                    foreach ($header as $key => $value){
                                        if ($key == $sort){
                                            printf('<th>
                                                    <a href="?sort=%s&order=%s&gender=%s">%s</a>
                                                    %s
                                                    </th>', $key, $order == 'ASC' ? 'DESC' : 'ASC', $gender, $value, $order == 'ASC' ? '⬇️' : '⬆️');
                                        } else {
                                            printf('<th>
                                                <a href ="?sort=%s&order=ASC&gender=%s">%s</a>
                                                    </th>', $key, $gender, $value);
                                        }
                                    }
                            ?>
                        </tr>
                        <?php
                        $con = new mysqli(HOST, USER, PASS, NAME);
                        
                        $sql = "SELECT * FROM member WHERE Gender LIKE '$gender' ORDER BY $sort $order";
                        
                        if ($result = $con -> query($sql)){
                            while ($record = $result->fetch_object()){
                                printf("<tr>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td><a href='edit-member.php?id=%s'>Edit</a></td>
                                    <td><a href='delete-member.php?id=%s'>Delete</a></td>
                                        </tr>"
                                        ,$record->MemberID
                                        ,$record->MemberName
                                        , getAllGender()[$record->Gender]
                                        ,$record->PhoneNumber
                                        ,$record->Email
                                        ,$record->MemberID
                                        ,$record->MemberID);
                            }
                            printf("<tr><td colspan='7'></td></tr>");
                        }
                        $result->free();
                        $con->close();
                        ?>
                    </table>
                    </form>
                </div>
    </body>
</html>
