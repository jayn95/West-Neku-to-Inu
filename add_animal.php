<?php
include "db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $description = $_POST['description'];

    // UPLOAD IMAGE for routeLink
    if (isset($_FILES['routeLink'])) {
        $routeLink_img_name = $_FILES['routeLink']['name'];
        $routeLink_img_size = $_FILES['routeLink']['size'];
        $routeLink_tmp_name = $_FILES['routeLink']['tmp_name'];
        $routeLink_error = $_FILES['routeLink']['error'];
    
        if ($routeLink_error === 0) {
            if ($routeLink_img_size >  5000000) {
                $em = "Sorry, your routeLink file is too large!";
                header("Location: animal_index.php?error=$em");
                exit();
            } else {
                $routeLink_img_ex = pathinfo($routeLink_img_name, PATHINFO_EXTENSION);
                $routeLink_img_ex_lc = strtolower($routeLink_img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png", "gif");
    
                if (in_array($routeLink_img_ex_lc, $allowed_exs)) {
                    $new_routeLink_img_name = uniqid("ROUTE-", true).'.'.$routeLink_img_ex_lc;
                    $routeLink_img_upload_path = 'uploads/'.$new_routeLink_img_name;
                    move_uploaded_file($routeLink_tmp_name, $routeLink_img_upload_path);
                } else {
                    $em = "You can't upload files of this type for routeLink";
                    header("Location: animal_index.php?error=$em");
                    exit();
                }
            }
        } else {
            $em = "Unknown error occurred for routeLink!";
            header("Location: animal_index.php?error=$em");
            exit();
        }
    } else {
        $em = "Please select a file for the routeLink!";
        header("Location: animal_index.php?error=$em");
        exit();
    }

    // UPLOAD IMAGE for image_url
    if (isset($_FILES['image_url'])) {
        $image_url_img_name = $_FILES['image_url']['name'];
        $image_url_img_size = $_FILES['image_url']['size'];
        $image_url_tmp_name = $_FILES['image_url']['tmp_name'];
        $image_url_error = $_FILES['image_url']['error'];
    
        if ($image_url_error === 0) {
            if ($image_url_img_size >  5000000) {
                $em = "Sorry, your image_url file is too large!";
                header("Location: animal_index.php?error=$em");
                exit();
            } else {
                $image_url_img_ex = pathinfo($image_url_img_name, PATHINFO_EXTENSION);
                $image_url_img_ex_lc = strtolower($image_url_img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png", "gif");
    
                if (in_array($image_url_img_ex_lc, $allowed_exs)) {
                    $new_image_url_img_name = uniqid("IMG-", true).'.'.$image_url_img_ex_lc;
                    $image_url_img_upload_path = 'uploads/'.$new_image_url_img_name;
                    move_uploaded_file($image_url_tmp_name, $image_url_img_upload_path);
                } else {
                    $em = "You can't upload files of this type for image_url";
                    header("Location: animal_index.php?error=$em");
                    exit();
                }
            }
        } else {
            $em = "Unknown error occurred for image_url!";
            header("Location: animal_index.php?error=$em");
            exit();
        }
    } else {
        $em = "Please select a file for the image_url!";
        header("Location: animal_index.php?error=$em");
        exit();
    }

    // Insert into database
    $sql = "INSERT INTO animalprofiles(name, breed, description, image_url, routeLink)
            VALUES('$name', '$breed', '$description', '$new_image_url_img_name', '$new_routeLink_img_name')";
    mysqli_query($db, $sql);
    header("Location: animal_view_profile.php");
    exit();
} else {
    header("Location: animal_index.php");
    exit();
}

// Close connection
$db->close();
?>
