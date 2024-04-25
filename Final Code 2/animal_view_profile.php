<?php include "cfg/db_conn.php";?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Animal Profiles</title>
        <link rel="stylesheet" href="design/design.css">
    </head>
    <body>
        <!-- NAVIGATION BAR -->
        <?php include "header.php"; ?>
        
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
