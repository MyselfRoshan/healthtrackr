<section id="addUser" class="profile__section d-grid">
    <form method="POST" enctype="multipart/form-data" class="profile__change flow px-10 py-12">
        <h3 class="fs-700 fw-600 text-accent">Add User</h3>
        <div class="profile__pic mt-10">
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
                <input type="text" id="fname" class="input-text" name="fname" aria-labelledby="label-fname" value="<?= $user['fname'] ?? '' ?>" />
                <small class="validation-alerts">

                    <?= $alerts['fname'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="lname" id="label-lname">
                    Last Name
                </label>
                <input type="text" id="lname" class="input-text" name="lname" aria-labelledby="label-lname" value="<?= $user['lname'] ?? '' ?>" />
                <small class="validation-alerts">

                    <?= $alerts['lname'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="username" id="label-username">
                    Username
                </label>
                <input type="text" id="username" class="input-text" name="username" aria-labelledby="label-username" autocomplete="off" value="<?= $user['username'] ?? '' ?>" />
                <small class="validation-alerts">

                    <?= $alerts['username'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="email" id="label-email">
                    Email
                </label>
                <input type="email" id="email" class="input-text" name="email" aria-labelledby="label-email" autocomplete="off" value="<?= $user['email'] ?? '' ?>" />
                <small class="validation-alerts">

                    <?= $alerts['email'] ?? '' ?>

                </small>
            </div>

            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="password" id="label-password">
                    Password
                </label>
                <input type="password" id="password" class="input-text" name="password" aria-labelledby="label-password" autocomplete="off" value="<?= $user['password'] ?? '' ?>" />
                <ion-icon name="eye-outline" id="toggle-password" class="fs-600 text-dark-400 ms-auto me-6 mt-9"></ion-icon>
                <small class="validation-alerts">

                    <?= $alerts['password'] ?? '' ?>

                </small>
            </div>

            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="nepaliDOB" id="label-dob">
                    Date of Birth
                </label>
                <!-- To get input from dob-nepali and provide it to dob for post request -->
                <input type="text" id="nepaliDOB" class="ndp-nepali-calendar input-text" data-default="<?= $user['dob'] ?? '' ?>" aria-labelledby="label-dob" readonly />
                <input type="hidden" id="englishDOB" name="dob" readonly />
            </div>

            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="height" id="label-height">
                    Height (cm)
                </label>
                <input type="text" inputmode="numeric" id="height" name="height" class=" input-text" name="height" aria-labelledby=" label-height" value="<?= $user['height'] ?? '' ?>">
                <small class="validation-alerts">

                    <?= $alerts['height'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="weight" id="label-weight">
                    Weight (kg)
                </label>
                <input type="text" inputmode="numeric" id="weight" class="input-text" name="weight" aria-labelledby="label-weight" value="<?= $user['weight'] ?? '' ?>" />
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
                        $selectedTimezone = $user['timezone'] ?? 'Asia/Kathmandu';
                        $selected = ($timezone === $selectedTimezone) ? "selected" : "";
                        echo "<option class='text-light' value='{$timezone}' {$selected}>{$timezone}</option>";
                    }
                    ?>

                </select>
            </div>

            <div class="toggle-container d-flex mt-4">
                <span class="text-dark-400 fw-500">
                    Admin Privilage
                </span>
                <input type="checkbox" id="send-reminder__toggle" name="is_admin" />
                <label for="send-reminder__toggle">Toggle</label>
            </div>
        </div>
        <button type="submit" class="btn btn-m btn__hover-effect text-light">
            <span></span>
            Save
            <span></span>
        </button>
    </form>
</section>