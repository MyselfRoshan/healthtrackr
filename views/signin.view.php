<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="signin">
    <div class="container grid-signin">
      <div class="signin__illustration">

        <?php require_svg("signin.svg.php") ?>

      </div>
      <form method="post" class="signin__form flow d-flex bg-gradient pt-16 pb-12">
        <div class="logo">
          <div class="signin__logo">

            <?php require_svg("logo.svg.php") ?>

          </div>
        </div>
        <h2 class="ff-expletus fs-900 fw-700 text-light">Signin</h2>
        <div class="input-signin__container">
          <ion-icon name="person" aria-label="Email or Password" class="mt-3.5 ms-5 fs-600 text-secondary"></ion-icon>
          <input type="text" id="usrname_email" class="input-text input-signin" name="usrname_email" value="<?= $_POST['usrname_email'] ?? '' ?>" placeholder="Email or Username" aria-placeholder="Email or Username" />
          <small class="validation-alerts">

            <?= $alerts['usrname_email'] ?? '' ?>

          </small>
        </div>

        <div class="input-signin__container">
          <ion-icon name="lock-closed" aria-label="Password" class="mt-3.5 ms-5 fs-600 text-secondary"></ion-icon>
          <input type="password" id="password" class="input-text input-signin" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Password" aria-placeholder="Password" />
          <ion-icon name="eye-outline" id="toggle-password" class="mt-3.5 ms-auto me-5 fs-600 text-light"></ion-icon>
          <small class="validation-alerts">

            <?= $alerts['password'] ?? '' ?>

          </small>
        </div>
        <div class="signin__action d-flex">
          <div class="input-signin__container">
            <input type="checkbox" name="remember_me" id="remember-me" class="remember-me" />
            <label for="remember-me" id="label__remember-me" class="label text-primary">Remember me</label>
          </div>
          <a href="/password-reset" class="forgot-password">Forgot password?</a>
        </div>
        <button role="button" class="btn btn-m btn__hover-effect text-light" aria-labelledby="signin btn">
          <span></span>
          Signin
          <span></span>
        </button>
        <hr />
        <!-- <button class="btn btn-m btn__hover-effect text-dark">
          <span></span>
          <span>
            <span class="icon__google">
              <?php require_svg("logo-google.svg.php") ?>
            </span>
            Signin with Google
          </span>
          <span></span>
        </button> -->
        <p class="no-account">
          Don't have an account yet?
          <a href="/signup">Register here</a>
        </p>
      </form>
    </div>
  </section>
</body>

</html>