<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum Delete</title>
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
        
        <?php
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
            $connection = new mysqli(HOST, USER, PASS, NAME);
            $statement = $connection->prepare("SELECT ForumName, ForumImg FROM forum WHERE id = ?");
            $statement->bind_param("i", $id);
            $statement->execute();
            $statement->bind_result($ForumName, $ForumImg);
            $statement->fetch();
            $statement->close();
            $connection->close();
            }else {
                echo "<div>
                    Unable to retrieve record.
                    [ <a href='forumAdmin.php'>
                    Back to Forum</a> ]
                </div>";
            }
        ?>
        
        <div class="forums"> 
        <h1 class="forumstitle">Delete Discussion</h1>
        <table class="forumstable">
            <tr>
                <td><h2><?php echo $ForumName; ?></h2>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($ForumImg); ?>" alt="Forum image" /></td>
            </tr>
        </table>
        <form method="post">
            <div class="form-group">
                <button type="submit" name="delete" class="btndelete">Confirm</button>
                <input type="button" value="Cancel" name="btncancel" onclick="location = 'forumAdmin.php'"/>
            </div>
        </form>
        </div>
        
        <?php
        if(isset($_POST["delete"])) {
            $connection = new mysqli(HOST, USER, PASS, NAME);
            $statement = $connection->prepare("DELETE FROM forum WHERE id = ?");
            $statement->bind_param("i", $id);
            
            if($statement->execute()) {
                echo "<div>
                    Record deleted.
                    [ <a href='forumAdmin.php'>
                    Back to Forum</a> ]
                </div>";
            }else {
                echo "Error deleting record: " . $statement->error;
            }
            $statement->close();
            $connection->close();
        }
        ?>
    </body>
</html>
