<!-- Login Check Functionality -->

<?php

  // Authorization Check

  if(!isset($_SESSION['user'])){ 

    // User not logged in ! 
    $_SESSION['no-login-message'] = "Please Login To Access Admin Panel !"; 

    header('location:'.HOMEURL.'admin/login.php'); 
    
  }
?>