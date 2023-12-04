<!DOCTYPE html>
<html>

<head>
  <title>Slide Navbar</title>
  <link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
  <script defer type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script defer nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
  <section class="page-not-found">
    <!-- <img class="page-not-found-img" src="/resources/images/404.jpg" alt="Oops!!! Something Went wrong. Error 404 Page Not Found" /> -->
    <?php require_svg("404.svg") ?>
    <a href="/">
      <div class="svg">
        <?php require_svg("back-arrow.svg") ?>
      </div>
      Back to Home
    </a>
  </section>
</body>

</html>