<?php include "db_conn.php";?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Animal Profiles</title>
        <link rel="stylesheet" href="design/design.css">
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
        <div class="clearfix">
            <?php
                $sql = "SELECT * FROM animalprofiles ORDER BY petID DESC";
                $res = mysqli_query($db, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) { ?>

                    <!-- DISPLAY ANIMAL PROFILES -->
                    <a href="animal_individual_profile.php?petID=<?=$row["petID"]?>" class="alb">
                        <img src="uploads/<?=$row["image_url"]?>">
                        <h3><strong>Name:</strong><?=$row["name"]?> </h3>
                    </a>

            <?php  } }?>
        </div>
    </body>
</html>
