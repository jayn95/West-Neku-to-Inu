<?php
// Database connection
include "cfg/db_conn.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption = $_POST['caption'];
    $userId = $_POST['petID']; // Assuming you have added userId to the form
    
    // Handle file upload for photos
    $fileNames = array();
    $photos = $_FILES['photo'];
    $numFiles = count($photos['name']);
    $uploadDirectory = 'uploads/'; // Directory to store uploaded files
    
    // Process and move uploaded files to a directory on the server
    for ($i = 0; $i < $numFiles; $i++) {
        $fileName = uniqid() . '_' . basename($photos['name'][$i]);
        $targetFilePath = $uploadDirectory . $fileName;
        if (move_uploaded_file($photos['tmp_name'][$i], $targetFilePath)) {
            $fileNames[] = $targetFilePath;
        } else {
            echo "Failed to upload file.";
            // Handle error
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO admin_posts (petID, adminID, title, content, picture, date_created) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $petID, $adminId, $title, $content, $picture);
    $petID = 1; // Sample value, you should retrieve this from the form
    $adminId = 1; // Sample value, you should retrieve this from the form
    $title = "Sample Title"; // Sample value, you should retrieve this from the form
    $content = "Sample Content"; // Sample value, you should retrieve this from the form
    $picture = "path/to/picture.jpg"; // Sample value, you should retrieve this from the form after uploading
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
