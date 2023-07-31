<!DOCTYPE html>
<html>
<html>

<?php require_view("partials/head.php") ?>

<body>
  <main>
    <section class="hero bg-dot-pattern">
      <div class="container grid-layout">
        <div class="hero__icon bg-primary">
          <img class="hero__icon-img" alt="" src="/resources/images/logo-only.png" />
        </div>
        <h1 class="hero__heading fs-mega ff-expletus fw-700 text-accent">
          Achieve Greatness
        </h1>
        <p class="hero__txt fs-600 text-accent">
          Ready to take the first step towards a healthier, happier, and
          more energetic life? Start tracking your fitness journey now and
          dominate your goals.
        </p>
        <button class="btn btn-l fs-500 fw-500 text-light" aria-labelledby="Signup button">
          <span></span>
          <a href="/signup">
            Sign up
          </a>
          <span></span>
        </button>
        <button class="btn btn-l fs-500 fw-500 text-light" aria-labelledby="signin button">
          <span></span>
          <a href="/signin">
            Signin
          </a>
          <span></span>
        </button>
      </div>
      <!-- <div class="navigation">
          <b class="home">Home</b>
          <b class="services">Services</b>
          <b class="contact">Contact</b>
        </div> -->
    </section>

    <section class="register bg-primary">
      <article class="register__article container grid-layout">
        <div class="register__icon">

          <?php require_svg("index/register.svg.php") ?>

        </div>
        <h2 class="register__heading ff-leauge-gothic fs-900 text-accent">
          Register & Unleash Your Potential
        </h2>
        <p class="register__txt fs-500 text-dark">
          Say goodbye to mediocre health tracking and hello to a
          revolutionary approach! Create an account to unlock a world of
          personalized guidance and actionable insights.
        </p>
        <p class="register__txt fs-500 text-dark">
          Join our community of health enthusiasts and take control of your
          well-being with our easy-to-use platform. No more excuses—it’s
          time to invest n yourself.
        </p>
      </article>
    </section>
    <section class="revolution">
      <article class="revolution__article container grid-layout">
        <div class="revolution__icon"></div>
        <h2 class="revolution__heading ff-leauge-gothic fs-900 text-accent">
          Revolutionize Your Health
        </h2>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Seamless Tracking
          </h3>
          <p class="fw-500 text-dark">
            Effortlessly log meals, exercise, and more
          </p>
        </div>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Data Analysis
          </h3>
          <p class="fw-500 text-dark">
            Uncover patterns, trends, and correlations
          </p>
        </div>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Personalized Feedback
          </h3>
          <p class="fw-500 text-dark">
            Tailored recommendations based on your data
          </p>
        </div>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Email Guidance
          </h3>
          <p class="fw-500 text-dark">
            Receive helpful tips straight to your inbox
          </p>
        </div>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Goal Setting
          </h3>
          <p class="fw-500 text-dark">
            Set, track, and smash your health goals
          </p>
        </div>
        <div class="revolution__feature">
          <h3 class="revolution__subheading fw-600 text-accent fs-500">
            Continuous Progress
          </h3>
          <p class="fw-500 text-dark">
            Consistently improve and reach new heights
          </p>
        </div>
      </article>
    </section>
    <div class="get-started bg-tertiary">
      <div class="container grid-layout">
        <div class="get-started__icon">
          <?php require_svg("index/get-started.svg.php") ?>
        </div>
        <h2 class="get-started__heading ff-leauge-gothic fs-900 text-accent">
          Get Started
        </h2>
        <p class="get-started__txt fw-500 text-dark">
          What are you waiting for? Join now and let’s embark on this
          incredible journey towards optimal health together.
        </p>
        <!-- <h2 class="get-started__heading ff-leauge-gothic fs-900 text-accent">
          Set Goals
        </h2>
        <p class="get-started__txt fw-500 text-dark">
          Transform your well-being by setting measurable goals and tracking
          your progress like a champ. It's time to unlock your full health
          potential!
        </p> -->
        <div class="get-started__btn-container">
          <button class="btn btn-m fs-300 fw-700 text-light" aria-labelledby="Signup btn">
            <a href="/signup">
              Sign Up
            </a>
          </button>
          <button class="btn btn-m fs-300 fw-700 text-dark">
            Learn More
          </button>
        </div>
      </div>
    </div>
    <section class="sucess bg-yellow">
      <div class="container grid-layout">
        <h2 class="sucess__heading ff-leauge-gothic fs-900 text-accent">
          Our Success Stories
        </h2>
        <div class="sucess__image-container">
          <img class="image-container-icon" alt="" src="/resources/images/index/exercise.png" />
        </div>
        <div class="sucess__image-container">
          <img class="yoga-icon" alt="" src="/resources/images/index/yoga.png" />
        </div>
        <div class="sucess__image-container">
          <img class="image-container-icon1" alt="" src="/resources/images/index/jodgging.png" />
        </div>
        <div class="sucess__image-container">
          <img class="yoga-icon" alt="" src="/resources/images/index/food.png" />
        </div>
        <div class="sucess__image-container">
          <img class="image-container-icon2" alt="" src="/resources/images/index/nature.png" />
        </div>
        <div class="sucess__image-container">
          <img class="yoga-icon" alt="" src="/resources/images/index/buildings.png" />
        </div>
      </div>
    </section>

    <div class="inspiration bg-dot-pattern">
      <!-- <div class="container grid-layout"> -->
      <article class="inspiration__article container grid-layout">
        <h2 class="inspiration__heading ff-leauge-gothic fs-900 text-accent">
          Revitalize Your Life
        </h2>
        <div class="inspiration__txt-container">
          <p class="inspiration__txt fs-500 text-dark">
            No more living life on autopilot. Our platform offers a holistic
            approach to well-being, helping you develop a deeper
            understanding of your body and its unique needs.
          </p>
          <p class="inspiration__txt fs-500 text-dark">
            Reignite your passion for health and wellness by discovering new
            ways to transform your daily habits. Embrace a meaningful
            lifestyle change and watch as your life unfolds in unimaginable
            ways.
          </p>
          <p class="inspiration__txt fs-500 text-dark">
            The world is waiting for the best version of you. Get ready to
            unlock your full potential and unleash your inner wellness
            warrior!
          </p>
        </div>
        <div class="inspiration__icon">

          <?php require_svg("index/inspiration.svg.php") ?>
          <?php require_svg("index/inspiration1.svg.php") ?>

        </div>
      </article>
    </div>
    <footer class="footer bg-primary">
      <div class="container grid-layout">
        <div class="footer__icon">

          <?php require_svg("index/footer.svg.php") ?>

        </div>
        <p class="footer__copyright text-dark">© 2023 Health Trackr</p>
        <p class="footer__created-at">Generated on June 22, 2023</p>
      </div>
    </footer>
  </main>
</body>

</html>

</html>