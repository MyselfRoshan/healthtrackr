<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="signup">
    <div class="container grid-layout">
      <form action="/signup" class="signup__form flow" method="POST">
        <h2 class="ff-expletus fs-900 fw-700 text-dark">Create Account</h2>
        <div class="name">
          <div class="input-signup__container">
            <input type="text" id="fname" class="input-text input-signup" name="fname" value="" aria-labelledby="label-fname" />
            <label class="label fs-300 fw-500 d-flex" for="fname" id="label-fname">
              <span class="label__text text-dark-400">First Name</span>
            </label>
            <small class="validation-alerts">

              <?= $alerts['fname'] ?? '' ?>

            </small>
          </div>
          <div class="input-signup__container">
            <input type="text" id="lname" class="input-text input-signup" name="lname" value="" aria-labelledby="label-lname" />
            <label class="label fs-300 fw-500 d-flex" for="lname" id="label-lname">
              <span class="label__text text-dark-400">Last Name</span>
            </label>
            <small class="validation-alerts">

              <?= $alerts['lname'] ?? '' ?>

            </small>
          </div>
        </div>
        <div class="input-signup__container">
          <input type="text" id="username" class="input-text input-signup" name="username" value="" aria-labelledby="label-username" />
          <label class="label fs-300 fw-500 d-flex" for="username" id="label__username">
            <span class="label__text text-dark-400">Username</span>
          </label>
          <small class="validation-alerts">

            <?= $alerts['username'] ?? '' ?>

          </small>
        </div>
        <div class="input-signup__container">
          <input type="email" id="email" class="input-text input-signup" name="email" value="" aria-labelledby="label-email" />
          <label class="label fs-300 fw-500 d-flex" for="email" id="label-email">
            <span class="label__text text-dark-400">Email</span>
          </label>
          <small class="validation-alerts">

            <?= $alerts['email'] ?? '' ?>

          </small>
        </div>
        <div class="input-signup__container">
          <input type="password" id="password" class="input-text input-signup" name="password" value="" aria-labelledby="label-password" />
          <label class="label fs-300 fw-500 d-flex" for="password" id="label-password">
            <span class="label__text text-dark-400">Password</span>
          </label>
          <ion-icon name="eye-outline" id="toggle-password" class="fs-600 text-dark-400 my-auto ms-auto me-6"></ion-icon>
          <small class="validation-alerts">

            <?= $alerts['password'] ?? '' ?>

          </small>
        </div>
        <button class="btn btn-m btn__hover-effect text-light">
          <span></span>
          Sign up
          <span></span>
        </button>
        <p class="terms-and-conditions mx-auto fs-300">
          By clicking on Sign up, you agree to our
          <a href="#">Terms of service</a> and
          <a href="#">Privacy policy.</a>
        </p>
      </form>
      <div class="signup__illustration">
        <?php require_svg("sign-up.svg.php") ?>
      </div>
    </div>
  </section>
</body>

</html>