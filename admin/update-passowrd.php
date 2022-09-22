<!-- Updating Admin Passowrd -->

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
        <h3>Update Admin Password</h3>

        <?php 

            if(isset($_GET['id']))
            { 
                $id = $_GET['id']; 
            }

        ?>

        <form action="" method="POST">
          <table class="tbl-30">
            <tr>
              <td>Old Password :</td>
              <td>
                <input
                  type="text"
                  name="old-password"
                  placeholder="Old Password ?"
                />
              </td>
            </tr>

            <tr>
              <td>New Password :</td>
              <td>
                <input
                  type="text"
                  name="new-password"
                  placeholder="Enter New Password ?"
                />
              </td>
            </tr>

            <tr>
              <td>Confirm Password :</td>
              <td>
                <input
                  type="text"
                  name="confirm-password"
                  placeholder="Re-Type New Password ?"
                />
              </td>
            </tr>

            <tr>
              <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />

                <input
                  type="submit"
                  name="submit"
                  value="Update Password"
                  class="btn-table"
                  style="text-align: center"
                />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <?php

    if(isset($_POST['submit'])){ 

      $id = $_POST['id']; 
      $new_password = md5($_POST['new-password']); 
      $old_password = md5($_POST['old-password']); 
      $confirm_password = md5($_POST['confirm-password']); 

      $sql1 = "SELECT * FROM tbl_admin WHERE id=$id AND password='$old_password'"; 

      $res1 = mysqli_query($conn, $sql1); 

      if($res1 == TRUE)
      { 

        // Check data availibility
        $count = mysqli_num_rows($res1); 

        if($count == 1){ 

          if($new_password = $confirm_password){ 

            $sql2="UPDATE tbl_admin SET 
            password='$new_password'
            WHERE id=$id"; 

            $res2 = mysqli_query($conn, $sql2); 

            if($res2 == TRUE){ 

              $_SESSION['update-password'] = 'Password Updated Successfully !'; 
              header('location:'.HOMEURL.'admin/manage-admin.php'); 

            }
            else{ 

              $_SESSION['update-password'] = 'Password Updation Failed !'; 
              header('location:'.HOMEURL.'admin/manage-admin.php'); 

            }

          }
          else { 

            $_SESSION['password-not-match'] = 'Password Did Not Match !'; 
            header('location:'.HOMEURL.'admin/manage-admin.php'); 

          }

        }
        else{

          $_SESSION['user-not-found'] = 'User Not Found !'; 
          header('location:'.HOMEURL.'admin/manage-admin.php'); 

        }
      }
    }
    ?>

    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>
  </body>
</html>
