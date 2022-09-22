<?php

  // Initial login check !
  
  // Adding DB connection code in menu to get applied in all the pages simultaneously
  include('../config/constants.php');

  include('login-check.php'); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Home Page</title>
  </head>
  <body>

    <!-- Menu Section -->
    <div class="menu">
      <div class="wrapper">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="manage-admin.php">Admin Panel</a></li>
          <li><a href="manage-category.php">Categories</a></li>
          <li><a href="manage-food.php">Food</a></li>
          <li><a href="manage-orders.php">Orders</a></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </body>
</html>
