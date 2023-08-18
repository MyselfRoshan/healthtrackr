<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="forgot-password d-flex">
    <div class="container">
      <form method="POST" class="d-grid flow">
        <header class="d-grid">
          <!-- <ion-icon name="key-outline"></ion-icon> -->
          <ion-icon name="mail-outline"></ion-icon>
          <h2 class="fs-700 fw-600 ff-expletus text-dark">Check your mail</h2>
        </header>
        <p>
          New
        </p>
        <a href="/signin" class="btn btn-m btn__hover-effect fw-500 text-light">
          <span></span>
          Return to sign in
          <span></span>
        </a>
      </form>
    </div>
  </section>
</body>

</html>