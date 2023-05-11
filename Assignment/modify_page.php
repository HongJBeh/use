<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modify Event</title>
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

        $event_no = $_GET['event_no'];

        // connect to the database
        $conn = new mysqli(HOST, USER, PASS, NAME);

        // check for errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // prepare the query
        $stmt = $conn->prepare("SELECT * FROM event WHERE Event_No = ?");

        // bind the parameters
        $stmt->bind_param("s", $event_no);

        // execute the query
        $stmt->execute();

        // get the result
        $result = $stmt->get_result();

        // display the data or the form for updating the data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (isset($_POST['submit'])) {
                    // get the new details of the event from the form
                    $newTitle = $_POST["title"];
                    $newDescription = $_POST["description"];
                    $newStartDate = $_POST["start_date"];
                    $newEndDate = $_POST["end_date"];
                    $newStartTime = $_POST["start_time"];
                    $newEndTime = $_POST["end_time"];
                    $newLocation = $_POST["location"];
                    $newCountry = $_POST["country"];
                    $newState = $_POST["state"];
                    $newPrice = $_POST["price"];

            // update the record in the database
            $updateSql = "UPDATE event SET title='$newTitle', description='$newDescription', start_date='$newStartDate', end_date='$newEndDate', start_time='$newStartTime', end_time='$newEndTime', location='$newLocation', country='$newCountry', state='$newState', price='$newPrice' WHERE Event_No='$event_no'";
            if ($conn->query($updateSql) === TRUE) {
                echo "Event updated successfully.<br />";
                echo "<a href='Admin_Home.php'>[Click Here To Back Menu]</a>";
                $row['title'] = $newTitle;
                $row['description'] = $newDescription;
                $row['start_date'] = $newStartDate;
                $row['end_date'] = $newEndDate;
                $row['start_time'] = $newStartTime;
                $row['end_time'] = $newEndTime;
                $row['location'] = $newLocation;
                $row['country'] = $newCountry;
                $row['state'] = $newState;
                $row['price'] = $newPrice;
            } else {
                echo "Error updating event: " . $conn->error;
            }
        } else {
            // display the form for modifying the event
            echo "<h2>Modify Event: " . $row["title"] . "</h2>";
            echo "<h3>Event Number: " . $row["Event_No"] . "</h3>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='event_no'  value='" . $row["Event_No"] . "'/>";
            echo "Title: <input type='text' name='title' value='" . $row["title"] . "'/><br/>";
            echo "Description: <textarea cols='150' rows='10' name='description' maxlength='255'>" . $row["description"] . "</textarea><br/>";
            echo "Start Date: <input type='date' name='start_date' value='" . $row["start_date"] . "'/><br/>";
            echo "End Date: <input type='date' name='end_date' value='" . $row["end_date"] . "'/><br/>";
            echo "Start Time: <input type='time' name='start_time' value='" . $row["start_time"] . "'/><br/>";
            echo "End Time: <input type='time' name='end_time' value='" . $row["end_time"] . "'/><br/>";
            echo "Location: <input type='text' name='location' value='" . $row["location"] . "'/><br/>";
            echo "Country: <select name='country' value='" . $row["country"] . "'>";
            echo "<option>Malaysia</option>";
            echo "</select><br />";
            echo "State: <select name='state'>";
            echo "<option>Penang</option>";
            echo "<option>Selangor</option>";
            echo "<option>Johor</option>";
            echo "<option>Kedah</option>";
            echo "<option>Kelantan</option>";
            echo "<option>Melaka</option>";
            echo "<option>Negeri Sembilan</option>";
            echo "<option>Pahang</option>";
            echo "<option>Perak</option>";
            echo "<option>Perlis</option>"; 
            echo "<option>Sabah</option>"; 
            echo "<option>Sarawak</option>"; 
            echo "<option>Terengganu</option>"; 
            echo "</select><br />";                             
            echo "Price: <input type='radio' name='btnPrice' checked='checked' onclick='togglePriceInput()'/>Paid";
            echo "<input type='radio' name='btnPrice' value='Free' onclick='togglePriceInput()'/>Free<br />";
            echo "<div id='btn_Paid'>";
            echo "<textarea cols='50' name='price' placeholder='Adult RMxx Children RMxx'></textarea></div>";
            echo "<input type='button' value='Back' style='width: 50px;' onclick='window.location=\"Admin_Home.php\"' />";
            echo "&nbsp";
            echo "<input type='submit' name='submit' value='Save Changes'/>";
            echo "</form>";
                    }
                }
            } else {
                echo "No results found.";
            }

            // close the statement and connection
            $stmt->close();
            $conn->close();
            ?>
        
            <script>
            function togglePriceInput() {
            var paidRadio = document.getElementsByName("btnPrice")[0];
            var priceInput = document.getElementsByName("price")[0];
            var btnPaidDiv = document.getElementById("btn_Paid");
  
            if (paidRadio.checked) {
                btnPaidDiv.style.display = "block";
            } else {
                btnPaidDiv.style.display = "none";
                priceInput.value = "Free";
            }
            }

            </script>
    </body>
</html>
