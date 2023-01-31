<!-- FoodOrderComponent -->
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

    <!-- checkForFoodID -->
    <?php if (isset($_GET['food_id'])) {
        // getFoodID&Details
        $food_id = $_GET['food_id'];
        // getEverythingBasedOnID
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        // executeQuery
        $res = mysqli_query($conn, $sql);
        // getTheValues
        $count = mysqli_num_rows($res);
        // checkDataAvailability
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            // getTheDetailsFromDatabase
            // $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            // $description = $row['description'];
            $image_name = $row['image_name'];
        } else {
            // getBackToHomePage
            header('location:' . HOMEURL);
        }
    } else {
        // getBackToHomePage
        header('location:' . HOMEURL);
    } ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <!-- checkWhetherImageAvailableOrNot? -->
                        <?php if ($image_name == '') {
                            // imageNotAvailable
                            // $_SESSION['no-food-image-available'] =
                            //     'Image Unvailable !';
                            // header('location:' . HOMEURL);
                            echo "<div class='error-message'>Image not available at the moment !</div>";
                        }
                        // imageAvailable
                        else {
                             ?>
                            <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" alt="food-image" class="img-responsive img-curve">
                            <?php
                        } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price"><?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- footer -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
