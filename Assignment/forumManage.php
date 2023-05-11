<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Forum</title>
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
        
        <div class="forums"> 
        <h1 class="forumstitle">Manage Discussions</h1>
        <table class="forumstable">
            <?php 
                    $connection = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "SELECT * FROM forum ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                ?>
            <tr>
                <td><h2><a href="forum.php?id=<?php echo $row['id']; ?>"><?php echo $row['ForumName']; ?></h2>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ForumImg']); ?>" alt="Forum image" /></a></td>
                <td>
                    <button onclick="location.href='forumEdit.php?id=<?php echo $row['id']; ?>'">Edit</button>
                    <button onclick="location.href='forumDelete.php?id=<?php echo $row['id']; ?>'">Delete</button>
                </td>
            </tr>
        <?php 
                        }
                    } else {
        ?>
            <tr>
                <td colspan="3">No discussions found.</td>
            </tr>
        <?php 
                    }
                    $connection->close();
        ?>
             </table>
        </div>
    </body>
</html>
