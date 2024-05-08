<!-- animal_pic_react.php -->
<?php
include "header.php";
include "cfg/db_conn.php";

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
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Admin Posts</title>
                <link rel="stylesheet" href="design/design.css">
                <link rel="stylesheet" href="design/style.css">
                <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
                <style>
                    .full-container {
                        max-width: 600px; 
                        width: 100%;
                        padding: 20px;
                        border: 1px solid #ccc;
                        border-radius: 10px;
                        justify-content: center;
                        align-items: center;
                        display: flex;
                        flex-direction: column;
                        margin: auto;
                    }
                    /* Container for all posts */
                    .posts-container {
                        display: flex; /* Use flexbox */
                        flex-direction: column; /* Arrange items vertically */
                        align-items: center; /* Center items horizontally */
                        margin-top: 20px; /* Add some top margin */
                    }

                    /* Container for each post */
                    .post {
                        width: 400px; /* Set a fixed width for each post */
                        margin-bottom: 20px;
                        margin-top: 20px;
                        border: 1px solid #ccc;
                        padding: 10px;
                        border-radius: 5px;
                    }

                    .profile-info {
                        display: flex;
                        align-items: center;
                    }

                    .profile-picture {
                        width: 50px; /* Adjust the size of the profile picture */
                        height: 50px;
                        border-radius: 50%; /* Create a circular shape */
                        overflow: hidden; /* Hide any overflow content */
                        margin-right: 10px; /* Add margin for spacing */
                    }

                    .profile-picture img {
                        width: 100%; /* Make the image fill the container */
                        height: auto;
                        border-radius: 50%; /* Ensure the image is also circular */
                    }

                    .admin-info {
                        display: flex; /* Use flexbox */
                        flex-direction: column; /* Arrange items vertically */
                    }

                    .admin-name {
                        font-weight: bold;
                        margin-left: 7px; 
                    }

                    .date-created {
                        font-size: 0.7em; 
                        margin-top: 3px;
                        margin-left: 7px;
                    }

                    /* Title of the post */
                    .post h3 {
                        margin-top: 10px;
                    }

                    .post-image {
                        margin-bottom: 10px; 
                        text-align: center; 
                    }

                    .post-image img {
                        display: inline-block; 
                        max-width: 100%; 
                        max-height: 200px; 
                        object-fit: cover; 
                        border-radius: 5px; 
                    }
                    
                </style>
            </head>
            <body>
                <div class="full-container">
                    <?php
                    $sql_posts = "SELECT ap.*, aa.username, aa.pic_url
                                    FROM admin_posts AS ap
                                    JOIN adminaccount AS aa ON ap.adminID = aa.adminID";
                    $result_posts = $db->query($sql_posts);

                    if ($result_posts->num_rows > 0) {
                        // Output data of each row
                        while($row = $result_posts->fetch_assoc()) {
                            ?> 
                            <div class="post">
                                <div class="profile-info">
                                    <div class="profile-picture">
                                        <?php if ($row["pic_url"]) : ?>
                                            <img src="uploads/<?=$row["pic_url"]; ?>" alt="Admin Profile Picture">
                                        <?php endif; ?>
                                    </div>
                                    <div class="admin-info">
                                        <div class="admin-name">
                                            <?php echo $row["username"]; ?>
                                        </div>
                                        <div class="date-created">
                                            <?php echo date("M d, Y", strtotime($row["date_created"])); ?>
                                        </div>
                                    </div>
                                </div>
                                <h3><?php echo $row["title"]; ?></h3>
                                <p><?php echo $row["content"]; ?></p>
                                <div class="img-container">
                                    <div class="post-image">
                                        <img src="uploads/<?=$row["picture"]?>" alt="Post Image">
                                    </div>
                                </div>
                                <div class="content" onclick="toggleHeart(this)">
                                    <span class="heart"></span>
                                    <span class="text">Like</span>
                                    <span class="numb" id="LikeCount">
                                        <?php
                                        echo $initialLikeCount; 
                                        ?>
                                    </span> 
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No posts found.";
                    }
                    $db->close();
                    ?>
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
                            url: 'post_reaction_script.php',
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
}}
?>