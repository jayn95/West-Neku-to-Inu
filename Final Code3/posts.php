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
      // Function to handle navigation clicks
      $(".navigation ul li a").click(function(e){
        e.preventDefault();
        $(".navigation ul li a").removeClass("active"); // Remove active class from all navigation links
        $(this).addClass("active"); // Add active class to the clicked navigation link
        $(".post_container").hide(); // Hide all post containers
        var userId = $(this).attr("id");
        $(".post_container." + userId).show(); // Show posts for the selected user
      });

      $(".hamburger").click(function(){
        $(".wrapper").toggleClass("active")
      });

      // Form submission
    //   $("#postForm").submit(function(e) {
    //     e.preventDefault();
    //     var caption = $("#caption").val();
    //     var photos = $("#photo")[0].files;
    //     var userId = $(".navigation ul li a.active").attr("id"); // Get active user
    //     var post = '<div class="post ' + userId + '"><h3>' + caption + '</h3>';
    //     for (var i = 0; i < photos.length; i++) {
    //       post += '<img src="' + URL.createObjectURL(photos[i]) + '" alt="' + caption + '">';
    //     }
    //     post += '<div class="buttons"><button class="delete-btn">Delete</button><button class="modify-btn">Modify</button><span class="react-count">0</span> hearts</div></div>';
  
    //     $(".post_container." + userId).append(post);
  
    //     $("#caption").val('');
    //     $("#photo").val('');
    //   });

        $("#postForm").submit(function(e){
            e.preventDefault();
            var caption = $("#caption").val();
            var photos = $("#photo")[0].files;
            var petID = $(".navigation ul li a.active").attr("petID"); // Get active user

            $.ajax({
                type: 'POST',
                url: 'post_script.php',
                data: {
                    'submit': true,
                    'petID': petID,
                    'caption': caption,
                    'photos': photos
                },
                success: function(response) {
                    alert(response);
                }
            });

            $(this).parent().parent().remove();
        });
  
      // Delete post
      $(document).on("click", ".delete-btn", function() {
        $(this).closest(".post").remove();
      });

      // Modify button click
      $(document).on("click", ".modify-btn", function() {
        var post = $(this).closest(".post");
        var caption = post.find("h3").text().trim();
        var images = post.find("img").clone(); // Clone images
        $("#modify_caption").val(caption);
        $(".modify_form_container").addClass("active");
        $(".modify_form_container").data("post", post); // Store post reference
        $(".modify_form_container").data("images", images); // Store cloned images
        $(".post_container").hide(); // Hide post container while modifying
      });
  
      // Cancel modify
      $(document).on("click", ".cancel-modify", function() {
        $(".modify_form_container").removeClass("active");
        $(".post_container").show(); // Show post container
      });
  
      // Modify Form submission
      $("#modifyForm").submit(function(e) {
        e.preventDefault();
        var newCaption = $("#modify_caption").val();
        var newPhotos = $("#modify_photo")[0].files; // Allow multiple photos for modification
  
        // Retrieve stored post reference and cloned images
        var post = $(".modify_form_container").data("post");
        var images = $(".modify_form_container").data("images").clone(); // Clone images
  
        // Update caption
        post.find("h3").text(newCaption);
  
        // Update photos if new ones are selected
        if (newPhotos.length > 0) {
          post.find("img").remove(); // Remove existing images
          for (var i = 0; i < newPhotos.length; i++) {
            var imageUrl = URL.createObjectURL(newPhotos[i]);
            var image = '<img src="' + imageUrl + '" alt="' + newCaption + '">';
            post.append(image); // Append new images
          }
        }
  
        // Hide modify form
        $(".modify_form_container").removeClass("active");
        $(".post_container").show(); // Show post container
      });
  
      // Function to update reaction count
      function updateReactionCount(postId, count) {
        $("#" + postId).find(".react-count").text(count);
      }
  
      // Simulate reaction count update (replace with actual backend integration)
      function simulateReactionUpdate() {
        // This function should be replaced with actual backend integration to fetch reaction counts for each post
        // Here, I'm simulating a random update for demonstration purposes
        $(".post").each(function() {
          var postId = $(this).attr("id");
          var currentCount = parseInt($(this).find(".react-count").text());
          var newCount = currentCount + Math.floor(Math.random() * 5); // Simulate random increase
          updateReactionCount(postId, newCount);
        });
      }
  
      // Simulate reaction count update every 5 seconds
      setInterval(simulateReactionUpdate, 5000);
    });
  </script>  
</head>
<body>

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
                  <div class="icon_wrap">
                      <div class="icon">
                          <i class="fas fa-cog"></i>
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
                    <a href="user.php">
                      <span class="icon"><i class="fas fa-duotone fa-users"></i></span>
                      <span class="list">User Approval</span>
                    </a>
                  </li>
                  <li>
                    <a href="profile.php">
                      <span class="icon"><i class="fas fa-solid fa-paw"></i></span>
                      <span class="list">Animal Profiles</span>
                    </a>
                  </li>
                  <li>
                    <a href="posts.php" class="active">
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
  
          <div class="container">
              <div class="navigation" style="text-align: right;">
                  <ul>
                      <li><a id="user1" class="active" href="#">User 1</a></li>
                      <li><a id="user2" href="#">User 2</a></li>
                      <li><a id="user3" href="#">User 3</a></li>
                  </ul>
              </div>
              <div class="post_form">
                  <h2>Create a New Post</h2>
                  <form id="postForm">
                      <div class="form-group">
                          <label for="caption"><h3>Caption:</h3></label>
                          <input type="text" id="caption" name="caption" required>
                      </div>
                      <div class="form-group">
                          <label for="photo"><h3>Upload Photo:</h3></label>
                          <input type="text" id="photo" name="photo" accept="image/*" multiple>
                      </div>
                      <button type="submit">Post</button>
                  </form>
              </div>
              <div class="post_container user1">
                  <!-- User 1's posts will be displayed here -->
              </div>
              <div class="post_container user2">
                  <!-- User 2's posts will be displayed here -->
              </div>
              <div class="post_container user3">
                  <!-- User 3's posts will be displayed here -->
              </div>
              <div class="modify_form_container">
                  <h2>Modify Post</h2>
                  <form id="modifyForm">
                      <div class="form-group">
                          <label for="modify_caption">Modify Caption:</label>
                          <input type="text" id="modify_caption" name="modify_caption" required>
                      </div>
                      <div class="form-group">
                          <label for="modify_photo">Replace Photo:</label>
                          <input type="file" id="modify_photo" name="modify_photo" accept="image/*" multiple>
                      </div>
                      <button type="submit">Save Changes</button>
                      <button type="button" class="cancel-modify">Cancel</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  
</body>
</html>
