<?php
// Database connection
include "cfg/db_conn.php";

// Reject action
if (isset($_POST['reject'])) {
    $petID = $_POST['petID'];

    // Delete from database
    $remove_sql = "DELETE FROM animalprofiles WHERE petID='$petID'";

    if ($db->query($remove_sql) == TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Save new profile to animalprofiles table
if (isset($_POST['name']) && isset($_POST['breed']) && isset($_POST['description']) && isset($_FILES['profile_pic'])) {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    
    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_url = $target_file;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);
        $sql = "INSERT INTO animalprofiles (name, breed, description, image_url) VALUES ('$name', '$breed', '$description', '$image_url')";
        if (mysqli_query($db, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    } else {
        echo "File is not an image.";
    }
}

$db->close();
?>
