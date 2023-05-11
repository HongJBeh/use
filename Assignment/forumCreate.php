<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create New Forum</title>
        <link href="CSS/forum.css" rel="stylesheet" type="text/css"/>
    </head>
    <?php 
    require_once './config/helper.php';
    include './adminheader.php';
    ?>
    <body>
        <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-comment-alt-dots"></i>
                        <span class="text">Forum Creation</span>
                    </div>
                </div>
        <div class="forums">
            <h1 class="forumstitle">Create New Forum</h1>
        </div>
                    
        <?php 
        if (isset($_POST['btncreate'])) {
        $discussName = trim($_POST['discussName']);
        
        if (empty($discussName)) {
            echo "Please enter a valid discussion name.";
        } else {
            $connection = new mysqli(HOST, USER, PASS, NAME);
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                
                $img = file_get_contents($_FILES["image"]["tmp_name"]);
                $sql = "INSERT INTO forum (ForumName, ForumImg) VALUES (?,?)";
                $statement = $connection -> prepare($sql);
                $statement ->bind_param('ss', $discussName, $img);
                $statement ->execute();
                $connection ->close();
                $statement ->close();
                echo "Discussion topic created successfully.";
            } else {
                echo "Error uploading image.";
            }
        }
    }
        
        ?>
                    
        <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Discussion Name</td>
                        <td><input type="text" name="discussName" id="discussName" /></td>
                    </tr>
                    <tr>
                        <td>Discussion Image</td>
                        <td><input type="file" name="image" id="image"></td>
                    </tr>
                </table>
            <input type="submit" value="Create" name="btncreate" />
            <input type="button" value="Cancel" name="btncancel" onclick="location='forumAdmin.php'"/>  
        </form>
        
    </body>
</html>
