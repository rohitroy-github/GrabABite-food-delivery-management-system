<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/categories.css">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity=
"sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous"/>
</head>

<body>
    <!-- navbarPortion -->
    <?php include './front-end-partials/menu.php'; ?>

    <!-- CAtegories Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <!-- messageSessions -->
            <?php
            if (isset($_SESSION['no-categories-available'])) {
                echo $_SESSION['no-categories-available'];
                // Ending session
                unset($_SESSION['no-categories-available']);
            }

            if (isset($_SESSION['no-food-available'])) {
                echo $_SESSION['no-food-available'];
                // Ending session
                unset($_SESSION['no-food-available']);
            }
            ?>
            <div class="row gallery">
                <?php
                // queryToDisplayCategoryFromDB
                // condition?Only3&Featured=Yes&Active=Yes
                $sql =
                    'SELECT * FROM tbl_category WHERE active="Yes" AND featured="Yes"';
                // 'SELECT * FROM tbl_category WHERE active="Yes" AND featured="Yes" LIMIT 3';
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    // categoriesAvailable
                    while ($rows = mysqli_fetch_assoc($res)) {

                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>
                    <div class="col-md-3 galleryElement">
                        <a href="<?php echo HOMEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <!-- ifImageIsAvailableThenOnlyDisplay -->
                        <?php if ($image_name == '') {
                            echo 'Image is not available !';
                        } else {
                             ?>
                                <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="categoryImage">
                        <?php
                        } ?>
                            <div class="caption">
                                <p><?php echo $title; ?></p>
                            </div>
                        </a>
                    </div>
                        <?php
                    } //endOfWhile
                }
                //endOfIf
                else {
                    // categoriesNotAvailable
                    $_SESSION['no-categories-available'] =
                        'No Categories Found !';
                    header('location:' . HOMEURL);
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- footerPortion -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
