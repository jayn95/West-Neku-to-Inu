<?php
// Include the database connection file
include "cfg/db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_profile_btn'])) {
    // Get form data
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $description = $_POST["description"];

    // Handle image upload
    $image_url = ""; // Initialize image URL variable
    if(isset($_FILES['profile_pic'])){
        $errors= array();
        $file_name = $_FILES['profile_pic']['name'];
        $file_size =$_FILES['profile_pic']['size'];
        $file_tmp =$_FILES['profile_pic']['tmp_name'];
        $file_type=$_FILES['profile_pic']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['profile_pic']['name'])));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
            $errors[]='File size must be less than 2 MB';
        }
        
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"uploads/".$file_name);
            $image_url = "uploads/".$file_name;
        }else{
            print_r($errors);
        }
    }

    // Insert data into database
    $sql = "INSERT INTO animalprofiles (name, breed, description, image_url) VALUES ('$name', '$breed', '$description', '$image_url')";
    if (mysqli_query($db, $sql)) {
        echo "New profile added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>
