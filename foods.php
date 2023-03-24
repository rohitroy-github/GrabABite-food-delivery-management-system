<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/foods.css">


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

<!-- FoodSearchBarSectionStarts -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo HOMEURL; ?>food-search.php" method="POST">
      <div class="r">
        <input
          type="search"
          name="search"
          placeholder="What's on your mind ... ?"
          required
        />
      </div>
      <div class="r">
        <input
          type="submit"
          name="submit"
          value="Search"
          class="searchBarBtn"
        />
      </div>
    </form>
  </div>
</section>
<!-- FoodSearchBarSectionEnds -->

    <!-- foodMenuSectionStartsHere -->
    <section class="food-menu">
    <div class="container">
    <h2 class="text-center">Food Menu</h2>

    <div class="row">
    <?php
    // gettingFoodMenuFromDatabase
    // condition?Only3&Featured=Yes&Active=Yes
    $sql_food =
        'SELECT * FROM tbl_food WHERE active="Yes" AND featured="Yes" LIMIT 6';
    $res_food = mysqli_query($conn, $sql_food);
    $count_food = mysqli_num_rows($res_food);

    if ($count_food > 0) {
        // foodAvailable
        while ($rows = mysqli_fetch_assoc($res_food)) {

            // gettingTheValuesFromDatabase
            $title = $rows['title'];
            $id = $rows['id'];
            $price = $rows['price'];
            $description = $rows['description'];
            $image_name = $rows['image_name'];
            ?>      
        <div class="col-md-4 col-sm-6">


        <div class="card">

        <!-- checkWhetherImageAvailableOrNot? -->
        <?php if ($image_name == '') {
            // imageNotAvailable
            $_SESSION['no-food-image-available'] = 'Image Unvailable !';
            header('location:' . HOMEURL);
        }
        // imageAvailable
        else {
             ?>
<img class="card-img-top" src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" >
                            <?php
        } ?>


          <div class="card-body">
            <h5 class="card-title"><?php echo $title; ?></h5>
            <p class="card-text description"><?php
            $maxLength = 100;

            if (strlen($description) > $maxLength) {
                $shortText = substr($description, 0, $maxLength);
                echo $shortText . '...';
            } else {
                echo $description;
            }
            ?></p>
            <p class="card-text">Price: $<?php echo $price; ?></p>
            <a href="<?php echo HOMEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
      </div>
      <?php
        }
    } else {
        // foodUnavailable
        $_SESSION['no-food-available'] = 'No Food Available !';
        header('location:' . HOMEURL);
    }
    ?>
  </div>
  
    </div>

    <div class="clearfix"></div>
    </section>
    <!-- foodMenuSectionEndsHere -->

    <!-- footer -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
