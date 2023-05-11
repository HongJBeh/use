<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

define('HOST', "airasia-db.cpfvj1jupn9o.us-east-1.rds.amazonaws.com");
define('USER', "airasia");
define('PASS', "airasia123");
define('NAME', "assignment");

function checkEventNo($eventNo) {
    // Check if eventNo is empty
    if($eventNo == NULL){
        return "Please fill in your Event Number.";
    }
    // Check if eventNo is not 4 characters long
    elseif (strlen ($eventNo) != 4 ) {
        return "Event Number must be 4 characters long.";
    }
    // Check if eventNo is already in use
    else {
        // connect to the database
        $conn = new mysqli(HOST, USER, PASS, NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = mysqli_prepare($conn, "SELECT event_no FROM event WHERE event_no = ?");
        mysqli_stmt_bind_param($stmt, "s", $eventNo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $count = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        if($count > 0){
            return "Event Number is already in use.";
        }
    }
    // Return an empty string if eventNo is valid
    return "";
}


function checkTitle($title) {
    if($title == NULL){
        return "Please fill in your title.";
    }elseif (strlen ($title) > 255 ) {
        return "Title cannot more than 255 character.";
    }
}

function checkDescription($description) {
    if($description == NULL){
        return "Please fill in your description.";
    }
}

function checkStartDate($start_date) {
    if($start_date == NULL){
        return "Please fill in your start date.";
    }
}

function checkEndDate($end_date) {
    if($end_date == NULL){
        return "Please fill in your end date.";
    }
}

function checkStartTime($start_time) {
    if($start_time == NULL){
        return "Please fill in your start time.";
    }
}

function checkEndTime($end_time) {
    if($end_time == NULL){
        return "Please fill in your end time.";
    }
}

function checkLocation($location) {
    if($location == NULL){
        return "Please fill in your location.";
    }elseif (strlen ($location) > 255 ) {
        return "Location cannot more than 255 character.";
    }
}

function checkPrice($price) {
    if(strlen ($price) > 255 ) {
        return "Price Details cannot more than 255 character.";
    }
}

function checkImage($image){
    if ($image['error'] === UPLOAD_ERR_NO_FILE) {
        return "No image was uploaded!";
    }
    elseif ($image['error'] === UPLOAD_ERR_FORM_SIZE) {
        echo "File uploaded is too large. Maximum 1MB allowed!";
    }
    elseif ($image['error'] === UPLOAD_ERR_NO_FILE) {
        echo "There was an error when uploading the file!";
    }
    elseif ($image['size'] > 1048576) {
        echo "File uploaded is too large. Max 1MB allowed!";
    }
    
    //extract file extension, eg: png, jpg, gif
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    //check file extension
    if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png'){
        return "Only JPG, GIF and PNG images are allowed.";
    }
}


function checkMemberID($id){
    if($id == NULL){
        return "Please Enter Your Member/Student ID!";
    }elseif (!preg_match("/^[0-9]{2}[A-Z]{3}\d{5}$/", $id)) {
        return "Invalid Member/Student ID!";
    }elseif (checkDuplicateID($id)) {
        return "Duplicated Member/Student ID Detected";
    }
}
function checkDuplicateID($id){
    $exist = false;
    $connection = new mysqli(HOST, USER, PASS, NAME);
    $sql = "SELECT * FROM member WHERE MemberID = '$id'";
    if($result = $connection -> query($sql)){
        if ($result -> num_rows>0) {
            $exist = ture;
        }
    }
    $connection -> close();
    $result ->free();
    return $exist;
}
            
function checkMemberName($name) {
    if($name == NULL){
        return "Please Enter Your Name!";
    }elseif (strlen ($name) > 50 ) {
        return "Name too long!";
    }elseif (!preg_match("/^[A-Za-z@ ,\.\-\'\/]+$/", $name)){
        return "Name is acceptable";
    }
}

function checkGender($gender) {
    if($gender == NULL){
        return "Please Enter Your Gender";
    }elseif (!array_key_exists($gender, getAllGender())) {
        return "Invalid Gender";
    }
}

function getAllGender(){
    return array(
        "M"=>"Male",
        "F"=>"Female",
    );
}
function checkPhoneNumber($phone){
    if($phone == NULL){
        return "Please Enter Your Phone Number!";
    }elseif (!preg_match("/^[0-9]{3}[1-9]{3}\d{4,5}$/", $phone)) {
        return "Invalid Phone Number!";
    }elseif (!ctype_digit($phone)) {
        return false;
    }
}
function checkEmail($email){
    if ($email == NULL){
        return "Please Enter Your E-mail!";
    }elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        return false;
    }
}
function checkPassword($password){
    if ($password == NULL){
        return "Please Enter Your Password!";
    }elseif (strlen($password) < 8) {
        return "Password too short, Please Enter Again!";
    }
}
function checkConfirmPassword($confirmpw, $password){
    if ($confirmpw == NULL){
        return "Please Enter Again Your Password!";
    }elseif ($password !== $confirmpw) {
        return "Password is different";
    }
}

