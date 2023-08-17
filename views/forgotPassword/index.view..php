<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="forgot-password d-flex">
    <div class="container">
      <form method="POST" class="d-grid flow">
        <header class="d-grid">
          <ion-icon name="key-outline"></ion-icon>
          <h2 class="fs-700 fw-600 ff-expletus text-dark">
            Forgot Password?
          </h2>
        </header>
        <label class="label fs-400 text-dark" for="email" id="label-email">
          Enter your user account's verified email address and we will send
          you a password reset link.
        </label>
        <input type="email" id="email" class="input-text" name="email" placeholder="Eg: example@dot.com" value="" aria-labelledby="label-email" />

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