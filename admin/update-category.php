<!-- Updating Category From The DB -->

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
        <h3>Update Category</h3>

<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];

    }

} else {

    // If no data is found redirect to manage-admin page with session message

    $_SESSION['no-category-found'] = "Category Not Found !";
    header('location:' . HOMEURL . 'admin/manage-category.php');

}

//Checking
// echo $id;
// echo $title;
// echo $current_image;

?>

        <form action="" method="POST" enctype="multipart/form-data">
          <!-- enctype="multipart/form-data" >>> To Add Image File In Form -->

          <table class="update-category-tbl-30">
            <tr>
              <td>Title :</td>
              <td>
                <input
                  type="text"
                  name="title"
                  placeholder="Enter New Title ?"
                  value="<?php echo $title ?>"
                />
              </td>
            </tr>

            <tr>
              <td>Current Image :</td>
              <td>
                <!-- Old Image is displayed -->
                <?php

if ($current_image != "") {

    ?>
    <img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
    <?php

} else {

    echo "<div class='left-alligned-message'>Image Not Uploaded !</div>";

}

?>
              </td>
            </tr>

            <tr>
              <td>New Image :</td>
              <td>
                <input
                  type="file"
                  name="new_image"
                  placeholder="New Category Image ?"
                />
              </td>
            </tr>

            <tr>
              <td>Featured :</td>
              <td>
                <input <?php if ($featured == "Yes") {echo "checked";}?> type="radio" name="featured" value="Yes" />
                Yes

                <input <?php if ($featured == "No") {echo "checked";}?> type="radio" name="featured" value="No" />
                No
              </td>
            </tr>

            <tr>
              <td>Active :</td>
              <td>
                <input <?php if ($active == "Yes") {echo "checked";}?> type="radio" name="active" value="Yes" />
                Yes

                <input <?php if ($active == "No") {echo "checked";}?> type="radio" name="active" value="No" />
                No
              </td>
            </tr>

            <tr>
              <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" />
                <input type="hidden" name="id" value="<?php echo $id; ?>" />

                <input
                  type="submit"
                  name="submit"
                  value="Update Category"
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

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name'])) {

        //Upload Image

        // Auto-Rename our images
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {

            $ext = explode(".", $image_name);

            $extension = end($ext);

            $image_name_renamed = "food_category_" . $title . "." . $extension;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/category/" . $image_name_renamed;

            $upload = move_uploaded_file($source_path, $destination_path);

            // Check Uploaded/ Not ?

            if ($upload == false) {
                // If upload failed ?

                $_SESSION['upload-image-failed'] = "Failed To Upload Image !";
                header("location:" . HOMEURL . 'admin/manage-category.php');

                // Stop Processing
                die();

            }

            // Remove image from variable/ folder !

            if ($current_image != "") {

                $remove_path = "../images/category/" . $current_image;

                $remove_image = unlink($remove_path);

                if ($remove_image == false) {

                    $_SESSION['remove-image-file'] = "Failed To Remove Current Image";
                    header('location:' . HOMEURL . 'admin/manage-category.php');

                    // Stop all further procedure !
                    die();
                }

            }

        }

    } else {

        // Upload Rejected !
        $image_name = $current_image;

    }

    $sql2 = "UPDATE tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id=$id
        ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {

        $_SESSION['update'] = "Category Updated Successfully !";
        header('location:' . HOMEURL . 'admin/manage-category.php');

    } else {

        $_SESSION['update'] = "Category Updation Failed !";
        header('location:' . HOMEURL . 'admin/manage-category.php');

    }
}
?>

    <!-- Footer Section -->

    <?php include 'partials/footer.php';?>
  </body>
</html>
