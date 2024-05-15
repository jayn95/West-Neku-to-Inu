<?php include "../cfg/db_conn.php";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Animal Profiles</title>
        <link rel="stylesheet" href="../design/profiles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include "header.php"; ?>
        
        <h2>Pet Profiles</h2>
        <div class="profile-container">
            <?php
                $sql = "SELECT * FROM animalprofiles ORDER BY petID DESC";
                $res = mysqli_query($db, $sql);

                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) { ?>

                    <!-- DISPLAY ANIMAL PROFILES -->
                    <a href="animal_individual_profile.php?petID=<?= htmlspecialchars($row['petID']) ?>" class="profile-card">
                        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <h2><?= htmlspecialchars($row['name']) ?></h2>
                        <h3><?= htmlspecialchars($row['breed']) ?></h3>
                    </a>

            <?php  } 
                } else {
                    echo "<p>No profiles found.</p>";
                }
            ?>
        </div>
    </body>
</html>
