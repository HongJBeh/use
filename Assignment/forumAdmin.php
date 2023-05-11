<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Anime Society - Forums</title>
        <link href="CSS/forum.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <?php 
        require_once './config/helper.php';
        include './adminheader.php';
        ?>
        <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-comment-alt-dots"></i>
                        <span class="text">Forum</span>
                    </div>
                </div>
                </div>
            </div>
        <div class="forumAdmin"><!-- for admin side -->
            <ul>
                <button onclick="location.href='forumCreate.php'">Create</button>
                <button onclick="location.href='forumManage.php'">Manage</button>
            </ul>
        </div>
        
            <div class="forums">      
    <h1 class="forumstitle">Forums</h1>

    <table class="forumstable">
        <tr>
            <td style="text-align: center; font-family: fantasy;">Come and share your thoughts on past, present and future events that were hosted, happening or in the works.</td>
        </tr>
        
        <?php 
            $connection = new mysqli(HOST, USER, PASS, NAME);
            $sql = "SELECT * FROM forum ORDER BY id DESC";
            $result = $connection->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><h2><a href="forumDiscussion.php?id=<?php echo $row['id']; ?>"><?php echo $row['ForumName']; ?><img src="data:image/jpeg;base64,<?php echo base64_encode($row['ForumImg']); ?>" alt=""/></a></h2></td>
        </tr>
        <?php 
                }
            } else {
        ?>
        <tr>
            <td>No discussions found.</td>
        </tr>
        <?php 
            }
            $connection->close();
        ?>
        
    </table>
</div>
        
    </body>

</html>