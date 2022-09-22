<!-- Manage Admin Panel  -->

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
        <h2 style="text-align: center">Admin Panel</h2>

        <br />

        <!-- Button to add new admin -->

        <a href="add-admin.php" class="btn-new-admin">Add New Admin</a>

        <br /><br /><br />

        <!-- Printing success message -->
        <?php

          if(isset($_SESSION['add']))
          { 
            echo $_SESSION['add'];
            // Ending session 
            unset($_SESSION['add']); 
          }

          if(isset($_SESSION['delete']))
          { 
            echo $_SESSION['delete'];
            // Ending session 
            unset($_SESSION['delete']); 
          }

          if(isset($_SESSION['update']))
          { 
            echo $_SESSION['update'];
            // Ending session 
            unset($_SESSION['update']); 
          }

          if(isset($_SESSION['update-password']))
          { 
            echo $_SESSION['update-password'];
            // Ending session 
            unset($_SESSION['update-password']); 
          }

          if(isset($_SESSION['user-not-found']))
          { 
            echo $_SESSION['user-not-found'];
            // Ending session 
            unset($_SESSION['user-not-found']); 
          }

          if(isset($_SESSION['password-not-match']))
          { 
            echo $_SESSION['password-not-match'];
            // Ending session 
            unset($_SESSION['password-not-match']); 
          }

        ?>

        <br />

        <table class="tbl-full">
          <tr>
            <th>Serial Number</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>

          <?php
          $sql = "SELECT * FROM tbl_admin"; 

          $res = mysqli_query($conn, $sql); 

          if($res == TRUE){ 
            
            // Count rows for checking data availibility
            $count = mysqli_num_rows($res); 

            $sn = 1; 

            if($count > 0){
               while($rows = mysqli_fetch_assoc($res)){ 
                //Run as long as data is available 
          $id = $rows['id']; $full_name = $rows['full_name'];
          $username = $rows['username']; ?>

          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $full_name; ?></td>
            <td><?php echo $username; ?></td>
            <td>
              <a href="<?php echo HOMEURL; ?>admin/update-passowrd.php?id=<?php echo $id; ?>" class="btn-table">Change Password</a>

              <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-table">Update Admin</a>

              <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-table">Delete Admin</a>
            </td>
          </tr>

          <?php
              }
            }
          }
          ?>
        </table>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>
  </body>
</html>
