<!-- Main SQL Database connection file -->
<?php

// Starting session

session_start();

// Defining constant values using define()

define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE_NAME', 'php-food-ordering-app-db');

define('HOMEURL', 'http://localhost/rohit-projects/php-projects/php-food-ordering-app/');

// if query executed successfully > res = true else res = false
// die > stop further processing

($conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD)) or die(mysqli_error());

($db_select = mysqli_select_db($conn, DATABASE_NAME)) or die(mysqli_error());

?>