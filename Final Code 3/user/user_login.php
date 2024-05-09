<?php
$username = $err_msg = "";

include "../cfg/db_conn.php";
include "header.php";
if (isset($_POST['user_login'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // $password = md5($_POST['password']);

    $sql = "SELECT * from user_account where username = ? and password = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
      if( $stmt->execute() ){
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['image_prof'] = $row['image_prof'];
            header("location:animal_view_profile.php");

        }
        else {
            $err_msg = "Invalid username/password";
        }
    }
    else {
        $err_msg = "Some error occurred"; 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../design/design.css">
</head>
<body>
    <!-- ADMIN LOGIN -->
    <div class="container">
        <div class="header">
            <h2>User Login</h2>
        </div>
        <form method="post" action="user_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username"
                placeholder = "Enter you Username" required>
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

</body>
</html>
