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
            <h2 class="text-center">Explore Foods</h2>

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
            
            <?php
            // queryToDisplayCategoryFromDB
            // condition?Only3&Featured=Yes&Active=Yes
            $sql =
                'SELECT * FROM tbl_category WHERE active="Yes" AND featured="Yes" LIMIT 3';
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                // categoriesAvailable
                while ($rows = mysqli_fetch_assoc($res)) {

                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    ?>

                <a href="<?php echo HOMEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">

                    <!-- ifImageIsAvailableThenOnlyDisplay -->
                    <?php if ($image_name == '') {
                        echo 'Image is not available !';
                    } else {
                         ?>
                            <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    <?php
                    } ?>
                        <h3 class="float-text text-white">
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </a>
            
            <?php
                } //endOfWhile
            }
            //endOfIf
            else {
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
