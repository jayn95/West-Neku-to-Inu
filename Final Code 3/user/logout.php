<?php
session_start();
session_unset();
session_destroy();
header("location:animal_view_profile.php")
?>