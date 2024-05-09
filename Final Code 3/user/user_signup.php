<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign In</title>
        <link rel="stylesheet" href="../design/design.css">
        <link rel="stylesheet" href="../design/user_login_design.css">
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <?php include "header.php"; ?>

        <!-- USER SIGN IN -->
        <h2>Sign In</h2>
        <?php if (isset($_GET['error'])): ?>
            <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <form method="post"
            action="user_server.php"
            enctype="multipart/form-data">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br><br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br><br>
            <label for="email_address">Email Address:</label>
            <input type="text" id="email_address" name="email_address" required><br><br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Sign In"> 
        </form>
        <div class="login-reference">
            <p>Already have an account? <a href="user_login.php">Login here</a></p>
        </div>
    </body>
</html>