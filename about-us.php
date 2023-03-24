<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/about.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <!-- navbarPortion -->
    <?php include './front-end-partials/menu.php'; ?>

    <section id="about-us">
    <div class="container">
        <div class="row">
        <div class="col-md-7">
            <h2>About Us</h2>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
            gravida massa non lectus volutpat, in ornare lectus commodo. Duis quis
            ante sit amet odio dignissim rutrum at a nulla. Sed vel malesuada mi,
            id dictum sapien. Sed commodo vel lacus sed consequat. Sed fermentum,
            enim vel convallis blandit, mauris enim hendrerit quam, vel sodales
            turpis eros ac enim.
            </p>
            <p>
            Nam ac nisi tortor. Maecenas vel mi euismod, eleifend ipsum in, varius
            arcu. Suspendisse malesuada eget nunc et faucibus. Pellentesque eu
            dolor massa. Vestibulum nec enim magna. Duis luctus ex justo, ac
            congue ante finibus id.
            </p>
        </div>
        <div class="col-md-5">
            <img src="./assets/about-us-logo.png" alt="about us image" />
        </div>
        </div>
    </div>
    </section>

    <!-- footerPortion -->
    <?php include './front-end-partials/footer.php'; ?>
  </body>
</html>
