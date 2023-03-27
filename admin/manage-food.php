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
    <title>GrabABite - Manage Food</title>
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
                <b>Manage Menu Items</b>
            </h2>
            <div class="d-flex justify-content-center" style="padding: 1%;">
                <a href="add-food.php" class="btn adminPanelBtn">
                    Add New Dish
                </a>
            </div>

            <div>
              <?php
              if (isset($_SESSION['add-food'])) {
                  echo $_SESSION['add-food'];
                  // Ending session
                  unset($_SESSION['add-food']);
              }
              if (isset($_SESSION['update-food'])) {
                  echo $_SESSION['update-food'];
                  // Ending session
                  unset($_SESSION['update-food']);
              }
              if (isset($_SESSION['failed-to-delete-food-item-image'])) {
                  echo $_SESSION['failed-to-delete-food-item-image'];
                  // Ending session
                  unset($_SESSION['failed-to-delete-food-item-image']);
              }
              if (isset($_SESSION['delete'])) {
                  echo $_SESSION['delete'];
                  // Ending session
                  unset($_SESSION['delete']);
              }
              if (isset($_SESSION['failed-to-update-upload-image'])) {
                  echo $_SESSION['failed-to-update-upload-image'];
                  // Ending session
                  unset($_SESSION['failed-to-update-upload-image']);
              }
              if (isset($_SESSION['failed-to-remove-current-food-image'])) {
                  echo $_SESSION['failed-to-remove-current-food-image'];
                  // Ending session
                  unset($_SESSION['failed-to-remove-current-food-image']);
              }
              if (isset($_SESSION['no-food-found'])) {
                  echo $_SESSION['no-food-found'];
                  // Ending session
                  unset($_SESSION['no-food-found']);
              }
              if (isset($_SESSION['failed-to-upload-food-image'])) {
                  echo $_SESSION['failed-to-upload-food-image'];
                  // Ending session
                  unset($_SESSION['failed-to-upload-food-image']);
              }
              if (isset($_SESSION['failed-to-remove-food-image-file'])) {
                  echo $_SESSION['failed-to-remove-food-image-file'];
                  // Ending session
                  unset($_SESSION['failed-to-remove-food-image-file']);
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
                                <h5><b>Price</b></h5>
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
                        $sql = 'SELECT * FROM tbl_food';

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
                                    $price = $rows['price'];
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
                                    <?php echo $price; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php if ($image_name != '') { ?>
                                    <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>"
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
                                    <a href="<?php echo HOMEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Update Dish
                                    </a>
                                    <a href="<?php echo HOMEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Remove Dish
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
                                    Currently the menu is empty !
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