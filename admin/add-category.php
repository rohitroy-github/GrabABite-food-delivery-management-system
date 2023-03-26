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
    <title>Add New Category</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Add New Category</h2>
                <br />
                <!-- Printing SUCCESSS message -->
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
                <div class="form-group">
                    <label for="username">Category Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter category title ?"
                        required />
                </div>
                <div class="form-group">
                    <label for="username">Upload Image</label>
                    <input name="image" type="file" id="image" placeholder="Upload category image ?" required />
                </div>
                <div class="form-group">
                    <label for="password">Featured ?</label>
                    <input name="featured" type="radio" id="featured" value="Yes" /> Yes

                    <input name="featured" type="radio" id="featured" value="No" /> No
                </div>
                <div class="form-group">
                    <label for="password">Active ?</label>
                    <input name="active" type="radio" id="active" value="Yes" /> Yes

                    <input name="active" type="radio" id="active" value="No" /> No
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="login">
                    Add New Category
                </button>
            </form>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php if (isset($_POST['submit'])) {
    // Store in variables

    $title = $_POST['title'];

    // Radio input type

    // Featured Option

    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = 'No';
    }

    // Active Option

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = 'No';
    }

    //Checking for image file availibility

    //Display all data of Files/ Image
    // print_r($_FILES['image']);

    if (isset($_FILES['image']['name'])) {
        //Upload Image

        // Auto-Rename our images
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = explode('.', $image_name);

            $extension = end($ext);

            $image_name_renamed = 'food_category_' . $title . '.' . $extension;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = '../images/category/' . $image_name_renamed;

            $upload = move_uploaded_file($source_path, $destination_path);

            // Check Uploaded/ Not ?

            if ($upload == false) {
                // If upload failed ?

                $_SESSION['upload-image-failed'] = 'Failed To Upload Image !';
                header('location:' . HOMEURL . 'admin/add-category.php');

                // Stop Processing
                die();
            }
        }
    } else {
        // Upload Rejected !
        $image_name = '';
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

        $_SESSION['add-category'] = 'Category Added Successfully !';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-category.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['add-category'] = 'Failed To Add New Category !';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/add-category.php');
    }
}
?>
