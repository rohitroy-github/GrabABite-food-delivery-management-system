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
    <?php include 'partials/menu.php';?>
    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Add New Category</h2>

        <!-- Printing success message -->
        <?php
if (isset($_SESSION['add-category'])) {
    echo $_SESSION['add-category'];
    // Ending session
    unset($_SESSION['add-category']);
}

if (isset($_SESSION['upload-image-failed'])) {
    echo $_SESSION['upload-image-failed'];
    // Ending session
    unset($_SESSION['upload-image-failed']);
}
?>
        <!-- Form -->

        <form action="" method="POST" enctype="multipart/form-data">
          <!-- enctype="multipart/form-data" >>> To Add Image File In Form -->

          <table class="add-category-tbl-30">
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
              <td>Select Image :</td>
              <td>
                <input
                  type="file"
                  name="image"
                  placeholder="Category Image ?"
                />
              </td>
            </tr>

            <tr>
              <td>Featured :</td>
              <td>
                <input type="radio" name="featured" value="Yes" />
                Yes

                <input type="radio" name="featured" value="No" />
                No
              </td>
            </tr>

            <tr>
              <td>Active :</td>
              <td>
                <input type="radio" name="active" value="Yes" />
                Yes

                <input type="radio" name="active" value="No" />
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
    <?php include 'partials/footer.php';?>
  </body>
</html>
<?php
// Check if the button is clicked ?
if (isset($_POST['submit'])) {

    // Store in variables

    $title = $_POST['title'];

    // Radio input type

    // Featured Option

    if (isset($_POST['featured'])) {

        $featured = $_POST['featured'];

    } else {

        $featured = "No";

    }

    // Active Option

    if (isset($_POST['active'])) {

        $active = $_POST['active'];

    } else {

        $active = "No";

    }

    //Checking for image file availibility

    //Display all data of Files/ Image
    // print_r($_FILES['image']);

    if (isset($_FILES['image']['name'])) {

        //Upload Image

        // Auto-Rename our images
        $image_name = $_FILES['image']['name'];

        $ext = explode(".", $image_name);

        $extension = end($ext);

        $image_name_renamed = "food_category_" . $title . "." . $extension;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name_renamed;

        $upload = move_uploaded_file($source_path, $destination_path);

        // Check Uploaded/ Not ?

        if ($upload == false) {

            $_SESSION['upload-image-failed'] = "Failed To Upload Image !";
            header("location:" . HOMEURL . 'admin/add-category.php');

            // Stop Processing
            die();

        }
    } else {

        // Upload Rejected !
        $image_name = "";

    }

    // Set SQL query

    $sql = "INSERT INTO tbl_category SET
  title = '$title',
  image_name = '$image_name_renamed',
  featured = '$featured',
  active = '$active'
  ";

    // Execute query into database

    // $res = mysqli_query($conn, $sql) or die(mysqli_error());
    $res = mysqli_query($conn, $sql);

    // Check whether data is inserted ?

    if ($res == true) {
        // Data Insertion Successfull !

        $_SESSION['add-category'] = "Category Added Successfully !";

        // Redirect to ManageAdmin Page
        header("location:" . HOMEURL . 'admin/manage-category.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['add-category'] = "Failed To Add New Category !";

        // Redirect to addAdmin Page again
        header("location:" . HOMEURL . 'admin/add-category.php');
    }
}
?>