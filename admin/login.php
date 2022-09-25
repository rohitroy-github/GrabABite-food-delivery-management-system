<!-- Login Page -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page - Food Ordering App</title>

    <link rel="stylesheet" href="../css/admin.css" />
  </head>
  <body>

    <?php
include '../config/constants.php';
?>

    <div class="login">
      <h2>Login</h2>

        <br />

      <!-- Login Form -->

      <form action="" method="POST">
        <table class="tbl-30">
          <tr>
            <td>Username :</td>
            <td>
              <input
                type="text"
                name="username"
                placeholder="Enter your username ?"
              />
            </td>
          </tr>

          <tr>
            <td>Password :</td>
            <td>
              <input
                type="text"
                name="password"
                placeholder="Enter a password ?"
              />
            </td>
          </tr>
        </table>

        <br />

        <input
          type="submit"
          name="submit"
          value="Login"
          class="btn-table"
          style="text-align: center"
        />
      </form>

      <br />

            <!-- Login Message -->


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
  </body>
</html>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $_SESSION['login'] = "Login Success !";

        // Login session check
        $_SESSION['user'] = $username;

        header("location:" . HOMEURL . 'admin/');

    } else {

        $_SESSION['login'] = "Login Failed !";
        header("location:" . HOMEURL . 'admin/login.php');

    }

}
?>
