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
      h3 {
        text-align: center;
        align-items: center;
      }
      h4 {
        text-align: center;
        align-items: center;
      }
    </style>

    <title>GrabABite - Admin's Panel</title>
  </head>
  <body>
    <!-- Menu Section -->
    <?php include './partials/menu.php'; ?>

    <?php if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    } ?>

    <!-- Main Content Section-->
  <div class="main-container container">
    <div class="content">
      <h2 style="font-weight: 500; padding: 3%; text-align: center">
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
                    'SELECT SUM(total) AS Total FROM tbl_order WHERE status="order-placed"';
                $res_revenue = mysqli_query($conn, $sql_revenue);
                $row_revenue = mysqli_fetch_assoc($res_revenue);
                $tota_revenue = $row_revenue['Total'];
                ?>
                <h3><?php echo $tota_revenue; ?></h3>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

    <?php include 'partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
