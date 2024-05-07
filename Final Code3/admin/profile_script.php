<?php
include "cfg/db_conn.php";

// Delete row from animalprofiles table
if (isset($_POST['reject'])) {
    $petID = $_POST['petID'];

    // Delete from database
    $sql = "DELETE FROM animalprofiles WHERE petID='$petID'";

    if ($db->query($sql) === TRUE) {
        echo "Record rejected successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Modify row in animalprofiles table
if (isset($_POST['petID']) && isset($_POST['name']) && isset($_POST['breed']) && isset($_POST['description']) && isset($_POST['image_url'])) {
    $petID = $_POST['petID'];
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE animalprofiles SET name='$name', breed='$breed', description='$description', image_url='$image_url' WHERE petID=$petID";
    if (mysqli_query($db, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($db);
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
?>
