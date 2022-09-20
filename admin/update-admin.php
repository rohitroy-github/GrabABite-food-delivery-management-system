<!-- Updating an Admin from the db -->

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
            <h3>Update Admin</h3> 

            <?php 

              $id = $_GET['id']; 

              $sql = "SELECT * FROM tbl_admin WHERE id=$id"; 

              $res = mysqli_query($conn, $sql); 

              if($res == TRUE){ 
                $count = mysqli_num_rows($res); 

                if($count == 1){ 
                  // echo "Admin Available !"
                  $row = mysqli_fetch_assoc($res); 

                  $full_name = $row['full_name']; 
                  $username = $row['username'];
                }
                else{ 
                  header('location:'.HOMEURL.'admin/manage-admin.php'); 
                }
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
                  value ="<?php echo $full_name ?>"
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
                  value ="<?php echo $username ?>"
                />
              </td>
            </tr>

            <tr>
              <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <input
                  type="submit"
                  name="submit"
                  value="Update Admin"
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

if($_POST['submit']){ 

  $id = $_POST['id']; 
  $full_name = $_POST['full_name']; 
  $username = $_POST['username']; 

  $sql = "UPDATE tbl_admin SET
  full_name='$full_name', 
  username='$username' 
  WHERE id=$id
  "; 

  $res = mysqli_query($conn, $sql);

  if($res == TRUE){ 

    $_SESSION['update'] = "Admin Updated Successfully !"; 
    header('location:'.HOMEURL.'admin/manage-admin.php'); 

  }
  else{ 

    $_SESSION['update'] = "Admin Updation Failed !"; 
    header('location:'.HOMEURL.'admin/manage-admin.php'); 

  }

}

?> 
