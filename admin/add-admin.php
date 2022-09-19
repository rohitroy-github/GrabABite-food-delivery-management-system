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

    <?php include 'partials/menu.php'; ?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Add New Admin</h2>

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

    <?php include 'partials/footer.php'; ?>
  </body>
</html>

<?php 

// Process value from from the save in database
// Check if the button is clicked ? 

if(isset($_POST['submit'])){ 

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

  // if query executed successfully > res = true else res = false 
  // die > stop further processing

  $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());

  $db_select = mysqli_select_db($conn, 'php-food-ordering-app-db') or die(mysqli_error());

  // $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

  echo $sql;

}
else{ 
  "Not Clicked !";
}

?>