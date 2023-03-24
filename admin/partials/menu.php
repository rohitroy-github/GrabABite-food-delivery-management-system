<?php
include '../config/constants.php';
include 'login-check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap");

    body {
      font-family: "Montserrat", sans-serif;
      height: 100vh;
      width: 100vw;
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    .navbar {
      height : 10%;
    }

    .navbar-light {
      background-color: #f5f5f5;
    }

    .navbar-light .navbar-brand {
      color: #fc8019;
      font-size: 1.5rem;
      font-weight: 800;
    }

    .navbar-light .navbar-brand:hover {
      color: #fc8019;
    }

    .navbar-nav {
      margin-left: auto;
    }

    li {
      font-weight: 800;
      margin-right: 1rem;
    }

    .navbar-light .navbar-nav .nav-link {
      color: #fc8019;
      margin: 2px 5px 2px 5px;
    }

    .navbar-light .navbar-nav .nav-link:hover {
      color: white;
    }

    .navbar-light .navbar-nav .nav-item:hover {
      background-color: #fc8019;
      border-radius: 5px;
    }

    @media (max-width: 767px) {
      .navbar-nav {
        margin-top: 20px;
      }

      .nav-link {
        margin: 0 0 1rem;
      }

      .navbar-collapse {
        margin-top: 10px;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">Admin's Panel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="link nav-link" href="index.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="manage-admin.php">Admins</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="manage-category.php">Categories</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="manage-food.php">Dishes</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="manage-orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>