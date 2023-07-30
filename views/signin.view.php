<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="signin">
    <div class="container grid-signin">
      <div class="signin__illustration">

        <?php require_svg("signin.svg.php") ?>

      </div>
      <form action="post" class="signin__form flow d-flex bg-gradient pt-16 pb-12">
        <div class="logo">
          <div class="signin__logo">

            <?php require_svg("logo.svg.php") ?>

          </div>
        </div>
        <h2 class="ff-expletus fs-900 fw-700 text-light">Signin</h2>
        <div class="input-signin__container">
          <ion-icon name="person" aria-label="Email or Password" class="my-auto ms-5 fs-600 text-secondary"></ion-icon>
          <input type="text" id="usrname-email" class="input-text input-signin" name="usrname-email" value="" placeholder="Email or Username" aria-placeholder="Email or Username" />
        </div>

        <div class="input-signin__container">
          <ion-icon name="lock-closed" aria-label="Password" class="my-auto ms-5 fs-600 text-secondary"></ion-icon>
          <input type="password" id="password" class="input-text input-signin" name="password" value="" placeholder="Password" aria-placeholder="Password" />
          <ion-icon name="eye-outline" id="toggle-password" class="my-auto ms-auto me-5 fs-600 text-light"></ion-icon>
        </div>
        <div class="signin__action d-flex">
          <div class="input-signin__container">
            <input type="checkbox" name="remember-me" id="remember-me" class="remember-me" />
            <label for="remember-me" id="label__remember-me" class="label text-primary">Remember me</label>
          </div>
          <a href="" class="forgot-password">Forgot password?</a>
        </div>
        <button role="button" class="btn btn-m btn__hover-effect text-light" aria-labelledby="signin btn">
          <span></span>
          Signin
          <span></span>
        </button>
        <hr />
        <button class="btn btn-m btn__hover-effect text-dark">
          <span></span>
          <span>
            <span class="icon__google">
              <?php require_svg("logo-google.svg.php") ?>
            </span>
            Signin with Google
          </span>
          <span></span>
        </button>
        <p class="no-account">
          Don't have an account yet?
          <a href="/signup">Register here</a>
        </p>
      </form>
    </div>
  </section>
</body>

</html>