<?php
include "cfg/db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

     // Insert new data into database
     $insert_sql = "UPDATE INTO adminaccount(username, first_name, last_name, password)
     VALUES('$username', '$first_name', '$last_name', '$password')";

     // Modify data
     $modify_sql = "UPDATE adminaccount
        SET first_name = '$first_name',
            last_name = '$last_name',
            password = '$password'
        WHERE username = '$username'";
 

    mysqli_query($db, $modify_sql);
    header("Location: admin.html");
    exit();
    } 
else {
header("Location: admin_profile.php");
exit();
    }

// Close connection
$db->close();
?>
