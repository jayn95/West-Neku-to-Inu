<!-- animal_pic_react.php -->
<?php
include "db_conn.php";

// Check if petID is provided in the URL
if(isset($_GET['petID'])) {
    // Sanitize the input to prevent SQL injection
    $petID = mysqli_real_escape_string($db, $_GET['petID']);
    
    // Query to fetch detailed information of the particular animal
    $sql = "SELECT * FROM animalprofiles WHERE petID = $petID";
    $result = mysqli_query($db, $sql);
    
    // Check if the query was successful
    if($result && mysqli_num_rows($result) > 0) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);
        // Display the details

// Retrieve the initial like count from the database based on the pet ID
if (isset($_GET['petID'])) {
    $petId = $_GET['petID'];
    $stmt = $db->prepare("SELECT COUNT(*) AS likeCount FROM reactions WHERE petID = ?");
    $stmt->bind_param("i", $petId); // Assuming petID is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    $initialLikeCount = $result->fetch_assoc()['likeCount'];
    $stmt->close();
} else {
    $initialLikeCount = 0; // Set a default value if pet ID is not provided
}
?>

        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Animal Details</title>
                <link rel="stylesheet" href="design/design.css">
                <link rel="stylesheet" href="design/animal_profile.css">
                <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

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
                <!-- ANIMAL DETAILS -->
                <div class="animalDetails">
                    <h2>Animal Details</h2>
                    <div class="animalProfile">
                        <div class="animalImage">
                            <div class="image-container">
                                <img src="uploads/<?=$row["image_url"]?>">
                                <div class="heart-btn">
                                    <div class="content">
                                        <span class="heart"></span>
                                        <span class="text">Like</span>
                                        <span class="numb" id="LikeCount">
                                            <?php
                                            echo $initialLikeCount; // Output initial like count obtained from PHP
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="animalInfo">
                            <br></br>
                            <h3><strong>Name:</strong> <?=$row["name"]?> </h3>
                            <p><strong>Breed:</strong> <?=$row["breed"]?></p>
                            <p><strong>Description:</strong> <?=$row["description"]?> </p>
                        </div>
                    </div>
                </div>

                <script>
                $(document).ready(function() {
                    // Click event for heart button
                    $('.heart-btn').click(function() {
                        $(this).toggleClass('heart-active'); // Toggle heart button class
                        var petId = <?php echo $row["petID"]; ?>; // Get the pet ID from PHP
                        var action = 'like'; // Define the action

                        // AJAX request to handle like action
                        $.ajax({
                            url: 'animal_pic_react.php', // URL of the PHP script
                            type: 'POST', // HTTP method
                            data: { petID: petId, action: action }, // Data to be sent to the server
                            success: function(response) { // Callback function to handle successful response
                                $('#likeCount').text(response); // Update the like count element with the response
                            },
                            error: function(xhr, status, error) { // Callback function to handle error response
                                console.error(xhr.responseText); // Log the error message
                            }
                        });
                    });

                    // Click event for heart react button
                    $('.content').click(function() {
                        $('.content').toggleClass("heart-active")
                        $('.text').toggleClass("heart-active")
                        $('.numb').toggleClass("heart-active")
                        $('.heart').toggleClass("heart-active")
                    });
                });
                </script>

            </body>
        </html>
        <?php
    } else {
        // No animal found with the provided petID
        echo "Animal not found!";
    }
} else {
    // petID is not provided in the URL
    echo "Invalid request!";
}
?>
