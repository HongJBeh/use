<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Event</title>
    </head>
    <body>
        <?php
        include './adminheader.php';
        require_once './config/helper.php';
        ?>
        <br /><br /><br />
        <?php
        // get the event number from the query string
        if (!isset($_GET['event_no'])) {
            die('Event number not specified.');
        }

        $eventNo = $_GET['event_no'];

        // check if the form is submitted and the user has confirmed the deletion
        if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
            // connect to the database
            $conn = new mysqli(HOST, USER, PASS, NAME);
                
            // check for errors
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // prepare the delete statement
            $sql = "DELETE FROM event WHERE Event_No = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $eventNo);

            // execute the statement
            if ($stmt->execute()) {
                // success message
                echo "Event deleted successfully.<br />";
                echo "<a href='Admin_Home.php'>[Click Here To Back Menu]</a>";
            } else {
                // error message
                echo "Error deleting event: " . $conn->error;
            }

            // close the statement and connection
            $stmt->close();
            $conn->close();
        } else {
            // display confirmation message
            echo "Are you sure you want to delete this event?<br />";
            echo "<form method='post'>";
            echo "<input type='hidden' name='confirm' value='yes' />";
            echo "<input type='submit' name='remove_img' value='Yes' style='width: 60px;'/>";
            echo '&nbsp';
            echo "<input type='button' value='No' style='width: 60px;' onclick='window.location=\"Admin_Home.php\"' />";
            echo "</form>";
        }
        
            if(isset($_POST['remove_img'])){
            $img = $eventNo;
            $imgpath = 'Picture/' . $img;
            unlink( $imgpath );
            }
        ?>
        
    </body>
</html>
