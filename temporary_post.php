<?php
include "db_conn.php";
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
        .container {
            max-width: 600px; /* Adjust the maximum width of the container */
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 20px;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;
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
    <!-- NAVIGATION BAR -->
    <div class="navBar">
                    <nav> 
                        <ul class="navContents">
                            <li><a href="temporary_post.php">Home</a></li>
                            <li><a href="user_signup.php">Sign Up</a></li>
                            <li><a href="animal_view_profile.php">Animals</a></li>
                            <li><a href="animal_index.php">Add Animal</a></li>
                            <li><a href="forumshtml.php">Forum</a></li>
                            <li><a href="#">About us</a></li>

                            <?php
                            // Check if user is logged in
                            if(isset($_SESSION['userID'])) {
                                // Fetch user profile image URL from user_account table
                                $user_id = $_SESSION['userID'];
                                $profile_query = "SELECT image_prof FROM user_account WHERE userID='$user_id'";
                                $profile_result = mysqli_query($db, $profile_query);
                                $profile_data = mysqli_fetch_assoc($profile_result);
                                $profile_image = $profile_data['image_prof'];
                                ?>
                                <!-- Display user profile image in the navigation bar -->
                                <li><img src="uploads/<?=$profile_image; ?>" alt="Profile Image"></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
    <div class="container">
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
                    <span class="numb" id="LikeCount"></span> 
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
        function toggleHeart(element) {
            $(element).find('.heart').toggleClass("heart-active");
            $(element).find('.text').toggleClass("heart-active");
            $(element).find('.numb').toggleClass("heart-active");
        }
    </script>
</body>
</html>
