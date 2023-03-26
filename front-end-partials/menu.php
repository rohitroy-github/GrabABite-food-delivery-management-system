<?php include 'constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- bootstrapStyles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
nav { 
  height: 80px;
}
.navbar-light .navbar-brand{
  color: #fc8019;
  font-size: 1.5rem;
  font-weight: 800;
}
.navbar-light .navbar-brand:hover{
  color: #fc8019;
  transition: color 0.3s ease;
}
.navbar-nav {
  margin-left: auto;
}

li{
  font-weight: 800;
  margin-right: 1rem;
}

.navbar-light .navbar-nav .nav-link{
  color: #fc8019;
  margin : 2px 5px 2px 5px;
  transition: color 0.5s ease;
}
.navbar-light .navbar-nav .nav-link:hover{
  color: white;
}

.navbar-light .navbar-nav .nav-item:hover { 
  background-color : #fc8019;
  border-radius : 5px;
  transition: color 0.5s ease;
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
    <!-- Navbar Section Starts Here -->
    <!-- <section class="navbar"> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="<?php echo HOMEURL; ?>">GRAB A BITE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="link nav-link" href="<?php echo HOMEURL; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="<?php echo HOMEURL; ?>categories.php">Categories</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="<?php echo HOMEURL; ?>foods.php">Food</a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="<?php echo HOMEURL; ?>about-us.php">About Us </a>
          </li>
          <!-- <li class="nav-item">
            <a class="link nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- </section> -->
    <!-- Navbar Section Ends Here -->
