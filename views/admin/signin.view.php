<!DOCTYPE html>
<html lang="en">
<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>

  <section class="signin admin bg-dot-pattern">
    <div class="container grid-signin">
      <div class="signin__illustration">

        <?php require_svg("signin-admin.svg") ?>

      </div>
      <!-- <form method="post" class="signin__form flow d-flex bg-gradient pt-16 pb-12"> -->
      <form method="post" class="signin__form flow d-flex pt-16 pb-12">
        <div class="logo">
          <div class="signin__logo">

            <?php require_svg("admin/logo_v2.svg") ?>

          </div>
        </div>
        <h2 class="ff-expletus fs-900 fw-700 text-light">Admin Signin</h2>
        <div class="input-signin__container">
          <ion-icon name="person" aria-label="Email or Password" class="mt-3 ms-5 fs-600 text-secondary"></ion-icon>
          <input type="text" id="usrname_email" class="input-text input-signin" name="usrname_email" value="<?= $_POST['usrname_email'] ?? '' ?>" placeholder="Email or Username" aria-placeholder="Email or Username" />
          <small class="validation-alerts">

            <?= $alerts['usrname_email'] ?? '' ?>

          </small>
        </div>

        <div class="input-signin__container">
          <ion-icon name="lock-closed" aria-label="Password" class="mt-3 ms-5 fs-600 text-secondary"></ion-icon>
          <input type="password" id="password" class="input-text input-signin" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Password" aria-placeholder="Password" />
          <ion-icon name="eye-outline" id="toggle-password" class="mt-3 ms-auto me-5 fs-600 text-light"></ion-icon>
          <small class="validation-alerts">

            <?= $alerts['password'] ?? '' ?>

          </small>
        </div>
        <div class="signin__action d-flex">
          <button role="button" class="btn btn-m btn__hover-effect text-light" aria-labelledby="signin btn">
            <span></span>
            Signin
            <span></span>
          </button>
      </form>
    </div>
  </section>
</body>

</html>