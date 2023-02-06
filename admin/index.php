<!-- Main CMS/ Admin file  -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css">

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Home Page</title>
  </head>
  <body>
    <!-- Menu Section -->

    <?php include 'partials/menu.php'; ?>

    <!-- Main Content Section-->
    <div class="main-content"> 
        <div class="wrapper">
            
            <h2 style="text-align: center">Dashboard</h2>

            <!-- Login Message -->

            <?php if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            } ?>

            <div class="col-4">
              <?php
              $sql_category = 'SELECT * FROM tbl_category';
              $res_category = mysqli_query($conn, $sql_category);
              $count_category = mysqli_num_rows($res_category);
              ?>
                <h1><?php echo $count_category; ?></h1>
                <br />
                Active Categories
            </div>

            <div class="col-4">
            <?php
            $sql_food = 'SELECT * FROM tbl_food';
            $res_food = mysqli_query($conn, $sql_food);
            $count_food = mysqli_num_rows($res_food);
            ?>
                <h1><?php echo $count_food; ?></h1>
                <br />
                Food Items
            </div>

            <div class="col-4">
            <?php
            $sql_order = 'SELECT * FROM tbl_order';
            $res_order = mysqli_query($conn, $sql_order);
            $count_order = mysqli_num_rows($res_order);
            ?>
                <h1><?php echo $count_order; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4">
            <?php
            $sql_revenue =
                'SELECT SUM(total) AS Total FROM tbl_order WHERE status="order-placed"';
            $res_revenue = mysqli_query($conn, $sql_revenue);
            $row_revenue = mysqli_fetch_assoc($res_revenue);
            $tota_revenue = $row_revenue['Total'];
            ?>
                <h1><?php echo $tota_revenue; ?></h1>
                <br />
                Total Revenue
            </div>

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>

  </body>
</html>
