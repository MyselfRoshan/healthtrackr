<!-- <section id="profile-section" class="profile__section">
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
        <div class="profile__pic">
            <img id="profile__pic" src="/resources/images/default-profile.png" alt="Profile picture" />
            <div id="upload" class="round-right">
                <input type="file" id="profile__pic-uploader" name="profile_pic" accept=".png, .jpg, .jpeg" />
                <ion-icon name="camera-outline"></ion-icon>
            </div>
            <button id="cancel" class="round-left d-none" type="submit">
                <ion-icon name="close"></ion-icon>
            </button>
            <button type="submit" id="confirm" class="round-right d-none">
                <ion-icon name="checkmark"></ion-icon>
            </button>
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
            Update Profile
            <span></span>
        </button>
    </form>
</section> -->

<section class="profile__section d-grid">
            <header class="profile__header px-10 py-12">
              <div class="profile__pic mx-auto">
                <img
                  id="profile__pic"
                  src="/resources/images/default-profile.png"
                  alt="Profile picture"
                />
                <div id="upload" class="round-right">
                  <input
                    type="file"
                    id="profile__pic-uploader"
                    name="profile_pic"
                    accept=".png, .jpg, .jpeg"
                  />
                  <ion-icon name="camera-outline"></ion-icon>
                </div>
                <button id="cancel" class="round-left d-none" type="submit">
                  <ion-icon name="close"></ion-icon>
                </button>
                <button type="submit" id="confirm" class="round-right d-none">
                  <ion-icon name="checkmark"></ion-icon>
                </button>
              </div>
              <h3 class="fs-600 fw-500 d-flex ff-expletus text-light my-6">
                hello
              </h3>
              <dl>
                <div class="details d-flex my-2 text-accent">
                  <dt class="text-light fw-600">Username:</dt>
                  <dd>Hello</dd>
                </div>
                <div class="details d-flex my-2 text-accent">
                  <dt class="text-light fw-600">Name:</dt>
                  <dd>Hello World</dd>
                </div>
                <div class="details d-flex my-2 text-accent">
                  <dt class="text-light fw-600">Email:</dt>
                  <dd>admin@mail.com</dd>
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
                  <dd>3 hours ago</dd>
                </div>
                <div class="details d-flex my-2 text-accent">
                  <dt class="text-light fw-600">Created on:</dt>
                  <dd>Tuesday 22, 2022</dd>
                </div>
              </dl>
            </header>
            <form action="" class="profile__change flow px-10 py-12">
              <h3 class="fs-600 fw-500 text-accent mb-16">My account</h3>
              <div class="form-container py-4">
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="fname"
                    id="label-fname"
                  >
                    First Name
                  </label>
                  <input
                    type="text"
                    id="fname"
                    class="input-text"
                    name="fname"
                    value="Hello"
                    aria-labelledby="label-fname"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="lname"
                    id="label-lname"
                  >
                    Last Name
                  </label>
                  <input
                    type="text"
                    id="lname"
                    class="input-text"
                    name="lname"
                    value="World"
                    aria-labelledby="label-lname"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="username"
                    id="label__username"
                  >
                    Username
                  </label>
                  <input
                    type="text"
                    id="username"
                    class="input-text"
                    name="username"
                    value="hello"
                    aria-labelledby="label-username"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="email"
                    id="label-email"
                  >
                    Email
                  </label>
                  <input
                    type="email"
                    id="email"
                    class="input-text"
                    name="email"
                    value="admin@mail.com"
                    aria-labelledby="label-email"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="password"
                    id="label-password"
                  >
                    Password
                  </label>
                  <input
                    type="password"
                    id="password"
                    class="input-text"
                    name="password"
                    value="1234!@#$Qw"
                    aria-labelledby="label-password"
                  />
                  <ion-icon
                    name="eye-outline"
                    id="toggle-password"
                    class="fs-600 text-dark-400 ms-auto me-6 mt-9"
                  ></ion-icon>
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="age"
                    id="label-age"
                  >
                    Age
                  </label>
                  <input
                    type="number"
                    id="age"
                    class="input-text"
                    name="age"
                    value="21"
                    aria-labelledby="label-age"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="height"
                    id="label-height"
                  >
                    Height
                  </label>
                  <input
                    type="number"
                    id="height"
                    class="input-text"
                    name="height"
                    value="5'4"
                    aria-labelledby="label-height"
                  />
                </div>
                <div class="input-container">
                  <label
                    class="label fs-300 fw-500 text-dark-400 fw-600"
                    for="weight"
                    id="label-weight"
                  >
                    Weight
                  </label>
                  <input
                    type="number"
                    id="weight"
                    class="input-text"
                    name="weight"
                    value="54"
                    aria-labelledby="label-weight"
                  />
                </div>
              </div>
              <button class="btn btn-m btn__hover-effect text-light">
                <span></span>
                Update Info
                <span></span>
              </button>
            </form>
          </section>