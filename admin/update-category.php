<?php
include '../config/constants.php';
include './partials/login-check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <title>Update Category</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <?php if (isset($_GET['id'])) {
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
                } else {
                    // If no data is found redirect to manage-admin page with session message
                    $_SESSION['no-category-found'] =
                        'Selected category does not exist !';
                    header('location:' . HOMEURL . 'admin/manage-category.php');
                }
            } else {
                header('location:' . HOMEURL . 'admin/manage-category.php');
            } ?>
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Update Category</h2>
                <br />
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter new title ?"
                        value="<?php echo $title; ?>" />
                </div>
                <div class="form-group">
                    <label for="image">Current Image</label>
                    <?php if ($current_image != '') { ?>
                    <img src="<?php echo HOMEURL; ?>images/category/<?php echo $current_image; ?>" width="100px"
                        height="auto" alt="Current Image">
                    <?php } else {echo '<p>Image not uploaded !</p>';} ?>
                </div>
                <div class="form-group">
                    <label for="image">New Image</label>
                    <input name="image" type="file" id="image" placeholder="Upload new category image ?" />
                </div>
                <div class="form-group">
                    <label for="password">Featured ?</label>
                    <input <?php if ($featured == 'Yes') {
                        echo 'checked';
                    } ?> name="featured" type="radio"
                    id="featured" value="Yes" /> Yes

                    <input <?php if ($featured == 'No') {
                        echo 'checked';
                    } ?> name="featured" type="radio"
                    id="featured" value="No" /> No
                </div>
                <div class="form-group">
                    <label for="password">Active ?</label>
                    <input <?php if ($active == 'Yes') {
                        echo 'checked';
                    } ?> name="active" type="radio" id="active"
                    value="Yes" /> Yes

                    <input <?php if ($active == 'No') {
                        echo 'checked';
                    } ?> name="active" type="radio" id="active"
                    value="No" /> No
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="update-admin">
                    Update Category
                </button>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            </form>
            <?php if (isset($_POST['submit'])) {
                // Store in variables
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != '') {
                        $ext = explode('.', $image_name);

                        $extension = end($ext);

                        $image_name =
                            'food_category_' . $title . '.' . $extension;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = '../images/category/' . $image_name;

                        $upload = move_uploaded_file(
                            $source_path,
                            $destination_path
                        );
                        // uploaded?
                        if ($upload == false) {
                            // failed
                            $_SESSION['upload-image-failed'] =
                                '<p class="text-center">Failed to upload image !</p>';
                            header(
                                'location:' .
                                    HOMEURL .
                                    'admin/manage-category.php'
                            );
                            die();
                        }
                        // removeCurrentImage
                        if ($current_image != '') {
                            $removePath =
                                '../images/category/' . $current_image;
                            $remove = unlink($removePath);
                            // removed?
                            if ($remove == false) {
                                $_SESSION['failed-remove'] =
                                    '<p class="text-center">Failed to remove current image !</p>';
                                header(
                                    'location:' .
                                        HOMEURL .
                                        'admin/manage-category.php'
                                );
                                die();
                            }
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                // Set SQL query
                $sql_update = "UPDATE tbl_category SET
              title = '$title',
              image_name = '$image_name',
              featured = '$featured',
              active = '$active'
              WHERE id=$id
              ";

                $res_update = mysqli_query($conn, $sql_update);

                // Check whether data is inserted ?

                if ($res_update == true) {
                    // Data Insertion Successfull !
                    $_SESSION['add-category'] =
                        '<p class="text-center">Category updated successfully !</p>';
                    // Redirect to ManageAdmin Page
                    header('location:' . HOMEURL . 'admin/manage-category.php');
                } else {
                    // Data Insertion Failed !
                    $_SESSION['add-category'] =
                        '<p class="text-center">Failed to update category !</p>';
                    // Redirect to addAdmin Page again
                    header('location:' . HOMEURL . 'admin/manage-category.php');
                }
            } ?>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>