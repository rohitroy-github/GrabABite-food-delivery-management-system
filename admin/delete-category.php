<!-- Deleting A Category from the db -->

<?php

include '../config/constants.php';

if (isset($_GET['id']) and isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image file is available first ?

    if ($image_name != "") {

        // Remove image from variable/ folder !
        $path = "../images/category/" . $image_name;

        $remove_image = unlink($path);

        if ($remove_image == false) {

            $_SESSION['remove-image-file'] = "Failed To Delete Image";
            header('location:' . HOMEURL . 'admin/manage-category.php');

            // Stop all further procedure !
            die();
        } else {

            // Delete from the database
            $sql = "DELETE FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {

                $_SESSION['delete'] = "Category Deleted Successfully !";

                //Redirect
                header('location:' . HOMEURL . 'admin/manage-category.php');
            } else {

                $_SESSION['delete'] = "Failed To Delete Category !";
                header('location:' . HOMEURL . 'admin/manage-category.php');
            }

        }

    }

} else {

    // Redirect to manage-category page is the variables are not set ?
    header('location:' . HOMEURL . 'admin/manage-category.php');

}

?>