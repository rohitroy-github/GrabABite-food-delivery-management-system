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
    <title>Add New Dish</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <form class="login-form" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center">Add New Dish</h2>
                <br />
                <!-- Printing SUCCESSS message -->
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
                <div class="form-group">
                    <label for="title">Dish Title</label>
                    <input name="title" type="text" class="form-control" id="title"
                        placeholder="Enter the dish's name ?" required />
                </div>
                <div class="form-group">
                    <label for="description">Dish Description</label>
                    <input name="description" type="text" class="form-control" id="description"
                        placeholder="Enter a description ?" required />
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="number" id="price" class="form-control" placeholder="What's the price ?"
                        required />
                </div>
                <div class="form-group">
                    <label for="price">Category</label>
                    <select name="category">
                        <?php
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {

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
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input name="image" type="file" id="image" placeholder="Upload dish image ?" required />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="add-dish">
                    Add New Dish
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
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

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

            $image_name_renamed =
                'food-name-' .
                $title .
                '-' .
                rand(0000, 9999) .
                '.' .
                $extension;

            echo $image_name_renamed;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = '../images/food/' . $image_name_renamed;

            $upload = move_uploaded_file($source_path, $destination_path);

            // Check Uploaded/ Not ?

            if ($upload == false) {
                // If upload failed ?

                $_SESSION['food-image-upload-failed'] =
                    'Failed To Upload Image !';
                header('location:' . HOMEURL . 'admin/add-food.php');

                // Stop Processing

                die();
            }
        }
    } else {
        // Upload Rejected !

        $image_name = '';
    }

    // Set SQL query

    $sql2 = "INSERT INTO tbl_food SET title = '$title',description = '$description',price = $price,image_name = '$image_name_renamed',category_id = $category,featured = '$featured',active = '$active'";

    // Execute query into database

    // $res = mysqli_query($conn, $sql) or die(mysqli_error());
    $res2 = mysqli_query($conn, $sql2);

    // Check whether data is inserted ?

    if ($res2 == true) {
        // Data Insertion Successfull !

        $_SESSION['add-food'] = 'Food Item Added Successfully !';

        // Redirect to ManageAdmin Page
        header('location:' . HOMEURL . 'admin/manage-food.php');
    } else {
        // Data Insertion Failed !

        $_SESSION['add-food'] = 'Failed To Add New Food Item !';

        // Redirect to addAdmin Page again
        header('location:' . HOMEURL . 'admin/add-food.php');
    }
}
