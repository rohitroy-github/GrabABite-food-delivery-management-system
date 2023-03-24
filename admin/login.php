<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="../css/admin.css"
    />    
    <title>Login Page</title>
  </head>
  <body>
    <?php include '../config/constants.php'; ?>

    <div class="container">
      <div class="col-md-6 col-lg-6">
        <form class="login-form" action="" method="POST">
          <h2 class="text-center">Admin Panel Login</h2>
          <br/>
          <div class="form-group">
            <label for="username">Username</label>
            <input
              name="username"
              type="text"
              class="form-control"
              id="username"
              placeholder="Enter username"
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              name="password"
              type="password"
              class="form-control"
              id="password"
              placeholder="Enter password"
            />
          </div>
          <button
            name="submit"
            type="submit"
            class="btn btn-primaryColor"
            value="login"
          >
          Login
          </button>
        </form>
        <br />
        <!-- loginMessages -->
        <?php
        if (isset($_SESSION['logout'])) {
            echo $_SESSION['logout'];
            unset($_SESSION['logout']);
        }

        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
      </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  </body>
</html>

<?php if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = 'Login Success !';

        // Login session check
        $_SESSION['user'] = $username;

        header('location:' . HOMEURL . 'admin/');
    } else {
        $_SESSION['login'] = 'Login Failed !';
        header('location:' . HOMEURL . 'admin/login.php');
    }
}
?>
