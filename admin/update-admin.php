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
    <title>Update Admin Details</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    // echo "Admin Available !"
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('location:' . HOMEURL . 'admin/manage-admin.php');
                }
            }
            ?>
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Update Admin Details</h2>
                <br />
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="full_name"
                        placeholder="Enter your full name ?" value="<?php echo $full_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username"
                        placeholder="Enter a username ?" value="<?php echo $username; ?>" />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="update-admin">
                    Login
                </button>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </form>

            <?php if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                $sql = "UPDATE tbl_admin SET
                full_name='$full_name', 
                username='$username' 
                WHERE id=$id
                ";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $_SESSION['update'] = 'Admin Updated Successfully !';
                    header('location:' . HOMEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['update'] = 'Admin Updation Failed !';
                    header('location:' . HOMEURL . 'admin/manage-admin.php');
                }
            } ?>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>