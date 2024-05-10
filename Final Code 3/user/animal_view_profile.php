<?php include "../cfg/db_conn.php";?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Animal Profiles</title>
        <!-- <link rel="stylesheet" href="design/design.css"> -->
        <style>
            /* Gallery */
            .alb {
                margin: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
                float: left;
                width: calc(33.33% - 40px); /* Adjust the width of each item */
                box-sizing: border-box;
            }

            .alb img {
                display: block;
                width: 100%;
                height: 100px; /* Set a fixed height */
                object-fit: cover; /* Maintain aspect ratio */
                border-radius: 5px;
                margin-bottom: 10px;
            }

            .alb h3 {
                margin: 0;
                font-size: 18px;
            }

            .alb p {
                margin: 0;
                margin-bottom: 10px;
                font-size: 14px;
            }

            .clearfix::after {
                content: "";
                display: table;
                clear: both;
            }
            h2 {
                font-size: 24px;
                color: #333;
                margin-bottom: 20px;
            }
            </style>
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <?php include "header.php"; ?>
        
        <h2>Pet Profiles</h2>
        <div class="clearfix">
            <?php
                $sql = "SELECT * FROM animalprofiles ORDER BY petID DESC";
                $res = mysqli_query($db, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) { ?>

                    <!-- DISPLAY ANIMAL PROFILES -->
                    <a href="animal_individual_profile.php?petID=<?=$row["petID"]?>" class="alb">
                        <img src="<?=$row["image_url"]?>">
                        <h3><strong>Name:</strong><?=$row["name"]?> </h3>
                    </a>

            <?php  } }?>
        </div>
    </body>
</html>
