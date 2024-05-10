<?php   
// Include the database connection file
include "cfg/db_conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    // Retrieve form data
    $comment = $_POST['comment'];
    $content_id = $_GET['content_id']; // Get content ID from URL parameter

    // Retrieve user ID based on username
    // This assumes you have a session variable storing the username
    $username = $_SESSION['username']; // Adjust this line according to your session variable name
    
    // Query to fetch user_id based on username
    $query = "SELECT userID FROM user_account WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_id = $row['userID'];
    
    // File upload handling for comment image (if needed)
    // Similar to the file upload process for the forum post
    
    // Insert comment into database
    $sql = "INSERT INTO forum_comments (userID, comment, content_id) VALUES (?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $db->prepare($sql);
    
    // Check if the statement is prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $user_id, $comment, $content_id);
        if ($stmt->execute()) {
            // If the insertion is successful, redirect back to the forum page
            header("Location: forumpageredirect2.php?content_id=$content_id");
            exit();
        } else {
            // If an error occurs, set the 'error' parameter in the URL and redirect back to the form page
            header("Location: forumpageredirect2.php?content_id=$content_id&error=Failed to submit comment.");
            exit();
        }
    } else {
        // Handle error if statement preparation fails
        echo "Error: " . $db->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forums</title>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

        <style>     
            .container {
                max-width: 700px; 
                width: 100%;
                padding-top: 20px;
                border: 1px solid #ccc;
                border-radius: 10px;
                display: flex;
                flex-direction: column;
            }

            .date-created{
                
            }

            .pic-container {
                margin-bottom: 10px; 
                text-align: center; 
            }

            .pic-container img {
                max-width: 100%; /* Ensures the image doesn't exceed the width of its container */
                max-height: 400px; /* Set a fixed height for the image */
                width: auto; /* Ensures the image maintains its aspect ratio */
                height: auto; /* Ensures the image maintains its aspect ratio */
                object-fit: cover; /* Scales the image while preserving its aspect ratio and cropping to fill its container */
                border-radius: 5px;
            }

            .post h2{
                text-align: left;
                font-size: 4em;
            }

            .profile-info {
                display: flex;
                align-items: center;
            }

            .post p {
                padding-top: 20px;
                font-size: 2em;
            }

            .comment-title {
                margin-bottom: 1em;
            }

            .comment{
                padding-left: 3em;
            }

            .comment-section{
                padding-left: 1em;
            }
            
        </style>
        
    </head>
    <body>
    <?php include "header.php" ?>
        <div class ="container">
            <div class ="post">
                <?php if(isset($_GET['content_id'])) {
                
                $content_id = $_GET['content_id'];

                // Prepare an SQL statement to select all posts from the forum_subject table
                $sql_forum = "SELECT sub.*, ua.*
                        FROM forum_subject AS sub
                        JOIN user_account AS ua ON sub.userID = ua.userID
                        WHERE sub.content_id = $content_id";
                $result_forum = $db->query($sql_forum);
            
                if ($result_forum->num_rows > 0) {
                $row = $result_forum->fetch_assoc();
                ?>
                    <h2><?php echo $row["title"]; ?></h2>
                    <div class="date-created">
                    <?php echo $row["username"]. '  ||  '. date("M d, Y", strtotime($row["date_created"]));?>
                    </div>
                    <p><?php echo $row["fcontent"]; ?></p>
                    <div class="pic-container">
                        <img src="<?=$row["picture"]?>" alt="Post Image">
                    </div>
                <?php
            } else {
                echo "Post not found.";
            }
        } else {
            echo "Content ID not provided.";
        }?>
            </div>
            <div class="comment-section">
                <div class="comment-title">
                    <h3>Comments</h3>
                </div>
                    <div id="comments-container">
                        <?php
                            // Retrieve comments for a specific content_id
                        $sql_comments = "SELECT fc.*, ua.username
                            FROM forum_comments AS fc
                            JOIN user_account AS ua ON fc.userID = ua.userID
                            WHERE fc.content_id = $content_id";
                        $result_comments = $db->query($sql_comments);

                        // Check if there are any comments
                        if ($result_comments->num_rows > 0) {
                        // Output comments
                            while ($row_comment = $result_comments->fetch_assoc()) {
                            // Display username and comment content
                                echo "<div class='comment'>";
                                echo "<p><strong>" . $row_comment['username'] . "</strong>: " . $row_comment['comment'] . "</p>";
                                // You can display other comment details such as date_created, comment_img, etc. here
                                echo "</div>";
                            }
                        } else {
                            // No comments found
                            echo "No comments yet.";
                        }
                        ?>
                    </div>
                    <div class="comment-form">
                        <form id="comment-form" method="POST" action="forumpageredirect2.php?content_id=<?php echo $_GET['content_id']; ?>">
                            <label for="comment">Add your comment:</label>
                            <input type="text" id="comment" name="comment" placeholder="Write a comment...">
                            <div class="form-group">
                                <button type="submit" class="btn" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>
