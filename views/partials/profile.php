<section id="profile-section" class="profile__section">
    <header class="profile__header mb-14">
        <h2 class="mb-1 ff-expletus fw-600 fs-900 text-accent">
            My Profile
        </h2>
        <p class="text-light">Manage your profile Settings</p>
        <div class="profile__pic__section d-flex mt-6">
            <div class="profile__pic">
                <img src="/resources/images/default-profile.png" alt="" />
            </div>
            <div class="profile__pic-btns">
                <button class="btn btn-m btn__hover-effect mb-3 text-accent">
                    <span></span>
                    Update Picture
                    <span></span>
                </button>
                <button class="btn btn-m btn__outline">
                    <span></span>
                    <span>
                        <ion-icon name="trash"></ion-icon>
                        Delete
                    </span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    <form action="" class="profile__change flow">
        <h3 class="ff-expletus fs-700 fw-700 text-accent">
            Change User Information Here
        </h3>
        <div class="name">
            <div class="input-signup__container">
                <input type="text" id="fname" class="input-text input-signup" name="fname" value="" aria-labelledby="label-fname" />
                <label class="label fs-300 fw-500 d-flex" for="fname" id="label-fname">
                    <span class="label__text text-dark-400">First Name</span>
                </label>
            </div>
            <div class="input-signup__container">
                <input type="text" id="lname" class="input-text input-signup" name="lname" value="" aria-labelledby="label-lname" />
                <label class="label fs-300 fw-500 d-flex" for="lname" id="label-lname">
                    <span class="label__text text-dark-400">Last Name</span>
                </label>
            </div>
        </div>
        <div class="input-signup__container">
            <input type="text" id="username" class="input-text input-signup" name="username" value="" aria-labelledby="label-username" />
            <label class="label fs-300 fw-500 d-flex" for="username" id="label__username">
                <span class="label__text text-dark-400">Username</span>
            </label>
        </div>
        <div class="input-signup__container">
            <input type="email" id="email" class="input-text input-signup" name="email" value="" aria-labelledby="label-email" />
            <label class="label fs-300 fw-500 d-flex" for="email" id="label-email">
                <span class="label__text text-dark-400">Email</span>
            </label>
        </div>
        <div class="input-signup__container">
            <input type="password" id="password" class="input-text input-signup" name="password" value="" aria-labelledby="label-password" />
            <label class="label fs-300 fw-500 d-flex" for="password" id="label-password">
                <span class="label__text text-dark-400">Password</span>
            </label>
            <ion-icon name="eye-outline" id="toggle-password" class="fs-600 text-dark-400 my-auto ms-auto me-6"></ion-icon>
        </div>
        <button class="btn btn-m btn__hover-effect text-light">
            <span></span>
            Update Info
            <span></span>
        </button>
    </form>
</section>