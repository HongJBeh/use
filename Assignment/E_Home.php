<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="CSS/E_Home.css" rel="stylesheet" type="text/css"/>
        <link href="CSS/assigncss.css" rel="stylesheet" type="text/css"/>
        <title>Event</title>
        
        <style>
        .title {
            text-align: center ;
            background-color: #d9a7c7;
            width: auto;
            margin: 0px;
        }
        </style>
    </head>
    <body>
        <?php 
        include './header.php';
        require_once './config/helper.php';
        ?>
        
        <h1 class="title">Event</h1>
        <!-- Show Event -->
        <div id="small_button">
            <button class="small_search_button"><a href="E_Home.php?orderby=event_no&sort_order=<?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'asc' ? 'desc' : 'asc'; ?>">EventNo</a></button>
            <button class="small_search_button"><a href="E_Home.php?orderby=title&sort_order=<?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'asc' ? 'desc' : 'asc'; ?>">Name</a></button>
            <button class="small_search_button"><a href="E_Home.php?orderby=start_date&sort_order=<?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'asc' ? 'desc' : 'asc'; ?>">Date</a></button>
        </div>

        <?php
        // connect to the database
        $conn = new mysqli(HOST, USER, PASS, NAME);

        // check for errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // retrieve the data from the table
        $orderby = "title ASC";
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'event_no':
                    $orderby = "Event_No " . (isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc' ? 'DESC' : 'ASC');
                    break;
                case 'title':
                    $orderby = "title " . (isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc' ? 'DESC' : 'ASC');
                    break;
                case 'start_date':
                    $orderby = "start_date " . (isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc' ? 'DESC' : 'ASC');
                    break;
            }
        }

        $sql = "SELECT Event_No, title, description FROM event ORDER BY $orderby";
        $result = $conn->query($sql);

        // display the data
        if ($result->num_rows > 0) {
    echo "<table><tr>";
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        if ($i % 2 == 0) {
            echo "</tr><tr>";
        }
        echo "<td>";
        echo "<table class='ShowEvent'>";
                        echo "<tr><td style='padding: 10px'>";
                if (isset($row["Event_No"])) {
                    $filename = $row["Event_No"];
                    $filepath = 'Picture/' . $filename;
                    if (file_exists($filepath)) {
                        echo "<img src='$filepath' width='250px' style='margin-left:70px'/>";
                    } else {
                        echo "No Image Found.";
                    }
                } else {
                    echo "Image not specified.";
                }
                echo "</td></tr>";
                echo "<tr><td width='500px'>";
                echo "<h3>" . $row["title"] . "</h3>";
                $paragraph = $row["description"];
                $limited_paragraph = substr($paragraph, 0, 100);
                if (strlen($paragraph) > 100) {
                    $limited_paragraph .= '...';
                }
                echo "<p>" . $limited_paragraph . "</p>";
                echo '</td></tr>';
                echo "<tr><td><a href='Event_Details.php?event_id=" . $row["Event_No"] . "' style='color: blue'><u>More Info</u></a></td></tr>";
        echo "</table>";
        echo "</td>";
        $i++;
    }
    echo "</tr></table>";

        } else {
                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp No results found.";
        }

        // close the connection
        $conn->close();
        
        include './footer.php';
        ?>
    </body>
</html>
