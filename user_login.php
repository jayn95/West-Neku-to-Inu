<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="design/design.css">
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
            </ul>
        </nav>
    </div>
    <!-- ADMIN LOGIN -->
    <div class="container">
        <div class="header">
            <h2>User Login</h2>
        </div>
        <form method="post" action="temp_post_v2.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="user_login">Login</button>
            </div>
        </form>
    </div>

<?php
session_start();
include('server.php');

if (isset($_POST['user_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_account WHERE username='$username'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Store user information in session
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $row['first_name']; // Store the user's first name in session
            header('Location: temp_post_v2.php');
            exit();
        } else {
            echo "Wrong username or password"; // Consider adding error handling to display errors on the page
        }
    } else {
        echo "Wrong username or password"; // Consider adding error handling to display errors on the page
    }
}
?>



</body>
</html>
