<section class="profile__section d-grid">
  <div class="profile__header px-10 py-12">
    <form method="POST" enctype="multipart/form-data" class="profile__pic mx-auto">
      <input type="hidden" name="_request_method" value="patch">
      <img id="profile__pic" src=<?= $user['profile_pic'] ?> alt="Profile picture" />
      <div id="upload" class="round-right">
        <input type="file" id="profile__pic-uploader" name="profile_pic" accept=".png, .jpg, .jpeg" />
        <ion-icon name="camera-outline"></ion-icon>
      </div>
      <button type="button" id="cancel" class="round-left d-none">
        <ion-icon name="close"></ion-icon>
      </button>
      <button name="upload_pic" type="submit" id="confirm" class="round-right d-none">
        <ion-icon name="checkmark"></ion-icon>
      </button>
    </form>
    <h3 class="fs-600 fw-600 d-flex ff-expletus text-accent my-6 mx-auto">
      <?= $user['username'] ?>
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
        <dd><?= formatMesurement($user['age'], 'years old') ?></dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Height:</dt>
        <dd><?= formatMesurement($user['height'], 'cm') ?></dd>
      </div>
      <div class="details d-flex my-2 text-accent">
        <dt class="text-light fw-600">Weight:</dt>
        <dd><?= formatMesurement($user['weight'], 'kg') ?></dd>
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
  </div>
  <form method="POST" enctype="multipart/form-data" class="profile__change flow px-10 py-12">
    <input type="hidden" name="_request_method" value="put">
    <h3 class="fs-700 fw-600 text-accent mb-16">My account</h3>
    <div class="form-container py-4">
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="fname" id="label-fname">
          First Name
        </label>
        <input type="text" id="fname" class="input-text" name="fname" value="<?= $user['first_name'] ?>" aria-labelledby="label-fname" />
        <small class="validation-alerts">

          <?= $alerts['fname'] ?? '' ?>

        </small>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="lname" id="label-lname">
          Last Name
        </label>
        <input type="text" id="lname" class="input-text" name="lname" value="<?= $user['last_name'] ?>" aria-labelledby="label-lname" />
        <small class="validation-alerts">

          <?= $alerts['lname'] ?? '' ?>

        </small>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="username" id="label-username">
          Username
        </label>
        <input type="text" id="username" class="input-text" name="username" value="<?= $user['username'] ?>" aria-labelledby="label-username" autocomplete="off" />
        <small class="validation-alerts">

          <?= $alerts['username'] ?? '' ?>

        </small>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="email" id="label-email">
          Email
        </label>
        <input type="email" id="email" class="input-text" name="email" value="<?= $user['email'] ?>" aria-labelledby="label-email" autocomplete="off" />
        <small class="validation-alerts">

          <?= $alerts['email'] ?? '' ?>

        </small>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="nepaliDOB" id="label-dob">
          Date of Birth
        </label>
        <input type="text" id="nepaliDOB" class="ndp-nepali-calendar input-text" data-default="<?= $user['dob'] ?>" aria-labelledby="label-dob" readonly />
        <input type="hidden" id="englishDOB" name="dob" readonly />
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="height" id="label-height">
          Height (cm)
        </label>
        <input type="text" inputmode="numeric" id="height" class="input-text" name="height" value="<?= $user['height'] ?>" aria-labelledby="label-height" />
        <small class="validation-alerts">

          <?= $alerts['height'] ?? '' ?>

        </small>
      </div>
      <div class="input-container">
        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="weight" id="label-weight">
          Weight (kg)
        </label>
        <input type="text" inputmode="numeric" id="weight" class="input-text" name="weight" value="<?= $user['weight'] ?>" aria-labelledby="label-weight" />
        <small class="validation-alerts">

          <?= $alerts['weight'] ?? '' ?>

        </small>
      </div>
    </div>
    <div class="btn-container">
      <button class="a btn btn-m btn__hover-effect text-light">
        <span></span>
        Update Info
        <span></span>
      </button>
    </div>
  </form>
</section>