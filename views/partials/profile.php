<section class="profile__section d-grid">
  <header class="profile__header px-10 py-12">
    <form method="POST" class="profile__pic mx-auto" enctype="multipart/form-data">
      <img id="profile__pic" src=<?= $user['profile_pic'] ?> alt="Profile picture" />
      <div id="upload" class="round-right">
        <input type="file" id="profile__pic-uploader" name="profile_pic" accept=".png, .jpg, .jpeg" />
        <ion-icon name="camera-outline"></ion-icon>
      </div>
      <button type="button" id="cancel" class="round-left d-none">
        <ion-icon name="close"></ion-icon>
      </button>
      <button type="submit" id="confirm" class="round-right d-none">
        <ion-icon name="checkmark"></ion-icon>
      </button>
    </form>
    <h3 class="fs-600 fw-600 d-flex ff-expletus text-primary my-6">
      hello
    </h3>
    <dl>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Name:</dt>
        <dd><?= $user['first_name'] ?> <?= $user['last_name'] ?></dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Email:</dt>
        <dd><?= $user['email'] ?></dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Age:</dt>
        <dd>21</dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Height:</dt>
        <dd>5'4"</dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Weight:</dt>
        <dd>54 kg</dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Last login:</dt>
        <dd><?= $user['last_login'] ?></dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Created on:</dt>
        <dd><?= $user['created_on'] ?></dd>
      </div>
    </dl>
  </header>
  <form action="" class="profile__change flow px-10 py-12">
    <h3 class="fs-700 fw-600 text-accent mb-16">My account</h3>
    <div class="form-container py-4">
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="fname" id="label-fname">
          First Name
        </label>
        <input type="text" id="fname" class="input-text" name="fname" value="Hello" aria-labelledby="label-fname" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="lname" id="label-lname">
          Last Name
        </label>
        <input type="text" id="lname" class="input-text" name="lname" value="World" aria-labelledby="label-lname" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="username" id="label__username">
          Username
        </label>
        <input type="text" id="username" class="input-text" name="username" value="hello" aria-labelledby="label-username" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="email" id="label-email">
          Email
        </label>
        <input type="email" id="email" class="input-text" name="email" value="admin@mail.com" aria-labelledby="label-email" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="password" id="label-password">
          Password
        </label>
        <input type="password" id="password" class="input-text" name="password" value="1234!@#$Qw" aria-labelledby="label-password" />
        <ion-icon name="eye-outline" id="toggle-password" class="fs-600 text-dark-400 ms-auto me-6 mt-9"></ion-icon>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="age" id="label-age">
          Age
        </label>
        <input type="number" id="age" class="input-text" name="age" value="21" aria-labelledby="label-age" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="height" id="label-height">
          Height
        </label>
        <input type="number" id="height" class="input-text" name="height" value="5'4" aria-labelledby="label-height" />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="weight" id="label-weight">
          Weight
        </label>
        <input type="number" id="weight" class="input-text" name="weight" value="54" aria-labelledby="label-weight" />
      </div>
    </div>
    <button class="btn btn-m btn__hover-effect text-light">
      <span></span>
      Update Info
      <span></span>
    </button>
  </form>
</section>
<?php
// $date = new DateTime($user['created_on']);
// dd($date->format('D jS, F Y h:i A'));
?>