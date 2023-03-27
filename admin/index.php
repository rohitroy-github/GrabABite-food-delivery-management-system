<!-- Main CMS/ Admin file  -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../css/adminStyles.css">

    <title>GrabABite - Admin's Panel</title>
  </head>
  <body>
    <!-- Menu Section -->
    <div class="top-container">
      <?php include './partials/menu.php'; ?>
    </div>  

    <?php if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    } ?>

    <!-- mainContentSection -->
    <div class="main-container container">
    <div class="content">
    <h2 style="font-weight: 500; text-align: center;">
        <b>Dashboard</b>
      </h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>
                <h4><b>Active Categories</b></h4>
              </th>
              <th>
                <h4><b>Food Items</b></h4>
              </th>
              <th>
                <h4><b>Total Orders</b></h4>
              </th>
              <th>
                <h4><b>Total Revenue</b></h4>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <?php
                $sql_category = 'SELECT * FROM tbl_category';
                $res_category = mysqli_query($conn, $sql_category);
                $count_category = mysqli_num_rows($res_category);
                ?>
                <h3><?php echo $count_category; ?></h3>
              </td>
              <td>
                <?php
                $sql_food = 'SELECT * FROM tbl_food';
                $res_food = mysqli_query($conn, $sql_food);
                $count_food = mysqli_num_rows($res_food);
                ?>
                <h3><?php echo $count_food; ?></h3>
              </td>
              <td>
                <?php
                $sql_order = 'SELECT * FROM tbl_order';
                $res_order = mysqli_query($conn, $sql_order);
                $count_order = mysqli_num_rows($res_order);
                ?>
                <h3><?php echo $count_order; ?></h3>
              </td>
              <td>
                <?php
                $sql_revenue =
                    'SELECT SUM(total) AS Total FROM tbl_order WHERE status="delivered"';
                $res_revenue = mysqli_query($conn, $sql_revenue);
                $row_revenue = mysqli_fetch_assoc($res_revenue);
                $tota_revenue = $row_revenue['Total'];
                ?>
              <h3>
                  <?php if ($tota_revenue != '') {
                      echo $tota_revenue;
                  } else {
                      echo '0.0';
                  } ?>
              </h3>
              </td>
            </tr>
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
