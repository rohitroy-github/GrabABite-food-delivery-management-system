<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <!-- navbarPortion -->
<?php include './front-end-partials/menu.php'; ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food Categories</h2>

                        <!-- messageSessions -->
                        <?php if (isset($_SESSION['no-categories-available'])) {
                            echo $_SESSION['no-categories-available'];
                            // Ending session
                            unset($_SESSION['no-categories-available']);
                        } ?>


            <!-- displayingAllTheAvailableCategory -->

            <?php
            $sql = 'SELECT * FROM tbl_category WHERE active="Yes"';
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            // checkIfCategoriesAvailable?
            if ($count > 0) {
                // categoriesAvailable
                while ($rows = mysqli_fetch_assoc($res)) {

                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    ?>

            <a href="category-foods.html">
                <div class="box-3 float-container">
                                        <!-- ifImageIsAvailableThenOnlyDisplay -->
                                        <?php if ($image_name == '') {
                                            echo 'Image is not available !';
                                        } else {
                                             ?>
                                             <!-- imageAvailable -->
                            <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" width="400" height="200">
                    <?php
                                        } ?>
                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
            </a>
                    <?php
                }
            } else {
                // categoriesNotAvailable
                $_SESSION['no-categories-available'] = 'No Categories Found !';
                header('location:' . HOMEURL);
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- footerPortion -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
