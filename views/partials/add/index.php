<header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">Add</h1>
</header>
<div class="cards mt-8 d-grid">
    <article class="card">
        <header class="card__header one">

            <?php require_svg('add/daily-exercise.svg.php') ?>

        </header>
        <div class="card__content">
            <h3 class="card__title">Daily Exercise</h3>
            <p class="card__text">Don't wish for a good body, work for it</p>
            <button class="card__btn btn btn-s one">
                <a href="/<?= $_SESSION['user']['username'] ?>/add/daily-exercise">Start now</a>
            </button>
        </div>
    </article>
    <article class="card">
        <header class="card__header four">

            <?php require_svg('add/stay-hydrated.svg.php') ?>

        </header>
        <div class="card__content">
            <h3 class="card__title">Stay Hydrated</h3>
            <p class="card__text">Keep yourself refreshed throughout the day</p>

            <button class="card__btn btn btn-s four">
                <a href="/<?= $_SESSION['user']['username'] ?>/add/stay-hydrated">Start now</a>
            </button>
        </div>
    </article>
    <article class="card">
        <header class="card__header three">

            <?php require_svg('add/balanced-nutrition.svg.php') ?>

        </header>
        <div class="card__content">
            <h3 class="card__title">Balanced Nutrition</h3>
            <p class="card__text">Nourish your body with healthy food choices</p>

            <button class="card__btn btn btn-s three">
                <a href="/<?= $_SESSION['user']['username'] ?>/add/balanced-nutrition">Start now</a>
            </button>
        </div>
    </article>
    <article class="card">
        <header class="card__header five">

            <?php require_svg('add/quality-sleep.svg.php') ?>

        </header>
        <div class="card__content">
            <h3 class="card__title">Quality Sleep</h3>
            <p class="card__text">Refresh your body and mind with good sleep</p>

            <button class="card__btn btn btn-s five">
                <a href="/<?= $_SESSION['user']['username'] ?>/add/quality-sleep">Start now</a>
            </button>
        </div>
    </article>
</div>