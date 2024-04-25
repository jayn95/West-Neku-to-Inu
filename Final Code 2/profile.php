<?php include "profile_script.php"; ?>
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
      $(".hamburger").click(function(){
        $(".wrapper").toggleClass("active")
      })
    });

    // Function to handle edit button click
    function editRow(row) {
      var cells = $(row).closest('tr').find('td');
      var name = cells.eq(0).text().trim();
      var breed = cells.eq(1).text().trim();
      var description = cells.eq(2).text().trim();

      // Populate input fields with existing data
      $('#name').val(name);
      $('#breed').val(breed);
      $('#description').val(description);
      $('#profile_form').show();
      $('#save_btn').text('Save');
      $('#row_index').val($(row).closest('tr').index());
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
      var rowIndex = $('#row_index').val();
      var name = $('#name').val();
      var breed = $('#breed').val();
      var description = $('#description').val();
      var profilePic = $('#profile_pic').prop('files')[0];

      if (profilePic) {
        var reader = new FileReader();
        reader.onload = function(event) {
          var profilePicURL = event.target.result;
          if (rowIndex !== '') {
            var cells = $('#profile_table tbody tr').eq(parseInt(rowIndex)).find('td');
            cells.eq(0).text(name);
            cells.eq(1).text(breed);
            cells.eq(2).text(description);
            cells.eq(3).html('<img src="' + profilePicURL + '" alt="' + name + '">');
          } else {
            var newRow = '<tr>' +
              '<td>' + name + '</td>' +
              '<td>' + breed + '</td>' +
              '<td>' + description + '</td>' +
              '<td><img src="' + profilePicURL + '" alt="' + name + '"></td>' +
              '<td><button onclick="deleteRow(this)" class="delete-button">Delete</button>' +
              '<button onclick="editRow(this)" class="modify-button">Modify</button></td>' +
              '</tr>';
            $('#profile_table tbody').append(newRow);
          }
        };
        reader.readAsDataURL(profilePic);
      }

      $('#profile_form').hide();
      $('#name').val('');
      $('#breed').val('');
      $('#description').val('');
      $('#row_index').val('');
      $('#save_btn').text('Submit');
    }

    // Function to handle deleting a row
    function deleteRow(row) {
      $(row).closest('tr').remove();
    }

    // Function to handle seeing posts
    function seePosts(row) {
      window.location.href = "posts.php";
    }
  </script>
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
                      <a href="adminprofile.html">View Profile</a>
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
                  <a href="admin.html">
                    <span class="icon">
                      <i class="fas fa-border-all"></i></span>
                    <span class="list">Main</span>
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
                  <a href="user.html">
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
                  <a href="posts.html">
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
                                <td><img src="<?=$row["image_url"]?>"></td>
                                <td>
                                    <button class="delete-button">Delete</button>
                                    <button class="modify-button">Modify</button>
                                </td>
                                </tr>
                            </div>
                        <?php  } }?>
                </tbody>
            </table>
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
        </div>
    </div>
</div>

</body>
</html>
