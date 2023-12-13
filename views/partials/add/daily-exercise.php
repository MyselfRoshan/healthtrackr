<section class="daily-exercise add-wrapper">
  <header class="d-flex pb-8">
    <h1 class="ff-leauge-gothic fs-700 text-accent">
      Daily Exercise
    </h1>
    <div class="toggle-container d-flex">
      <span class="text-tertiary fw-500">
        Send email reminder
      </span>
      <input type="checkbox" id="send-reminder__toggle" name="exercise_reminder" />
      <label for="send-reminder__toggle">Toggle</label>
    </div>
  </header>
  <!-- Get inspiration from samsung health -->
  <form method="post" id="activity-form" enctype="multipart/form-data">
    <label for="selectDate">Select Date:</label>
    <input type="text" id="selectDate" name="selectDate" />

    <label for="exercise">Select Exercise:</label>
    <select id="exercise" name="exercise">
      <?php
      $exerciseFilePath = BASE_PATH . 'public/resources/js/exercise.json';

      // Check if the file exists before proceeding
      if (file_exists($exerciseFilePath)) {
        $exercisesJson = file_get_contents($exerciseFilePath);
        $exercises = json_decode($exercisesJson, true);

        foreach ($exercises as $exerciseValue => $value) {
          $exerciseName = ucwords(str_replace('_', ' ', $exerciseValue));
          echo "<option value='{$exerciseValue}' selected>{$exerciseName}</option>";
        }
      } else {
        echo "Exercise file not found.";
      }
      ?>

    </select>

    <label for="targetExerciseDuration">Set Target Exercise Duration (Minimum :- 1 minute) (Maximum :- 120 minutes):</label>
    <input type="number" id="targetExerciseDuration" name="targetExerciseDuration" value="30" />
    <p id="targetCalorieToBeBurn"></p>

    <label for="actualExerciseDuration">Performed Exercise Duration (minutes):</label>
    <input type="number" id="actualExerciseDuration" name="actualExerciseDuration" value="30" />
    <button type="submit" class="btn btn-m">Save Exercise</button>
  </form>
</section>
<div id="exercise-stats" class="add-wrapper">
  <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Exercise Statistics</h2>
  <dl>
    <div class="exercise-info d-flex my-2 text-primary">
      <dt class="text-accent fw-700">
        Calories Burned:
      </dt>
      <dd id="calorieBurned"></dd>
    </div>
    <div class="exercise-info d-flex my-2 text-primary">
      <dt class="text-accent fw-700">
        Fat Burn:
      </dt>
      <dd id="fatBurned"></dd>
    </div>
    <div class="exercise-info d-flex my-2 text-primary">
      <dt class="text-accent fw-700">
        VO2 Max:
      </dt>
      <dd id="vo2Max"></dd>
    </div>
    <div class="exercise-info d-flex my-2 text-primary">
      <dt class="text-accent fw-700">
        Exercise Intensity:
      </dt>
      <dd id="intensity"></dd>
  </dl>
</div>

<div id="exercise-instructions" class="add-wrapper">
  <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Stepwise Instructions</h2>
  <div id="exerciseSteps">
    <!-- Exercise instructions will be populated here -->
  </div>
</div>

<div id="exercise-videos" class="add-wrapper bg-primary-800">
  <h2 class="ff-leauge-gothic fs-700 text-accent pb-8">Video Instructions</h2>
  <div id="exerciseVideos">
    <!-- YouTube videos will be populated here -->
  </div>
</div>

<div class="notification"></div>