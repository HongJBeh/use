<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Event Details</title>
        <link href="CSS/Event_Detail.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './header.php';
        require_once './config/helper.php';
        
        // retrieve the event ID from the URL parameter
        $event_id = $_GET["event_id"];

        // connect to the database
        $conn = new mysqli(HOST, USER, PASS, NAME);

        // check for errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // retrieve the event details from the database
        // prepare the SQL statement with a parameter
        $stmt = $conn->prepare("SELECT Event_No, title, Description, Start_Date, End_Date, Start_Time, End_Time, Location, Country, State, Price FROM event WHERE Event_No = ?");

        // bind the parameter to the statement
        $stmt->bind_param("s", $event_id);

        // execute the statement
        $stmt->execute();

        // get the results
        $result = $stmt->get_result();

        // display the data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo '<form action="" method="" class="ShowEvent_border">';
            echo "<h1>" . $row["title"] . "</h1>";
            if (isset($_GET['event_id'])) {
    $filename = $_GET['event_id'];
    $filepath = 'Picture/' . $filename;
    if (file_exists($filepath)) {
        echo "<img src='$filepath' width='500px' style='margin-left:150px'/>";
    } else {
        echo "";
    }
} else {
    echo "Image not specified.";
}
            echo '<hr/>';
            echo "<div><table>";
            echo "<h2>Event Information</h2>";
            echo "<tr><td>";
            echo "<p>" . $row["Description"] . "</p>";
            echo "📆Date: ".$row['Start_Date']." - ".$row['End_Date']."<br />";
            echo "🕛Time: ".$row['Start_Time']." - ".$row['End_Time']."<br />";
            echo "🚩Location: <br />";
            echo $row['Location']."<br />";
            echo $row['Country'].", ".$row['State']."<br />";
            echo "🎫Type Ticket: ".$row['Price']."<br /><br />";
            $value = $row['Price'];
            if ($value != "Free") {
            echo "<a href='info.php' target='_blank' class='order_ticket'><u>Click Here To Buy</u></a>";
            } else {
                
            }
            echo "</td></tr></table></div></form>";
            }
        } else {
            echo "No results found.";
        }

        // close the statement and connection
        $stmt->close();
        $conn->close();

        include './footer.php';
        ?>
        
        
    </body>
</html>
