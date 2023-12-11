<header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">Reminder</h1>
</header>
<div class="reminder__container d-grid">
    <!-- No Reminder -->
    <?php if (!$is_enabled) : ?>
        <div class="reminder__non mt-6">
            <div class="reminder__non-img">
                <?php require_svg("reminder/no-reminder.svg") ?>
            </div>
            <div class="message mt-16">
                Oops! It looks like you haven't set up any reminders yet.
                <br>Enable reminders on the <a class="text-secondary" href="./add">Add</a> page to stay on track!
            </div>
        </div>
    <?php endif ?>
    <?php foreach ($reminders as $reminder) : ?>

        <!-- Exercise Reminder -->
        <?php if ($reminder['activity_category'] == "0" && $reminder['is_enabled']) : ?>
            <form method="post" name="Exercise-reminder" enctype="multipart/form-data" class="reminder-card one d-grid">
                <div class="reminder-card__img">
                    <?php require_svg("reminder/exercise.svg") ?>
                </div>
                <div class="reminder-card__form">
                    <h2 class="ff-expletus text-accent fw-700 fs-700 mb-4">Exercise Reminder</h2>
                    <input type="hidden" name="_activity_id" value="0">
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="start_time" id="label-start_time">
                            Start Time
                        </label>
                        <input id="start_time" class="input-text timepicker" name="start_time" data-default="<?= $reminder['start_time'] ?>" aria-labelledby="label-start_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="end_time" id="label-end_time">
                            End Time
                        </label>
                        <input id="end_time" class="input-text timepicker" name="end_time" data-default="<?= $reminder['end_time'] ?>" aria-labelledby="label-end_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="exerciseFrequency" id="label-frequency">
                            How Often?
                        </label>
                        <input type="number" id="exerciseFrequency" class="input-text" name="frequency" value="<?= $reminder['frequency'] ?>" aria-labelledby="label-frequency" autocomplete="off" />
                    </div>
                    <button type="submit" class="btn btn-m">Update</button>
                </div>
            </form>
        <?php endif ?>
        <!-- Water Reminder -->
        <?php if ($reminder['activity_category'] == "1" && $reminder['is_enabled']) : ?>
            <form method="post" name="Water-reminder" enctype="multipart/form-data" class="reminder-card four d-grid">
                <div class="reminder-card__img">
                    <?php require_svg("reminder/water.svg") ?>
                </div>
                <div class="reminder-card__form">
                    <h2 class="ff-expletus text-accent fw-700 fs-700 mb-4">Water Reminder</h2>
                    <input type="hidden" name="_activity_id" value="1">
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="start_time" id="label-start_time">
                            Start Time
                        </label>
                        <input id="start_time" class="input-text timepicker" name="start_time" data-default="<?= $reminder['start_time'] ?>" aria-labelledby="label-start_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="end_time" id="label-end_time">
                            End Time
                        </label>
                        <input id="end_time" class="input-text timepicker" name="end_time" data-default="<?= $reminder['end_time'] ?>" aria-labelledby="label-end_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="waterFrequency" id="label-frequency">
                            How Often?
                        </label>
                        <input type="number" id="waterFrequency" class="input-text" name="frequency" value="<?= $reminder['frequency'] ?>" aria-labelledby="label-frequency" autocomplete="off" />
                    </div>
                    <button type="submit" class="btn btn-m">Update</button>
                </div>
            </form>
        <?php endif ?>

        <!-- Sleep Reminder -->
        <?php if ($reminder['activity_category'] == "3" && $reminder['is_enabled']) : ?>
            <form method="post" name="Sleep-reminder" enctype="multipart/form-data" class="reminder-card three d-grid">
                <div class="reminder-card__img">
                    <?php require_svg("reminder/sleep.svg") ?>
                </div>
                <div class="reminder-card__form">
                    <h2 class="ff-expletus text-accent fw-700 fs-700 mb-4">Sleep Reminder</h2>
                    <input type="hidden" name="_activity_id" value="3">
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="end_time" id="label-end_time">
                            Bed Time
                        </label>
                        <input id="end_time" class="input-text timepicker" name="end_time" data-default="<?= $reminder['end_time'] ?>" aria-labelledby="label-end_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="start_time" id="label-start_time">
                            Wakeup Time
                        </label>
                        <input id="start_time" class="input-text timepicker" name="start_time" data-default="<?= $reminder['start_time'] ?>" aria-labelledby="label-start_time" autocomplete="off" />
                    </div>
                    <!-- <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="sleepFrequency" id="label-frequency">
                            How Often?
                        </label>
                        <input type="number" id="sleepFrequency" class="input-text" name="frequency" value="<?= $reminder['frequency'] ?>" aria-labelledby="label-frequency" autocomplete="off" />
                    </div> -->
                    <button type="submit" class="btn btn-m">Update</button>
                </div>
            </form>
        <?php endif ?>
        <!-- Food Reminder -->
        <?php if ($reminder['activity_category'] == "2" && $reminder['is_enabled']) : ?>
            <form method="post" name="Food-reminder" enctype="multipart/form-data" class="reminder-card five d-grid">
                <div class="reminder-card__img">
                    <?php require_svg("reminder/food_v2.svg") ?>
                </div>
                <div class="reminder-card__form">

                    <h2 class="ff-expletus text-accent fw-700 fs-700 mb-4">Food Reminder</h2>
                    <input type="hidden" name="_activity_id" value="2">
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="start_time" id="label-start_time">
                            Start Time
                        </label>
                        <input id="start_time" class="input-text timepicker" name="start_time" data-default="<?= $reminder['start_time'] ?>" aria-labelledby="label-start_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="end_time" id="label-end_time">
                            End Time
                        </label>
                        <input id="end_time" class="input-text timepicker" name="end_time" data-default="<?= $reminder['end_time'] ?>" aria-labelledby="label-end_time" autocomplete="off" />
                    </div>
                    <div class="input-container">
                        <label class="label fs-300 fw-500 text-dark-400 fw-600" for="foodFrequency" id="label-frequency">
                            How Often?
                        </label>
                        <input type="number" id="foodFrequency" class="input-text" name="frequency" value="<?= $reminder['frequency'] ?>" aria-labelledby="label-frequency" autocomplete="off" />
                    </div>
                    <button type="submit" class="btn btn-m">Update</button>
                </div>
            </form>
        <?php endif ?>
    <?php endforeach ?>

</div>
<div class="notification"></div>