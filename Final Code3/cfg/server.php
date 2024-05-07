<?php
// session_start();

// initializing variables 
$username = "";
$errors = array(); 

// connect to the database
include "db_conn.php";

// REGISTER USER
if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }


  $user_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result); //fetches data
  
  if ($user) { // if user exists
    if ($user['username'] === $username) { //username must be unique
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, password)
  			  VALUES('$username', '$password')"; //make another query to insert a new value
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username; // creates a session
  	$_SESSION['success'] = "You are now logged in"; 
  	header('location: index.php'); // redirected to the index
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM adminaccount WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query); //db is database
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: src/animal.html');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>