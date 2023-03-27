<!-- Main CMS/ Admin file  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/adminStyles.css">
    <title>GrabABite - Manage Category</title>
</head>

<body>
    <!-- Menu Section -->
    <div class="top-container">
      <?php include './partials/menu.php'; ?>
    </div>  

    <!-- mainContentSection -->
    <div class="main-container container">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>Manage Categories</b>
            </h2>
            <div class="d-flex justify-content-center" style="padding: 1%;">
                <a href="add-category.php" class="btn adminPanelBtn">
                    Add New Category
                </a>
            </div>

            <div>
                <?php
                if (isset($_SESSION['add-category'])) {
                    echo $_SESSION['add-category'];
                    // Ending session
                    unset($_SESSION['add-category']);
                }

                if (isset($_SESSION['remove-image-file'])) {
                    echo $_SESSION['remove-image-file'];
                    // Ending session
                    unset($_SESSION['remove-image-file']);
                }

                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    // Ending session
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['update-category'])) {
                    echo $_SESSION['update-category'];
                    // Ending session
                    unset($_SESSION['update-category']);
                }

                if (isset($_SESSION['no-category-found'])) {
                    echo $_SESSION['no-category-found'];
                    // Ending session
                    unset($_SESSION['no-category-found']);
                }

                if (
                    isset($_SESSION['failed-to-update-upload-category-image'])
                ) {
                    echo $_SESSION['failed-to-update-upload-category-image'];
                    // Ending session
                    unset($_SESSION['failed-to-update-upload-category-image']);
                }

                if (isset($_SESSION['failed-remove'])) {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }

                if (
                    isset(
                        $_SESSION[
                            'failed-to-remove-current-category-image-file
                '
                        ]
                    )
                ) {
                    echo $_SESSION[
                        'failed-to-remove-current-category-image-file
                  '
                    ];
                    // Ending session
                    unset(
                        $_SESSION[
                            'failed-to-remove-current-category-image-file
                  '
                        ]
                    );
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
                                <h5><b>Title</b></h5>
                            </th>
                            <th>
                                <h5><b>Image</b></h5>
                            </th>
                            <th>
                                <h5><b>Featured</b></h5>
                            </th>
                            <th>
                                <h5><b>Active</b></h5>
                            </th>
                            <th>
                                <h5><b>Actions</b></h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM tbl_category';

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            // Count rows for checking data availibility
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {

                                    //Run as long as data is available
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];
                                    ?>
                        <tr>
                            <td>
                                <p>
                                    <?php echo $sn++; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $title; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php if ($image_name != '') { ?>
                                    <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>"
                                        alt="Category Image" class="img-fluid" />
                                    <?php } else {echo 'Image not uploaded !';} ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $featured; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $active; ?>
                                </p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="<?php echo HOMEURL; ?>admin/update-category.php?id=
                                    <?php echo $id; ?>&image_name=
                                    <?php echo $image_name; ?>" class="btn adminPanelBtn mr-2">
                                        Update Category
                                    </a>
                                    <a href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Delete Category
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <?php
                                }
                            } else {
                                 ?>
                        <tr>
                            <td>
                                <p>
                                    No categories found yet !
                                </p>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <!-- footerSection -->
  <div class="bottom-container">
    <?php include 'partials/footer.php'; ?>
  </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>