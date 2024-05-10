<?php   
// Include the database connection file
include "cfg/db_conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    // Retrieve form data
    $title = $_POST['name'];
    $content = $_POST['content'];
    
    // Retrieve user ID based on username
    // This assumes you have a session variable storing the username
    $username = $_SESSION['username'];// Adjust this line according to your session variable name
    
    // Query to fetch user_id based on username
    $query = "SELECT userID FROM user_account WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['userID'];
    
    // File upload handling
    $target_dir = "uploads/"; // Directory where the file will be stored
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file is selected
    if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    
    $sql = "INSERT INTO forum_subject (title, fcontent, picture, userID) VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $db->prepare($sql);
    
    // Check if the statement is prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssss", $title, $content, $target_file, $user_id);
        if ($stmt->execute()) {
            // If the insertion is successful, redirect to the forum page
            header("Location: forumpage.php");
            exit();
        } else {
            // If an error occurs, set the 'error' parameter in the URL and redirect back to the form page
            header("Location: forumshtml.php?error=Failed to submit forum post.");
            exit();
        }
    } else {
        // Handle error if statement preparation fails
        echo "Error: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <link rel="stylesheet" href="design/design.css">
    </head>
    <style>
        body h2{
            margin: 1em;
        }
    </style>
    <body>
        <?php include "header.php" ?>

        <h2>Add New Forum</h2>
        <?php if (isset($_GET['error'])): ?>
            <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <form method="post"
            action="forumshtml.php"
            enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" name="submit" value="Submit"> 
        </form>

    </body>
</html>
