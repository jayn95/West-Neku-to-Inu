<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="design/admin.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
        $(document).ready(function(){
            $(".reject_btn").click(function(){
                var petID = $(this).closest("tr").find(".petID").text();

                $.ajax({
                    type: 'POST',
                    url: 'profile_script.php',
                    data: {
                        'reject': true,
                        'petID': petID
                    },
                    success: function(response) {
                        alert(response);
                    }
                });

                $(this).closest("tr").remove();
            });
        });

        // Function to handle edit button click

        function editRow() {
            // Show the form for modifying profiles
            document.getElementById("modify_profile_form").style.display = "block";
        }

        // Function to handle cancel edit
        function cancelEdit() {
        $('#profile_form').hide();
        $('#save_btn').text('Submit');
        $('#row_index').val('');
        }

        // Function to handle adding new profile
        function addNewProfile() {
        // Clear previous inputs
        $('#profile_form input[type=text], #profile_form textarea').val('');
        $('#profile_form').show();
        $('#save_btn').text('Submit');
        $('#row_index').val('');
        }

        // Function to handle saving data
        function saveData() {
            var name = document.getElementById("name").value;
            var breed = document.getElementById("breed").value;
            var description = document.getElementById("description").value;
            var profilePic = document.getElementById("profile_pic").files[0];

            // Form data object to send to PHP
            var formData = new FormData();
            formData.append("name", name);
            formData.append("breed", breed);
            formData.append("description", description);
            formData.append("profile_pic", profilePic);

            // AJAX request to send form data to PHP
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "profile_script.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Response from PHP
                    console.log(xhr.responseText);
                    // You can handle the response here, e.g., show a success message
                }
            };
            xhr.send(formData);
        }

        // Function to handle seeing posts
        function seePosts(row) {
        window.location.href = "posts.php";
        }
  </script>
  <style>
    #modify_profile_form label {
        display: block;
        margin-bottom: 5px;
        }

    #modify_profile_form input[type="text"], #modify_profile_form textarea {
        width: calc(100% - 20px);
        padding: 5px;
        margin-bottom: 10px;
    }

    #modify_profile_form input[type="file"] {
        margin-bottom: 10px;
    }
    #modify_profile_form input[type="submit"] {
        padding: 3px 10px;
        margin: 5px;
        border-radius: 20px;
        cursor: pointer;
        background-color: #fff; 
        color: #0C359E;
        }

    #modify_profile_form input[type="submit"]:hover {
        background-color: #d8e2ff;
        }
 </style>

</head>
<body>

<div class="wrapper">

    <div class="wrapper">
        <div class="top_navbar">
            <div class="logo">
                <a href="#">West Neko to Inu</a>
            </div>
            <div class="top_menu">
                <div class="right_info">
                    <div class="icon_wrap">
                        <div class="icon">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                    <div class="icon_wrap dropdown">
                      <div class="icon" id="dropdownMenu">
                          <i class="fas fa-cog"></i>
                      </div>
                      <div class="dropdown-content">
                          <a href="admin_profile.php">View Profile</a>
                          <a href="#">Log Out</a>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    <div class="main_body">

    <div class="sidebar_menu">
          <div class="inner__sidebar_menu">
              
              <ul>
                <li>
                  <a href="admin.php">
                    <span class="icon">
                      <i class="fas fa-border-all"></i></span>
                      <span class="list">Animal of the Week</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="icon"><i class="fas fa-chart-pie"></i></span>
                    <span class="list">Charts</span>
                  </a>
                </li>
                <li>
                  <a href="animal.php">
                      <span class="icon"><i class="fas fa-file-invoice"></i></span>
                      <span class="list">Animal Submissions</span>
                  </a>
                <li>
                  <a href="user.php">
                    <span class="icon"><i class="fas fa-duotone fa-users"></i></span>
                    <span class="list">User Approval</span>
                  </a>
                </li>
                <li>
                  <a href="profile.php" class="active">
                    <span class="icon"><i class="fas fa-solid fa-paw"></i></span>
                    <span class="list">Animal Profiles</span>
                  </a>
                </li>
                <li>
                  <a href="posts.php">
                    <span class="icon"><i class="fas fa-solid fa-pen"></i></span>
                    <span class="list">Content</span>
                  </a>
                </li>
              </ul>

                <div class="hamburger">
                    <div class="inner_hamburger">
                        <span class="arrow">
                            <i class="fas fa-long-arrow-alt-left"></i>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="animal_container">
            <h2>Modify Animal Profile</h2>
            <table id="profile_table">
                <thead>
                    <tr>
                      <th><h3>Animal ID</h3></th>
                      <th><h3>Name</h3></th>
                      <th><h3>Breed</h3></th>
                      <th><h3>Description</h3></th>
                      <th><h3>Profile Picture</h3></th>
                      <th><h3>Actions</h3></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include "cfg/db_conn.php";
                    $sql = "SELECT * FROM animalprofiles ORDER BY petID DESC";
                    $res = mysqli_query($db, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>

                        <div class="alb">
                            <tr>
                            <td class="petID"><?=$row["petID"]?></td>
                            <td class="breed"><?=$row["breed"]?></td>
                            <td class="name"><?=$row["name"]?> </td>
                            <td class="description"><?=$row["description"]?> </td>
                            <td><img src="../<?=$row["image_url"]?>"></td>
                            <td>
                                <button class="reject_btn">Delete</button>
                                <button class="approve_btn" onclick="editRow()">Modify</button>
                            </td>
                            </tr>
                        </div>

                <?php } }?>
                </tbody>
            </table>
            <!-- add new profile -->
            <button class="add-profile-button" onclick="addNewProfile()">Add New Profile</button>
            <form id="profile_form" style="display: none;">
                <input type="hidden" id="row_index" value="">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="breed">Breed:</label><br>
                <input type="text" id="breed" name="breed" required><br><br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
                
                <label for="profile_pic">Profile Picture:</label><br>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required><br><br>
                
                <button class="submit-button" type="button" id="save_btn" onclick="saveData()">Save</button>
                <button class="cancel-button" type="button" onclick="cancelEdit()">Cancel</button>
            </form>

            <!-- redirected to edit data -->
            <form id="modify_profile_form" style="display: none;"
                method="post"
                action="save_profile_script.php"
                enctype="multipart/form-data">
                <input type="hidden" id="row_index" value="">

                <br>
                <label for="title">Modify Animal Profile</label><br>

                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="breed">Breed:</label><br>
                <input type="text" id="breed" name="breed" required><br><br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
                
                <label for="profile_pic">Profile Picture:</label><br>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required><br><br>
                
                <input type="submit" name="submit" value="Save">
                <button class="cancel-button" type="button" onclick="cancelEdit()">Cancel</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>