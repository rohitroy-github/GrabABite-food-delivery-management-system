<!-- PHP > Add New Food Category ! -->

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
        <h2 style="text-align: center">Add New Category</h2>

        <!-- Printing success message -->

        <?php
        if(isset($_SESSION['add']))
        { 
          echo $_SESSION['add'];
          // Ending session 
          unset($_SESSION['add']); 
        }
        ?>

        <!-- Form -->

        <form action="" method="POST">
          <table class="tbl-30">
            <tr>
              <td>Title :</td>
              <td>
                <input
                  type="text"
                  name="title"
                  placeholder="Category Title ?"
                />
              </td>
            </tr>

            <tr>
              <td>Featured :</td>
              <td>

                <input
                  type="radio"
                  name="featured"
                  value="Yes"
                />
                Yes 

                <input
                  type="radio"
                  name="featured"
                  value="No"
                />
                No

              </td>
            </tr>

            <tr>
              <td>Active :</td>
              <td>

                <input
                  type="radio"
                  name="active"
                  value="Yes"
                />
                Yes 

                <input
                  type="radio"
                  name="active"
                  value="No"
                />
                No

              </td>
            </tr>

            <tr>
              <td colspan="2">
                <input
                  type="submit"
                  name="submit"
                  value="Add Category"
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

  $title = $_POST['title'];

  // Redio input type 

  // Featured Option 

  if(isset($_POST['featured'])){ 

    $featured = $_POST['featured']; 

  }
  else{ 

    $featured = "No";

  }

  // Active Option

  if(isset($_POST['active'])){ 

    $active = $_POST['active']; 

  }
  else{ 

    $active = "No";

  }

  // Set SQL query

  $sql = "INSERT INTO tbl_category SET
  title = '$title', 
  featured = '$featured', 
  active = '$active'
  "; 

  // Execute query into database

  $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

  // Check whether data is inserted ? 

  if($res == TRUE){ 
    
    // Data inserted

    $_SESSION['add'] = "Category Added Successfully !"; 

    // Redirect to ManageAdmin Page
    header("location:".HOMEURL.'admin/manage-category.php');

  }
  else{ 

    // Failed

    $_SESSION['add'] = "Failed To Add New Category !";

    // Redirect to addAdmin Page again
    header("location:".HOMEURL.'admin/add-category.php'); 

  }

  // echo $sql;

}

?>
