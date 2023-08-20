<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="forgot-password d-flex">
    <div class="container">
      <form method="POST" class="d-grid flow">
        <header class="d-grid">

          <?php if (isset($_SESSION['reset_token_expires_at']) && strtotime($_SESSION['reset_token_expires_at']) <= time()) : ?>
            <div class="link-expired d-flex mb-8" role="alert">
              <ion-icon name="alert-circle-outline" style="margin-right: 10px;"></ion-icon>
              <p class="m-0">Your password reset link has expired. Please initiate the reset process again.</p>
            </div>
            <?php unset($_SESSION['reset_token_expires_at']) ?>
            <?php unset($_SESSION['reset_token']) ?>
          <?php endif ?>

          <ion-icon name="key-outline"></ion-icon>
          <h2 class="fs-700 fw-600 ff-expletus text-dark">
            Forgot Password?
          </h2>
        </header>
        <label class="label-email fs-400 text-dark" for="email" id="label-email">
          Enter your user account's verified email address and we will send
          you a password reset link.
        </label>
        <input type="email" id="email" class="input-text" name="email" placeholder="Eg: example@dot.com" value="" aria-labelledby="label-email" />
        <small class="validation-alerts">

          <?= $alerts['email'] ?? '' ?>

        </small>
        <button role="button" class="btn btn-m btn__hover-effect fw-500 text-light" aria-labelledby="Signin btn">
          <span></span>
          Send password reset email
          <span></span>
        </button>
      </form>
    </div>
  </section>
</body>

</html>