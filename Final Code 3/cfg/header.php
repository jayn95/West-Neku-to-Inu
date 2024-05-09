<?php 
session_start();
include "cfg/db_conn.php";

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Retrieve user's information from the database
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_account WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="design/design.css">
        <link rel="stylsheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/3.5.1/jquery.min.js"></script>
        <style>
            .navBar img {
                width: 40px; 
                height: 40px; 
                border-radius: 50%; 
                overflow: hidden; 
                margin-right: 5px;
                margin-top: 5px;
                margin-bottom: -5px;
            }
            .navBar span {
                vertical-align: middle; 
            }
        </style>
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <div class="navBar">
            <nav> 
                <ul class="navContents">
                    <li><a href="temporary_post.php">Home</a></li>
                    <li><a href="user_signup.php">Sign Up</a></li>
                    <li><a href="animal_view_profile.php">Animals</a></li>
                    <li><a href="animal_index.php">Add Animal</a></li>
                    <li><a href="forumshtml.php">Forum</a></li>
                    <li><a href="#">About us</a></li>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <li><a href="logout.php"><i class="fa fa-sign_out"></i>Logout</a></li>
                        <?php if(isset($row['image_prof'])) { ?>
                            <li><a href="#"><img src="uploads/<?= $row['image_prof']; ?>" alt="Profile Picture"></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li><a id="login" href="user_login.php"><i class="fa fa-sign-in"></i>Login</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>