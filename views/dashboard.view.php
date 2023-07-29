<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Health Trackr</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
  <link rel="manifest" href="/site.webmanifest" />
  <!-- End of Favicon -->

  <!-- Css -->
  <link rel="stylesheet" href="/resources/css/main.css" />
  <!-- End of Css -->

  <!-- IonIcons -->
  <script defer type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script defer nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- End of IonIcons -->

  <!-- Scripts -->
  <script defer src="/resources/js/dashboardSidebar.js"></script>
  <script defer src="/resources/js/input.js"></script>
  <!-- End of Scripts -->
</head>

<body>
  <div class="dashboard">
    <div class="dashboard__menu-list bg-primary-800 d-flex" role="menu">
      <div class="menu-toggle" role="switch">
        <div class="menu-item__icon">
          <ion-icon name="menu"></ion-icon>
        </div>
        <!-- <div class="logo">
            <img src="../assets/images/logo-only.png" alt="logo" srcset="" />
          </div> -->
      </div>

      <div class="menu-item">
        <div class="menu-item__icon">
          <ion-icon name="add-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden hidden>Add</span>
      </div>
      <div class="menu-item">
        <div class="menu-item__icon">
          <ion-icon name="grid-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Overview</span>
      </div>

      <div class="menu-item">
        <div class="menu-item__icon">
          <ion-icon name="calendar-clear-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Reminder</span>
      </div>
      <div class="menu-item">
        <div class="menu-item__icon">
          <ion-icon name="flag-outline"></ion-icon>
        </div>
        <span class="menu-item__desc" hidden>Goal</span>
      </div>
      <div class="profile">
        <a href="#profile-section" class="profile__pic">
          <!-- <ion-icon name="person-circle-outline" class="fs-700"></ion-icon> -->
          <img src=/resources/icons/profile.png" alt="" />
        </a>
        <span class="profile__desc d-flex"><span class="profile__username text-accent fs-200 fw-700" hidden>Prabin</span>
          <span class="profile__role fs-200" hidden>Administrator</span></span>
        <a href="/index.html" class="profile__logout">
          <ion-icon name="log-out-outline" hidden></ion-icon>
        </a>
      </div>
    </div>
    <div class="dashboard__content">
      <div class="wrapper m-16">
        <section id="profile-section" class="profile__section">
          <header class="profile__header mb-14">
            <h2 class="mb-1 ff-expletus fw-600 fs-900 text-accent">
              My Profile
            </h2>
            <p class="text-light">Manage your profile Settings</p>
            <div class="profile__pic__section d-flex mt-6">
              <div class="profile__pic">
                <img src=/resources/icons/profile.png" alt="" />
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
      </div>
    </div>
  </div>
</body>

</html>