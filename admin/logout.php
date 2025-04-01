<!-- Logout Functionality -->

<?php
include '../config/constants.php';

// Destroy the 'user' session !

session_destroy();

$_SESSION['logout'] =
    '<p class="text-center">You have successfully logged out !</p>';

header('location:' . HOMEURL . 'admin/login.php');
?> 


