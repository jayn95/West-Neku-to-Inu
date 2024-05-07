<?php
// Include the database connection file
include "cfg/db_conn.php";
include "header.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['name'];
    $content = $_POST['content'];

    // Prepare an SQL statement to insert data into the forum_subject table
    $sql = "INSERT INTO forum_subject (subject, content) VALUES (?, ?)";
    
    // Prepare the SQL statement
    $stmt = $db->prepare($sql);
    
    // Check if the statement is prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $title, $content);
        if ($stmt->execute()) {
            // If the insertion is successful, redirect to the forum page
            header("Location: forumshtml.php");
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
    <body>

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
            <input type="submit" name="submit" value="Submit"> 
        </form>

    </body>
</html>