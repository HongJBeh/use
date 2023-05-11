<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Homepage</title>
        <link href="CSS/Admin_Home.css" rel="stylesheet" type="text/css"/>
        <link href="css/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body>
        <?php 
        include './adminheader.php';
        require_once './config/helper.php';
        ?>
        
         <div>
                <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="text">Event</span>
                    </div>
                </div>
                </div>
            </div>
            <div>
                <h2>Modify Event</h2>
                <a href="Admin_CForm.php"><button class="btn success">New Event</button></a>
                <br />
        
        <?php
        // connect to the database
        $conn = new mysqli(HOST, USER, PASS, NAME);

        // check for errors
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // retrieve the data from the table
$sql = "SELECT Event_No, title, description FROM event";
$result = $conn->query($sql);

        // display the data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<table class='ShowEvent'>";
                echo "<tr><td width='2000px'>";
                echo "<h3>" . $row["title"] . "</h3>";
                $paragraph = $row["description"];
                $limited_paragraph = substr($paragraph, 0, 100);
                if (strlen($paragraph) > 100) {
                    $limited_paragraph .= '...';
                }
                echo "<p>" . $limited_paragraph . "</p>";
                echo "<input type='button' id='modifyBtn-" . $row["Event_No"] . "' value='Modify' class='btn_AMDEvent' style='width: 60px;'/> <input type='button' id='deleteBtn-" . $row["Event_No"] . "' value='Delete' class='btn_AMDEvent' style='width: 60px;'/>";
                echo '</td></tr>';
                echo '</table>';
            }
        } else {
            echo "No results found.";
        }


        // close the connection
        $conn->close();
        ?>
        
        <script>
        var modifyBtns = document.querySelectorAll('[id^="modifyBtn-"]');
var deleteBtns = document.querySelectorAll('[id^="deleteBtn-"]');

for (var i = 0; i < modifyBtns.length; i++) {
    modifyBtns[i].addEventListener("click", function() {
        var eventNo = this.id.split("-")[1];
        window.location.href = "modify_page.php?event_no=" + eventNo;
    });
}

for (var i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener("click", function() {
        var eventNo = this.id.split("-")[1];
        window.location.href = "delete_page.php?event_no=" + eventNo;
    });
}

        </script>


    </body>
</html>
