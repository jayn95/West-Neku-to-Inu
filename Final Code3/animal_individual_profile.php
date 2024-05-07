<!-- animal_pic_react.php -->
<?php
include "header.php";
include "cfg/db_conn.php";

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
        $row = mysqli_fetch_assoc($result);}
        // Display the details

// Function to get initial like count for a petID
function getInitialLikeCount($db, $petID) {
    $sql = "SELECT COUNT(*) as totalLikes FROM reactions WHERE petID = $petID";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalLikes'];
}

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
        // Get initial like count
        $initialLikeCount = getInitialLikeCount($db, $petID);
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
                <!-- ANIMAL DETAILS -->
                <div class="animalDetails">
                    <h2>Animal Details</h2>
                    <div class="animalProfile">
                        <div class="animalImage">
                            <div class="image-container">
                                <img src="<?=$row["image_url"]?>">
                                <div class="heart-btn"  data-petid="<?=$petID?>">
                                    <div class="content">
                                        <span class="heart"></span>
                                        <span class="text">Like</span>
                                        <span class="numb" id="LikeCount">
                                            <?php
                                            echo $initialLikeCount; 
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
                    // Click event for heart react button
                    $('.heart-btn').click(function() {
                        var petID = $(this).data('petid');
                        var userID = <?php echo isset($_SESSION['userID']) ? $_SESSION['userID'] : 'null'; ?>;
                        var likeCount = parseInt($('#LikeCount').text());
                        var liked = $(this).hasClass('heart-active'); // Check if the button is already liked

                        $.ajax({
                            type: 'POST',
                            url: 'like_handler.php',
                            data: { userID: userID, petID: petID, liked: !liked },
                            success: function(response) {
                                if(response == 'liked') {
                                    // If the button was not liked, add the like
                                    if (!liked) {
                                        $(this).addClass("heart-active");
                                        $('#LikeCount').text(likeCount + 1);
                                        // Increment like count
                                        likeCount++;
                                    }
                                } else if(response == 'unliked') {
                                    // If the button was liked, remove the like
                                    if (liked) {
                                        $(this).removeClass("heart-active");
                                        $('#LikeCount').text(likeCount - 1);
                                        // Decrement like count
                                        likeCount--;
                                    }
                                }
                            }.bind(this), // Ensure the proper context for 'this'
                            error: function(xhr, status, error) {
                                // Handle errors if any
                                console.error(xhr.responseText);
                            }
                        });
                    });

                    // Click event for heart react button
                    $('.content').click(function() {
                        $(this).toggleClass("heart-active")
                        $('.text').toggleClass("heart-active")
                        $('.numb').toggleClass("heart-active")
                        $('.heart').toggleClass("heart-active")
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
}}
?>