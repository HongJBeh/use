<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Event Form</title>
        <link href="CSS/Create Form.css" rel="stylesheet" type="text/css"/>
        <link href="css/admincss.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body>
        <?php 
        include './adminheader.php';
        require_once './config/helper.php';

        if (!empty($_POST)){
            // Process form data
            if(isset($_POST['Event_No'])){
            $eventNo = trim($_POST['Event_No']);
            } else {
            $eventNo = "0000";
            }
            (isset($_POST['Title']))?
            $title = trim($_POST['Title']):
                $title = "";
            (isset($_POST['Description']))?
            $description = trim($_POST['Description']):
                $description = "";
            (isset($_POST['Start_Date']))?
            $start_date = trim($_POST['Start_Date']):
                $start_date = "";
            (isset($_POST['End_Date']))?
            $end_date = trim($_POST['End_Date']):
                $end_date = "";
            (isset($_POST['Start_Time']))?
            $start_time = trim($_POST['Start_Time']):
                $start_time = "";
            (isset($_POST['End_Time']))?
            $end_time = trim($_POST['End_Time']):
                $end_time = "";
            (isset($_POST['Location']))?
            $location = trim($_POST['Location']):
                $location = "";
            (isset($_POST['Country']))?
            $country = trim($_POST['Country']):
                $country = "";
            (isset($_POST['State']))?
            $state = trim($_POST['State']):
                $state = "";
            (isset($_POST['btnPrice']) && $_POST['btnPrice'] == "Free")?
            $price = "Free":
                $price = trim($_POST['Price']);
            (isset($_FILES['fsImage']))?
            $image = $_FILES['fsImage']:
                $image = "";
    
    
            $error['Event_No'] = checkEventNo($eventNo);
            $error['Title'] = checkTitle($title);
            $error['Description'] = checkDescription($description);
            $error['Start_Date'] = checkStartDate($start_date);
            $error['End_Date'] = checkEndDate($end_date);
            $error['Start_Time'] = checkStartTime($start_time);
            $error['End_Time'] = checkEndTime($end_time);
            $error['Location'] = checkLocation($location);
            $error['Price'] = checkPrice($price);
            $error['fsImage'] = checkImage($image);
            $error = array_filter($error);
            
            $newFileName = $eventNo;
            //save the file
            move_uploaded_file($image['tmp_name'], 'Picture/'.$newFileName);
            //uploaded successful
            $url = "Event_Details.php?event_id=".$eventNo;
            
            if (empty($error)) {
                // Insert record into database
                $conn = new mysqli(HOST, USER, PASS, NAME);
                $sql = "INSERT INTO event (Event_No, title, Description, Start_Date, End_Date, Start_Time, End_Time, Location, Country, State, Price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssssss", $eventNo, $title, $description, $start_date, $end_date, $start_time, $end_time, $location, $country, $state, $price);
                $stmt->execute();

                $conn->close();
                $stmt->close();
        
                header("Location: /assignment/Admin_Home.php");
                exit();
            } else {
                // Display error messages
                echo "<ul class='error' style='padding-left: 10px; padding-top: 80px;'>";
                foreach ($error as $value) {
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
        }
        
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
            <div class="Registration">
                <form method="post" action="" enctype="multipart/form-data">
                <table class="E_Info">
                <tr>
                    <td>
                        <h2 class="ct">Event Information</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="Event_No" placeholder="E001" size="50" value="<?php echo isset($eventNo) ? $eventNo : '';?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="Title" placeholder="Event Title" size="150" value="<?php echo isset($title) ? $title : '';?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea cols="150" rows="10" placeholder="Event Description" name="Description" maxlength="255"><?php echo isset($description) ? $description : '';?></textarea>
                    </td>
                </tr>
            </table>
                <table>    
                    <tr>
                        <td>
                            <h2 class="ct">Event Details</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>Start Date:</td>
                        <td>End Date:</td>
                    </tr>
                    <tr>
                        <td><input type="date" name="Start_Date" value='<?php echo isset($start_date) ? $start_date : '';?>'/></td>
                        <td><input type="date" name="End_Date" value='<?php echo isset($end_date) ? $end_date : '';?>' /></td>
                    </tr>
                    <tr>
                        <td>Start Time:</td>
                        <td>End Time:</td>
                    </tr>
                    <tr>
                        <td><input type="time" name="Start_Time" value='<?php echo isset($start_time) ? $start_time : '';?>'/></td>
                        <td><input type="time" name="End_Time"  value='<?php echo isset($end_time) ? $end_time : '';?>'/></td>
                    </tr>
                    <tr>
                        <td>Vanue</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="text" name="Location" placeholder="Location" size="150" value='<?php echo isset($location) ? $location : '';?>'/></td>
                    </tr>
                    <tr>
                        <td>
                            <select name="Country" value='<?php echo isset($country) ? $country : '';?>'>
                                <option>Malaysia</option>
                            </select>
                            <select name="State">
                                <option>Penang</option>
                                <option>Selangor</option>
                                <option>Johor</option>
                                <option>Kedah</option>
                                <option>Kelantan</option>
                                <option>Melaka</option>
                                <option>Negeri Sembilan</option>
                                <option>Pahang</option>
                                <option>Perak</option>
                                <option>Perlis</option>
                                <option>Sabah</option>
                                <option>Sarawak</option>
                                <option>Terengganu</option>
                            </select>
                        </td>
                    </tr>
                    <input type="file" name="fsImage" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <tr>
                        <td>
                            <h2 class="ct">Event Price</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" name="btnPrice" checked="checked" onclick="btn(0)"/>Paid
                            <input type="radio" name="btnPrice" value="Free" onclick="btn(1)"/>Free
                        </td>
                    </tr>
            </table>
                <div id="btn_Paid">
                    <textarea cols="150" name="Price" placeholder="Adult RMxx Children RMxx"></textarea>
                </div>
            
            <div>
                <table>
                    <tr>
                        <br />
                        <td style="width: 1500px;"><input type="button" value="Back" name="Back" onclick="window.location.href='Admin_Home.php';" /></td>
                        <td><input type="button" value="Reset" name="Reset" onclick="window.location.href='Admin_CForm.php';" /></td>
                        <td><input type="submit" value="Submit" name="Submit"/></td>
                    </tr>
                </table>
                    </form>
            </div>
        </div>
        <script>
            function btn(x){
            if(x===0)
                document.getElementById("btn_Paid").style.display='block';
            else
                document.getElementById("btn_Paid").style.display='none';
            return;
            }
            
        </script>
    </body>
</html>
