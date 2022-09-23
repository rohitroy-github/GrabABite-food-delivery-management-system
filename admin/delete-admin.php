<!-- Deleting an Admin from the db -->

<?php

include '../config/constants.php';

$id = $_GET['id'];

$sql = "DELETE FROM tbl_admin WHERE id=$id";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    $_SESSION['delete'] = "Admin Deleted Successfully !";

    //Redirect
    header('location:' . HOMEURL . 'admin/manage-admin.php');
} else {

    $_SESSION['delete'] = "Failed To Delete Admin !";
    header('location:' . HOMEURL . 'admin/manage-admin.php');
}

echo $id;
?>