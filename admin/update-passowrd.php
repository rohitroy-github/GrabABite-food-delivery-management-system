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
    <title>Update Admin Password</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } ?>
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Update Admin Password</h2>
                <br />
                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input name="old-password" type="text" class="form-control" id="old-password"
                        placeholder="Enter your current password ?" />
                </div>
                <div class=" form-group">
                    <label for="username">New Password</label>
                    <input name="new-password" type="text" class="form-control" id="new-password"
                        placeholder="Enter a new password ?" />
                </div>
                <div class=" form-group">
                    <label for="username">Confirm New Password</label>
                    <input name="confirm-password" type="text" class="form-control" id="confirm-password"
                        placeholder="Enter the new password again ?" />
                </div>
                <button name="submit" type="submit" class="btn btn-primaryColor" value="update-admin">
                    Update Password
                </button>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </form>

            <?php if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $new_password = md5($_POST['new-password']);
                $old_password = md5($_POST['old-password']);
                $confirm_password = md5($_POST['confirm-password']);

                $sql1 = "SELECT * FROM tbl_admin WHERE id=$id AND password='$old_password'";

                $res1 = mysqli_query($conn, $sql1);

                if ($res1 == true) {
                    // Check data availibility
                    $count = mysqli_num_rows($res1);

                    if ($count == 1) {
                        if ($new_password = $confirm_password) {
                            $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id";

                            $res2 = mysqli_query($conn, $sql2);

                            if ($res2 == true) {
                                $_SESSION['update-password'] =
                                    'Password Updated Successfully !';
                                header(
                                    'location:' .
                                        HOMEURL .
                                        'admin/manage-admin.php'
                                );
                            } else {
                                $_SESSION['update-password'] =
                                    'Password Updation Failed !';
                                header(
                                    'location:' .
                                        HOMEURL .
                                        'admin/manage-admin.php'
                                );
                            }
                        } else {
                            $_SESSION['password-not-match'] =
                                'Password Did Not Match !';
                            header(
                                'location:' . HOMEURL . 'admin/manage-admin.php'
                            );
                        }
                    } else {
                        $_SESSION['user-not-found'] = 'User Not Found !';
                        header(
                            'location:' . HOMEURL . 'admin/manage-admin.php'
                        );
                    }
                }
            } ?>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>