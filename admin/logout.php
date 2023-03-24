<!-- Logout Functionality -->

<?php

include('../config/constants.php');

// Destroy the 'user' session !

session_destroy(); 

//Redirect

header('location:'.HOMEURL.'admin/login.php'); 

?> 

<?php

$_SESSION['logout'] = "Logout Successfull !"; 

?>

