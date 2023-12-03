<header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">Reminder</h1>
</header>
<div class="reminder-container">

    <div class="reminder-card one exercise d-grid">
        <div class="reminder-card__img">
            <?php require_svg("reminder/exercise.svg") ?>
        </div>
        <div class="reminder-card__form">
            <h2>Exercise Reminder</h2>
            <label for="start-time-exercise">Start Time:</label>
            <input type="time" class="start-time">
            <label for="end-time-exercise">End Time:</label>
            <input type="time" class="end-time">
            <label for="frequency-exercise">Frequency:</label>
            <input type="number" class="frequency" min="1">
            <button class="update-btn">Update</button>
        </div>
    </div>

    <div class="reminder-card four water d-grid">
        <div class="reminder-card__img">
            <?php require_svg("reminder/water.svg") ?>
        </div>
        <div class="reminder-card__form">
            <h2>Water Reminder</h2>
            <label for="start-time-water">Start Time:</label>
            <input type="time" class="start-time">
            <label for="end-time-water">End Time:</label>
            <input type="time" class="end-time">
            <label for="frequency-water">Frequency:</label>
            <input type="number" class="frequency" min="1">
            <button class="update-btn">Update</button>
        </div>
    </div>

    <div class="reminder-card three sleep d-grid">
        <div class="reminder-card__img">
            <?php require_svg("reminder/sleep.svg") ?>
        </div>
        <div class="reminder-card__form">
            <h2>Sleep Reminder</h2>
            <label for="start-time-water">Start Time:</label>
            <input type="time" class="start-time">
            <label for="end-time-water">End Time:</label>
            <input type="time" class="end-time">
            <label for="frequency-water">Frequency:</label>
            <input type="number" class="frequency" min="1">
            <button class="update-btn">Update</button>
        </div>
    </div>

    <div class="reminder-card five food d-grid">
        <div class="reminder-card__img">
            <?php require_svg("reminder/food_v2.svg") ?>
        </div>
        <div class="reminder-card__form">
            <h2 class="ff-expletus text-accent fw-700 fs-700 mb-4">Food Reminder</h2>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="start-time" id="label-start-time">
                    Start Time
                </label>
                <input id="start-time" class="input-text timepicker" name="start-time" value="" aria-labelledby="label-start-time" autocomplete="off" />
                <small class="validation-alerts">

                    <?= $alerts['start-time'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="end-time" id="label-end-time">
                    End Time
                </label>
                <input id="end-time" class="input-text timepicker" name="end-time" value="" aria-labelledby="label-end-time" autocomplete="off" />
                <small class="validation-alerts">

                    <?= $alerts['end-time'] ?? '' ?>

                </small>
            </div>
            <div class="input-container">
                <label class="label fs-300 fw-500 text-dark-400 fw-600" for="frequency" id="label-frequency">
                    Frequency
                </label>
                <input type="number" id="frequency" class="input-text" name="frequency" value="" aria-labelledby="label-frequency" autocomplete="off" />
                <small class="validation-alerts">

                    <?= $alerts['frequency'] ?? '' ?>

                </small>
            </div>
            <button class="btn">Update</button>
        </div>
    </div>
</div>