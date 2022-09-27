<!-- Manage Food Panel  -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Manage Food Items</title>
  </head>
  <body>
    <!-- Menu Section -->

    <?php include 'partials/menu.php';?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Manage Food Items</h2>

        <br />

        <!-- Button to add new Category -->

        <a href="add-food.php" class="btn-new-admin">Add New Food Item</a>

        <br /><br /><br />

        <!-- Printing success message -->
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

if (isset($_SESSION['delete-food-item'])) {
    echo $_SESSION['delete-food-item'];
    // Ending session
    unset($_SESSION['delete-food-item']);
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

?>

        <br />

        <table class="tbl-full">

          <tr>
            <th>Serial Number</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>

          <?php
$sql = "SELECT * FROM tbl_food";

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
              <td><?php echo $sn++; ?></td>
              <td><?php echo $title; ?></td>
              <td><?php echo $price; ?></td>
              <td>
                <?php
// Check if image name is available ?

            if ($image_name != "") {
                ?>
                  <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                  <?php
} else {
                echo "<div class='message'>Image Not Uploaded !</div>";
            }
            ?>
              </td>
              <td><?php echo $featured; ?></td>
              <td><?php echo $active; ?></td>
              <td>
              <a
                  href="<?php echo HOMEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                  class="btn-table"
                  >Update Food Item</a
                >

                <a
                  href="<?php echo HOMEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                  class="btn-table"
                  >Delete Food Item</a
                >
              </td>
              </tr>

            <?php

        }

    } else {
        ?>
            <tr>
              <td colspan="6">
                <div class="message">No Food Item Found !</div>
              </td>
            </tr>
            <?php
}
}
?>

        </table>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php';?>
  </body>
</html>