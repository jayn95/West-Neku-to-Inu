<?php
session_start();
session_unset();
session_destroy();
header("location:temporary_post.php")
?>