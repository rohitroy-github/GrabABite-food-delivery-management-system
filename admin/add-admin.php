<!-- PHP to add new admin -->

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

    <?php include 'partials/menu.php';?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Add New Admin</h2>

        <!-- Printing SUCCESSS message -->
        <?php
if (isset($_SESSION['add'])) {
    echo $_SESSION['add'];
    // Ending session
    unset($_SESSION['add']);
}
?>

        <form action="" method="POST">
          <table class="tbl-30">
            <tr>
              <td>Full Name :</td>
              <td>
                <input
                  type="text"
                  name="full_name"
                  placeholder="Enter your full name ?"
                />
              </td>
            </tr>

            <tr>
              <td>Username :</td>
              <td>
                <input
                  type="text"
                  name="username"
                  placeholder="Enter a username ?"
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

            <tr>
              <td colspan="2">
                <input
                  type="submit"
                  name="submit"
                  value="Add New Admin"
                  class="btn-table"
                  style="text-align: center"
                />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php';?>
  </body>
</html>

<?php

// Process value from from the save in database
// Check if the button is clicked ?

if (isset($_POST['submit'])) {

    // Store in variables

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // Password encryption using md5
    $password = md5($_POST['password']);

    // Set SQL query

    $sql = "INSERT INTO tbl_admin SET
  full_name = '$full_name',
  username = '$username',
  password = '$password'
  ";

    // Execute query into database

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Check whether data is inserted ?

    if ($res == true) {

        // Data inserted

        $_SESSION['add'] = "Admin added successfully !";

        // Redirect to ManageAdmin Page
        header("location:" . HOMEURL . 'admin/manage-admin.php');

    } else {

        // Failed

        $_SESSION['add'] = "Failed to add admin !";

        // Redirect to addAdmin Page again
        header("location:" . HOMEURL . 'admin/add-admin.php');

    }

    // echo $sql;

}

?>
