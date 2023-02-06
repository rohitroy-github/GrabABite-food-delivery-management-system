<!-- Updating Food @DB -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Update Food Item</title>
  </head>
  <body>
    <!-- Menu Section -->

    <?php include 'partials/menu.php'; ?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h3>Update Food Item</h3>

<?php if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    }
} else {
    // If no data is found redirect to manage-admin page with session message

    $_SESSION['no-food-found'] = 'Selected Food Item Not Found !';
    header('location:' . HOMEURL . 'admin/manage-food.php');
} ?>
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
                  value="<?php echo $title; ?>"
                />
              </td>
            </tr>

            <tr>
              <td>Current Image :</td>
              <td>
                <!-- Old Image is displayed -->
                <?php if ($current_image != '') { ?>
    <img src="<?php echo HOMEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
    <?php } else {echo "<div class='left-alligned-message'>Image Not Uploaded !</div>";} ?>
              </td>
            </tr>

            <tr>
              <td>New Image :</td>
              <td>
                <input
                  type="file"
                  name="new_image"
                  placeholder="New Food Item Image ?"
                />
              </td>
            </tr>

            <tr>
              <td>Price :</td>
              <td>
                <input
                  type="number"
                  name="price"
                  placeholder="Enter Updated Price ?"
                  value="<?php echo $price; ?>"
                />
              </td>
            </tr>

            <tr>
              <td>Featured :</td>
              <td>
                <input <?php if ($featured == 'Yes') {
                    echo 'checked';
                } ?> type="radio" name="featured" value="Yes" />
                Yes

                <input <?php if ($featured == 'No') {
                    echo 'checked';
                } ?> type="radio" name="featured" value="No" />
                No
              </td>
            </tr>

            <tr>
              <td>Active :</td>
              <td>
                <input <?php if ($active == 'Yes') {
                    echo 'checked';
                } ?> type="radio" name="active" value="Yes" />
                Yes

                <input <?php if ($active == 'No') {
                    echo 'checked';
                } ?> type="radio" name="active" value="No" />
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

    <?php if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        if (isset($_FILES['image']['name'])) {
            //Upload Image

            // Auto-Rename our images
            $new_image = $_FILES['image']['name'];

            if ($new_image != '') {
                $ext = explode('.', $new_image);

                $extension = end($ext);

                $new_image_renamed = 'food-item-' . $title . '.' . $extension;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = '../images/category/' . $new_image_renamed;

                $upload = move_uploaded_file($source_path, $destination_path);

                // Check Uploaded/ Not ?

                if ($upload == false) {
                    // If upload failed ?

                    $_SESSION['failed-to-upload-food-image'] =
                        'Failed To Upload Image !';
                    header('location:' . HOMEURL . 'admin/manage-food.php');

                    // Stop Processing
                    die();
                }

                // Remove image from variable/ folder !

                if ($new_image != '') {
                    $remove_path = '../images/food/' . $current_image;

                    $remove_image = unlink($remove_path);

                    if ($remove_image == false) {
                        $_SESSION['failed-to-remove-food-image-file'] =
                            'Failed To Remove Current Image';
                        header('location:' . HOMEURL . 'admin/manage-food.php');

                        // Stop all further procedure !
                        die();
                    }
                }
            }
        } else {
            // Upload Rejected !
            $image_name = $current_image;
        }

        $sql2 = "UPDATE tbl_food SET
    title='$title',
    price='$price',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id=$id
    ";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            $_SESSION['update-food'] = 'Food Item Updated Successfully !';
            header('location:' . HOMEURL . 'admin/manage-food.php');
        } else {
            $_SESSION['update-food'] = 'Food Item Updation Failed !';
            header('location:' . HOMEURL . 'admin/manage-food.php');
        }
    } ?>

    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>
  </body>
</html>

