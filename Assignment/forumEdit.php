<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum Edit</title>
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
        $connection = new mysqli(HOST, USER, PASS, NAME);
        if(isset($_POST['submit'])) {
            $id = $_POST['id'];
            $ForumName = $_POST['ForumName'];
            $ForumImg = '';
            
            if ($_FILES['ForumImg']['size'] > 0) {
                $ForumImg = addslashes(file_get_contents($_FILES['ForumImg']['tmp_name']));
            }
            
                if (empty($ForumName)) {
                    $error_message = 'Please enter a title.';
                    
                }elseif (empty($ForumImg)) {
                    $error_message = 'Please select an image.';
                    
                } else {
                    $sql = "UPDATE forum SET ForumName='$ForumName', ForumImg='$ForumImg' WHERE id='$id'";
                    if ($connection->query($sql) === TRUE) {
                        echo "<div>Record updated.[ <a href='forumAdmin.php'>Back to Forum</a> ]
                </div>";
                    } else {
                        echo "Error updating record: " . $connection->error;
                        
                    }
                    
                    }
        }else{
            $id = $_GET['id'];
            $sql = "SELECT * FROM forum WHERE id='$id'";
            $result = $connection->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
    ?>
        
        
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" name="ForumName" value="<?php echo $row['ForumName']; ?>"><br><br>
            <label for="ForumImg">Image:</label>
            <input type="file" name="ForumImg"><br><br>
            <?php if (isset($error_message)) { echo '<p style="color: red;">' . $error_message . '</p>'; } ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ForumImg']); ?>" alt="Forum image" ><br><br>
            <input type="submit" name="submit" value="Save">
                <input type="button" value="Cancel" name="btncancel" onclick="location = 'forumAdmin.php'"/>
         </form>
        
        <?php
            } else {
        echo "Discussion not found.";
            }
           }
        $connection->close();
        ?>
    </body>
</html>
