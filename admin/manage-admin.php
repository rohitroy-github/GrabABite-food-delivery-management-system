<!-- Main CMS/ Admin file  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            width: 100vw;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80%;
        }

        .content {
            width: 100%;
        }

        .table-responsive {
            margin: auto;
        }

        th {
            text-align: center;
            vertical-align: middle;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        p {
            text-align: center;
            align-items: center;
            padding: 7px 12px;
            font-size: 15px;
        }

        h5 {
            text-align: center;
            align-items: center;
            margin: 0;
        }

        .btn {
            padding: 7px 12px;
            font-size: 15px;
        }

        tbody .adminPanelBtn {
            background-color: #fc8019;
            border-color: #fc8019;
            font-weight: 800;
            color: white;
        }

        .adminPanelBtn:hover {
            background-color: #ffffff;
            color: black;
            border-color: #fc8019;
            font-weight: 800;
        }

        .content .adminPanelBtn { 
          background-color: #fc8019;
            border-color: #fc8019;
            font-weight: 800;
            color: white;
        }

        .content .adminPanelBtn:hover {
            background-color: #ffffff;
            color: black;
            border-color: #fc8019;
            font-weight: 800;
        }
    </style>
    <title>GrabABite - Admins</title>
</head>

<body>
    <!-- navbar -->

    <?php include './partials/menu.php'; ?>

    <!-- mainContent -->
    <div class="main-container container">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>Admins</b>
            </h2>
            <div class="d-flex justify-content-center" style="padding: 1%;">
            <a href="add-admin.php" class="btn adminPanelBtn">Add New Admin</a>
</div>

            <div>
                <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    // Ending session
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    // Ending session
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    // Ending session
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['update-password'])) {
                    echo $_SESSION['update-password'];
                    // Ending session
                    unset($_SESSION['update-password']);
                }

                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    // Ending session
                    unset($_SESSION['user-not-found']);
                }

                if (isset($_SESSION['password-not-match'])) {
                    echo $_SESSION['password-not-match'];
                    // Ending session
                    unset($_SESSION['password-not-match']);
                }
                ?>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h5><b>Serial Number</b></h5>
                            </th>
                            <th>
                                <h5><b>Full Name</b></h5>
                            </th>
                            <th>
                                <h5><b>Username</b></h5>
                            </th>
                            <th>
                                <h5><b>Actions</b></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = 'SELECT * FROM tbl_admin';

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            // Count rows for checking data availibility
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {

                                    //Run as long as data is available
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];
                                    ?>

                        <tr>
                            <td>
                                <p>
                                    <?php echo $sn++; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $full_name; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $username; ?>
                                </p>

                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="<?php echo HOMEURL; ?>admin/update-passowrd.php?id=<?php echo $id; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Change Password
                                    </a>
                                    <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Update Admin
                                    </a>
                                    <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                        class="btn adminPanelBtn">
                                        Delete Admin
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->

    <?php include 'partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>