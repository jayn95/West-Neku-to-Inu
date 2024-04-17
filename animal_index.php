<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Animal Profile</title>
        <link rel="stylesheet" href="design/design.css">
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <div class="navBar">
            <nav> 
                <ul class="navContents">
                    <li><a href="#">Home</a></li>
                    <li><a href="user_signup.php">Sign Up</a></li>
                    <li><a href="animal_view_profile.php">Animals</a></li>
                    <li><a href="animal_index.php">Add Animal</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">About us</a></li>
                </ul>
            </nav>
        </div>

        <!-- ADD ANIMAL -->
        <h2>Add Animal Profile</h2>
        <?php if (isset($_GET['error'])): ?>
            <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <form method="post"
            action="animal_profile.php"
            enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
            <label for="image_url">Upload Animal Image:</label>
            <input type="file"name="image_url">
            <label for="routeLink">Upload Route Image:</label>
            <input type="file" name="routeLink"><br><br>
            <input type="submit" name="submit" value="Add Profile"> 
        </form>

    </body>
</html>