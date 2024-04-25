<?php
include "cfg/db_conn.php";

// Delete row from animalprofiles table
if (isset($_POST['delete_petID'])) {
    $petID = $_POST['delete_petID'];
    $sql = "DELETE FROM animalprofiles WHERE petID = $petID";
    if (mysqli_query($db, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($db);
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
if (isset($_POST['new_name']) && isset($_POST['new_breed']) && isset($_POST['new_description']) && isset($_FILES['new_profile_pic'])) {
    $new_name = $_POST['new_name'];
    $new_breed = $_POST['new_breed'];
    $new_description = $_POST['new_description'];
    
    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["new_profile_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_image_url = $target_file;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["new_profile_pic"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["new_profile_pic"]["tmp_name"], $target_file);
        $sql = "INSERT INTO animalprofiles (name, breed, description, image_url) VALUES ('$new_name', '$new_breed', '$new_description', '$new_image_url')";
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
