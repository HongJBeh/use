<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Discussion</title>
        <link href="CSS/forum.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/discussion.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './header.php';
        require_once './config/helper.php';
        ?>
        <div class="discussion">   
        <?php
        $forum_id = $_GET['id'];
        $discussion_id = $_GET['id'];
        $connection = new mysqli(HOST, USER, PASS, NAME);
        
        $sql = "SELECT * FROM forum WHERE id = $forum_id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $forum_name = $row['ForumName'];
        $forum_image = $row['ForumImg'];
         
        $sql = "SELECT * FROM forumdiscussion WHERE id = $discussion_id AND forum_id = $forum_id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        
        
        if (isset($_POST['submit'])) {
            $comment = $_POST['comment'];
            $sql = "INSERT INTO forumdiscussion (forum_id, comment) VALUES ('$forum_id', '$comment')";
            $connection->query($sql);
        }
        
        $sql = "SELECT * FROM forumdiscussion WHERE forum_id = $forum_id";
        $result = $connection->query($sql);
        
        echo '<div class="discussion">';
        echo '<h1>' .$forum_name .'</h1>';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($forum_image) . '" alt=""/>';
        echo '<div class="post">';
        echo '<div class="post-header"><h2>Discussion</h2></div>';
        echo '<form method="POST">';
        echo '<textarea name="comment" placeholder="Enter your comment here"></textarea>';
        echo '<button type="submit" name="submit" style="float: right;">Submit</button>';
        echo '</form>';
        $sql = "SELECT * FROM forumdiscussion WHERE forum_id = $forum_id";
        echo '<table style="width: 100%;>';
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo '<tr class="post-body" style="margin: 5px 10px;">';
            echo '<td style="border: 1px dotted black;">' . $row['comment'] . '</td>';
            echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
        ?>
            
        
    </body>
</html>
