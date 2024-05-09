<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../design/design.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include "cfg/header.php"; ?>
    
    <!-- ADMIN LOGIN -->
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <form method="post" action="admin.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="login_user">Login</button>
            </div>
        </form>
    </div>

<?php

include('cfg/server.php');

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM adminaccount WHERE username='$username'";
    $result = $db->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit();
        } else {
            array_push($errors, "Wrong username or password");
        }
    } else {
        array_push($errors, "Wrong username or password");
    }
}
?>

</body>
</html>
