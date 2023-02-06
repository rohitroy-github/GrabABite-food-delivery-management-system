<!-- Manage Order Panel -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Home Page</title>
  </head>
  <body>
    <!-- Menu Section -->

    <?php include 'partials/menu.php'; ?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Manage Orders</h2>

        <br />

        <table class="tbl-full">

          <tr>
            <th>Serial Number</th>
            <th>Food</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Order date </th>
            <th>Order status </th>
            <th>Customer address</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
          <?php
          // getAllTheOrdersFromDatabase
          $sql = 'SELECT * FROM tbl_order ORDER BY id DESC';
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);

          $sn = 1;
          if ($count > 0) {
              while ($rows = mysqli_fetch_assoc($res)) {

                  // orderAvailabe
                  $id = $rows['id'];
                  $food = $rows['food'];
                  $price = $rows['price'];
                  $qty = $rows['qty'];
                  $total = $rows['total'];
                  $order_date = $rows['order_date'];
                  $status = $rows['status'];
                  $customer_name = $rows['customer_name'];
                  $customer_contact = $rows['customer_contact'];
                  $customer_email = $rows['customer_email'];
                  $customer_address = $rows['customer_address'];
                  ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $food; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $order_date; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $customer_name; ?></td>
                <td><?php echo $customer_contact; ?></td>
                <td><?php echo $customer_email; ?></td>
                <td><?php echo $customer_address; ?></td>
                <td>
                  <a href="#" class="btn-table">Update Admin</a>
                  <a href="#" class="btn-table">Delete Admin</a>
                </td>
              </tr>
              <?php
              }
          } else {
              echo "<tr><td colspan='12' class='error-message'>Order not available !</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>
  </body>
</html>