function checkEventID($id){
    
    if($id == NULL)
    {
        return "Please fill up the Event ID";
    } 
}

function duplicatedEventID($id){
    $exist = false;
    $connection = new mysqli(HOST,USER,PASS,NAME);
    $sql = "SELECT * FROM manage WHERE EventID='$id'";
    if($result = $connection ->query($sql)) {
        if($result ->num_rows>0) {
            $exist = true;
            
        }
    }
    $connection ->close();
    $result ->free();
    return $exist;
}


function checkEventName ($name) {
    if($name == NULL){
        return "Please fill up the Event name";
    }
    else if(strlen($name) > 50){
        return "Event Name cannot more than 50 character";
        
    }
}

function checkDuplicatedEName($eName)
{

    $exist = FALSE;
    $con = new mysqli(HOST, USER, PASS, NAME);
    $id = $con ->real_escape_string($eName);
    $sql = "SELECT * FROM events WHERE EventName = '$eName'";
    if($result = $con->query($sql))
    {
        if($result -> num_rows > 0)
        {
            $exist = TRUE;
        }
    }
    $result->free();
    $con->close();
    return $exist;
}

function checkPriceError($price){
    
    if($price == NULL)
    {
        return "Please fill up the Price";
    }
    else if(!preg_match('/^[0-9]+$/', $price))
    {
        return "Price fill up number only!";
    }
}

function checkSeatError($seat){
    
    if($seat == NULL)
    {
        return 'Please fill up the Seat';
    }
    else if(!preg_match('/^[0-9]+$/', $seat))
    {
        return "Seat fill up number only!";
    }
}

function checkTicketID($tid){
    
    if($tid == NULL)
    {
        return "Please fill up the Ticket ID";
    } 
}


function duplicatedTicketID($tid){
    $exist = false;
    $connection = new mysqli(HOST,USER,PASS,NAME);
    $sql = "SELECT * FROM ticket WHERE TicketID='$tid'";
    if($result = $connection ->query($sql)) {
        if($result ->num_rows>0) {
            $exist = true;
            
        }
    }
    $connection ->close();
    $result ->free();
    return $exist;
}

function checkUsernameError($username)
{
    if($username == NULL)
    {
        return 'Username must be *Filled Up*';
    }
    else if(!preg_match('/^[A-Z a-z]+$/', $username))
    {
        return 'Username can only be in *Alphabets*';
    }
}

function checkEmailError($email){
    if($email == NULL){
        return 'Please type your email.';
    }
    else if(!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)){
        return 'Please enter a correct email.';
    }
    else if(strlen($email)>30){
        return 'Your email is too long. Please enter again';
    }
}

function checkContact($contact)
{
    if($contact == NULL)
    {
    return 'Contact must be filled up!';
    }
    else if(!preg_match('/^01[0-9]-\d{7}$/', $contact))
    {
    //check phone number format
    return 'Your <strong>phone number</strong> is in wrong format. Please try again!';
    }
}