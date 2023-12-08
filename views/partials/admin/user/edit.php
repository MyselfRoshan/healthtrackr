<section class="profile__section d-grid">
    <div class="profile__header px-10 py-12">
        <figure class="profile__pic mx-auto">
            <img id="profile__pic-view" src="<?= $user['profile_pic'] ?? "/resources/images/default-profile.png" ?>" alt="Profile picture" />
            <figcaption class="fs-600 fw-600 d-flex ff-expletus text-accent my-6 mx-auto">
                <?= $user['username'] ?>
            </figcaption>
        </figure>
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
                <dd><?= $user['age'] !== null && intval($user['age']) !== 0 ? "{$user['age']} years" : '-' ?></dd>
            </div>
            <div class="details d-flex my-2 text-accent">
                <dt class="text-light fw-600">Height:</dt>
                <dd><?= toFeetInches($user['height']) ?? '-' ?></dd>
            </div>
            <div class="details d-flex my-2 text-accent">
                <dt class="text-light fw-600">Weight:</dt>
                <dd><?= $user['weight'] !== null && intval($user['weight']) !== 0 ? "{$user['weight']} kg" : '-' ?></dd>
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
    <form method="POST" enctype="multipart/form-data" class="profile__change flow px-10 py-10">
        <input type="hidden" name="_request_method" value="put">
        <h3 class="fs-700 fw-600 text-accent">User account</h3>
        <div class="profile__pic">
            <img id="profile__pic" src="<?= $user['profile_pic'] ?? "/resources/images/default-profile.png" ?>" alt="Profile picture" />
            <div id="upload" class="round-right">
                <input type="file" id="profile__pic-uploader" name="profile_pic" accept=".png, .jpg, .jpeg" size="" />
                <ion-icon name="camera-outline"></ion-icon>
            </div>
            <button type="button" id="cancel" class="round-left d-none">
                <ion-icon name="close"></ion-icon>
            </button>
        </div>
        <small class="validation-alerts">

            <?= $alerts['profile_pic'] ?? '' ?>

        </small>
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
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="age" id="label-age">
                    Age
                </label>
                <input type="number" id="age" class="input-text" name="age" value="<?= $user['age'] ?>" aria-labelledby="label-age" />
                <small class="validation-alerts">

                    <?= $alerts['age'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="height" id="label-height">
                    Height (ft)
                </label>
                <input type="text" inputmode="numeric" id="height" name="height" class=" input-text" name="height" value="<?= $user['height'] ?>" aria-labelledby=" label-height">
                <small class="validation-alerts">

                    <?= $alerts['height'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="weight" id="label-weight">
                    Weight (kg)
                </label>
                <input type="number" inputmode="numeric" id="weight" class="input-text" name="weight" value="<?= $user['weight'] ?>" aria-labelledby="label-weight" />
                <small class="validation-alerts">

                    <?= $alerts['weight'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="timezone" id="label-timezone">Select Timezone:</label>
                <select id="timezone" name="timezone" class="input-text" name="timezone" aria-labelledby="label-weight">
                    <?php
                    $timezoneList = timezone_identifiers_list();
                    foreach ($timezoneList as $timezone) {
                        $selected = ($timezone === $user['timezone']) ? "selected" : "";
                        echo "<option class='text-light' value='{$timezone}' {$selected}>{$timezone}</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="toggle-container d-flex mt-4">
                <span class="text-dark-400 fw-500">
                    Admin Privilage
                </span>
                <input type="checkbox" id="send-reminder__toggle" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?> />
                <label for="send-reminder__toggle">Toggle</label>
            </div>
        </div>
        <button class="btn btn-m btn__hover-effect text-light">
            <span></span>
            Update Info
            <span></span>
        </button>
    </form>
    <form method="POST" enctype="multipart/form-data" class="password-change flow px-10 py-12">
        <input type="hidden" name="_request_method" value="patch">
        <h3 class="fs-700 fw-600 text-accent mb-16">Change Password</h3>
        <div class="input-container">
            <label class="label fs-300 fw-500 text-dark-400 fw-600" for="old-password" id="label-password">
                Old Password
            </label>
            <input type="password" id="old-password" class="input-text" name="old_password" value="" aria-labelledby="label-password" autocomplete="off" data-password />
            <ion-icon name="eye-outline" class="toggle-password fs-600 text-dark-400 ms-auto me-6 mt-9"></ion-icon>
            <small class="validation-alerts">

                <?= $alerts['old_password'] ?? '' ?>

            </small>
        </div>
        <div class="input-container">
            <label class="label fs-300 fw-500 text-dark-400 fw-600" for="new-password" id="label-password">
                New Password
            </label>
            <input type="password" id="new-password" class="input-text" name="new_password" value="" aria-labelledby="label-password" autocomplete="off" data-password />
            <ion-icon name="eye-outline" class="toggle-password fs-600 text-dark-400 ms-auto me-6 mt-9"></ion-icon>
            <small class="validation-alerts">

                <?= $alerts['new_password'] ?? '' ?>

            </small>
        </div>
        <button class="btn btn-m btn__hover-effect text-light">
            <span></span>
            Update password
            <span></span>
        </button>
    </form>
</section>