<?php
include "db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];

     // Insert into database
     $sql = "INSERT INTO user_account(username, first_name, last_name, email_address, password)
     VALUES('$username', '$first_name', '$last_name', '$email_address', '$password')";

    mysqli_query($db, $sql);
    header("Location: animal_view_profile.php");
    exit();
    } 
else {
header("Location: user_signup.php");
exit();
    }

// Close connection
$db->close();
?>
