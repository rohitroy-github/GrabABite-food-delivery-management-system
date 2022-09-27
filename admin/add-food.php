<!-- PHP To Add New Food Item -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Add New Food Item</title>
  </head>
  <body>
    <!-- Menu Section -->
    <?php include 'partials/menu.php';?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Add New Food Item</h2>
        <!-- Printing success message -->
        <?php
if (isset($_SESSION['food-image-upload-failed'])) {
    echo $_SESSION['food-image-upload-failed'];
    // Ending session
    unset($_SESSION['food-image-upload-failed']);
}

if (isset($_SESSION['add-food'])) {
    echo $_SESSION['add-food'];
    // Ending session
    unset($_SESSION['add-food']);
}
?>
        <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl-30">
            <tr>
              <td>Title :</td>
              <td>
                <input
                  type="text"
                  name="title"
                  placeholder="Enter A Title  ?"
                />
              </td>
            </tr>

            <tr>
              <td>Description :</td>
              <td>
                <textarea
                  type="text"
                  name="description"
                  placeholder="Give Description ?"
                ></textarea>
              </td>
            </tr>

            <tr>
              <td>Price :</td>
              <td>
                <input
                  type="number"
                  name="price"
                  placeholder="Enter Price  ?"
                />
              </td>
            </tr>

            <tr>
              <td>Select Image :</td>
              <td>
                <input type="file" name="image" placeholder="Food Image ?" />
              </td>
            </tr>

            <tr>
              <td>Category :</td>
              <td>
                <select name="category">
                  <?php
$sql = "SELECT * FROM tbl_category WHERE active='Yes'";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if ($count >
    0) {while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $title = $row['title'];
    ?>
<option value="<?php echo $id; ?>">
<?php echo $title; ?>
</option>
<?php
}
} else {
    ?>
                  <option value="0">No Category Found</option>
                  <?php
}
?>
</select>
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
                  value="Add Food"
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

if (isset($_POST['submit'])) {

// Store in variables

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

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

        if ($image_name != "") {
            $ext = explode(".", $image_name);

            $extension = end($ext);

            $image_name_renamed = "food-name-" . $title . "-" . rand(0000, 9999) . "." . $extension;

            echo $image_name_renamed;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/food/" . $image_name_renamed;

            $upload = move_uploaded_file($source_path, $destination_path);

            // Check Uploaded/ Not ?

            if ($upload == false) {

                // If upload failed ?

                $_SESSION['food-image-upload-failed'] = "Failed To Upload Image !";
                header("location:" . HOMEURL . 'admin/add-food.php');

                // Stop Processing

                die();

            }
        }

    } else {

        // Upload Rejected !

        $image_name = "";

    }

// Set SQL query

    $sql2 = "INSERT INTO tbl_food SET title = '$title',description = '$description',price = $price,image_name = '$image_name_renamed',category_id = $category,featured = '$featured',active = '$active'";

// Execute query into database

// $res = mysqli_query($conn, $sql) or die(mysqli_error());
    $res2 = mysqli_query($conn, $sql2);

// Check whether data is inserted ?

    if ($res2 == true) {
        // Data Insertion Successfull !

        $_SESSION['add-food'] = "Food Item Added Successfully !";

        // Redirect to ManageAdmin Page
        header("location:" . HOMEURL . 'admin/manage-food.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['add-food'] = "Failed To Add New Food Item !";

        // Redirect to addAdmin Page again
        header("location:" . HOMEURL . 'admin/add-food.php');
    }
}