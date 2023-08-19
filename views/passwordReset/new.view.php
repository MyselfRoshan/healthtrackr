<!DOCTYPE html>
<html lang="en">

<?php require_view("partials/head.php", ['scripts' => $scripts]) ?>

<body>
  <section class="forgot-password d-flex">
    <div class="container">
      <form method="POST" class="d-grid flow">
        <header class="d-grid">
          <ion-icon name="key-outline"></ion-icon>
          <h2 class="fs-700 fw-600 ff-expletus text-dark">Change password for @<?= $username ?></h2>
        </header>
        <p>
          Make sure it's at least 8 characters including a number, a uppercase letter and a lowercase letter.
        </p>
        <div class="input-signup__container">
          <input type="password" id="password" class="input-text input-signup" name="password" value="<?= $_POST['password'] ?? '' ?>" aria-labelledby="label-password" />
          <label class="label fs-300 fw-500 d-flex" for="password" id="label-password">
            <span class="label__text text-dark-400">Password</span>
          </label>
          <ion-icon name="eye-outline" id="toggle-password" class="fs-600 text-dark-400 mt-3.5 ms-auto me-6"></ion-icon>
          <small class="validation-alerts">

            <?= $alerts['password'] ?? '' ?>

          </small>
        </div>
        <button role="button" class="btn btn-m btn__hover-effect fw-500 text-light" aria-labelledby="Signin btn">
          <span></span>
          Change password
          <span></span>
        </button>
      </form>
    </div>
  </section>
</body>

</html>