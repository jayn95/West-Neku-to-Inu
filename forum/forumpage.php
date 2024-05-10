<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <link rel="stylesheet" href="design/design.css">
        <link rel="stylesheet" href="design/style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <style>
            /* Title of the post */
            .post h3 {
                margin-top: 10px;
            }

            .pic-container {
                margin-bottom: 10px; 
                text-align: center; 
            }

            .pic-container img {
                display: inline-block; 
                max-width: 100%; 
                max-height: 200px; 
                object-fit: cover; 
                border-radius: 5px; 
            }
        
            .container {
                max-width: 1000px; 
                width: 100%;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
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
            
            .forumbtn {
                background-color: #c2fbd7;
                border-radius: 100px;
                box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset,rgba(44, 187, 99, .15) 0 1px 2px,rgba(44, 187, 99, .15) 0 2px 4px,rgba(44, 187, 99, .15) 0 4px 8px,rgba(44, 187, 99, .15) 0 8px 16px,rgba(44, 187, 99, .15) 0 16px 32px;
                color: green;
                cursor: pointer;
                display: inline-block;
                padding: 7px 20px;
                text-align: center;
                text-decoration: none;
                transition: all 250ms;
                border: 0;
                font-size: 16px;
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                position: fixed;
                bottom: 20px;
                right: 20px;
            }
    
            .forumbtn:hover {
                box-shadow: rgba(44,187,99,.35) 0 -25px 18px -14px inset,rgba(44,187,99,.25) 0 1px 2px,rgba(44,187,99,.25) 0 2px 4px,rgba(44,187,99,.25) 0 4px 8px,rgba(44,187,99,.25) 0 8px 16px,rgba(44,187,99,.25) 0 16px 32px;
                transform: scale(1.05) rotate(-1deg);
            }
        </style>
        
    </head>
    <body>
        <?php include "header.php"; ?>
            <div class ="container">
        <?php
        // Prepare an SQL statement to select all posts from the forum_subject table
        $sql_forum = "SELECT sub.*, ua.*
                        FROM forum_subject AS sub
                        JOIN user_account AS ua ON sub.userID = ua.userID";
        $result_forum = $db->query($sql_forum);

        if ($result_forum->num_rows > 0) {
            // Output data of each row
            while($row = $result_forum->fetch_assoc()) {
                ?> 
                <div class="post">
                    <h3><?php echo $row["title"]; ?></h3>
                        <div class="admin-info">
                            <div class="admin-name">
                                <?php echo $row["username"]; ?>
                            </div>
                            <div class="date-created">
                                <?php echo date("M d, Y", strtotime($row["date_created"])); ?>
                            </div>
                            
                        </div>
                    <p><?php echo $row["fcontent"]; ?></p>
                    <div class="pic-container">
                        <img src="<?=$row["picture"]?>" alt="Post Image">
                    </div>
                    <div class="content" onclick="toggleHeart(this)">
                        <span class="heart"></span>
                        <span class="text">Like</span>
                        <span class="numb" id="LikeCount"></span> 
                    </div>
                    <a href="forumpageredirect2.php?content_id=<?php echo $row['content_id']; ?>">View Comments</a>
                </div>
                <?php
            }
        } else {
            echo "No posts found.";
        }
        $db->close();
        ?>
        </div>
        <button onclick="location.href = 'forumshtml.php';" id="add_forum" class="forumbtn" role="button">Add Forum</button>
    </body>
</html>
