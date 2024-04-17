<?php
include "db_conn.php";

// Check if petID is provided via POST
if(isset($_POST['petID'])) {
    // Sanitize the input
    $petID = mysqli_real_escape_string($db, $_POST['petID']);
    
    // Check if user already reacted
    $userID = 1; // Replace this with actual user ID (for example, from session)
    $checkReactionQuery = "SELECT * FROM reactions WHERE petID = '$petID' AND userID = '$userID'";
    $checkReactionResult = mysqli_query($db, $checkReactionQuery);
    if(mysqli_num_rows($checkReactionResult) > 0) {
        // User already reacted, remove reaction
        $removeReactionQuery = "DELETE FROM reactions WHERE petID = '$petID' AND userID = '$userID'";
        $removeReactionResult = mysqli_query($db, $removeReactionQuery);
    } else {
        // User has not reacted yet, add reaction
        $addReactionQuery = "INSERT INTO reactions (petID, userID) VALUES ('$petID', '$userID')";
        $addReactionResult = mysqli_query($db, $addReactionQuery);
    }
    
    // Count total reactions for the petID
    $countReactionsQuery = "SELECT COUNT(*) AS likes FROM reactions WHERE petID = '$petID'";
    $countReactionsResult = mysqli_query($db, $countReactionsQuery);
    $row = mysqli_fetch_assoc($countReactionsResult);
    $likes = $row['likes'];
    
    // Send response
    $response = array(
        'success' => true,
        'likes' => $likes
    );
    echo json_encode($response);
} else {
    // petID is not provided via POST
    $response = array(
        'success' => false,
        'message' => 'petID is not provided'
    );
    echo json_encode($response);
}
?>
