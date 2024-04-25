<?php
// Database connection
include "cfg/db_conn.php";

// Approve action
if (isset($_POST['approve'])) {
    $petID = $_POST['petID'];
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    // Insert into database
    $sql = "INSERT INTO animalprofiles (petID, name, breed, description, image_url) VALUES ('$petID', '$name', '$breed', '$description', '$image_url')";

    if ($db->query($sql) === TRUE) {
        echo "Record approved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Reject action
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

$db->close();
?>
