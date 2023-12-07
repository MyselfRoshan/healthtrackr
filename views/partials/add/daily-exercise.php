<section class="daily-exercise add-wrapper">
  <header class="d-flex">
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
  <form method="post" id="activity-form" enctype="multipart/form-data" class="pt-8">
    <label for="selectDate">Select Date:</label>
    <input type="text" id="selectDate" name="selectDate" />

    <label for="exercise">Select Exercise:</label>
    <select id="exercise" name="exercise">
      <option value="" selected aria-selected="true" disabled>
        -- Select --
      </option>
      <option value="yoga">Yoga</option>
      <option value="badminton">Badminton</option>
      <option value="jogging">Jogging</option>
      <option value="pushups">Pushups</option>
      <option value="jumping_jacks">Jumping jacks</option>
      <!-- Add more exercise options here -->
    </select><br />

    <div id="exerciseSteps">
      <!-- Exercise instructions will be populated here -->
    </div>

    <label for="targetExerciseDuration">Set Target (Min: 10 minutes):</label>
    <input type="number" id="targetExerciseDuration" name="targetExerciseDuration" value="30" />

    <label for="actualExerciseDuration">Duration (minutes):</label>
    <input type="number" id="actualExerciseDuration" name="actualExerciseDuration" value="30" />

    <button type="submit" class="btn btn-m">Save Exercise</button>
  </form>

  <div id="exerciseVideos">
    <!-- YouTube videos will be populated here -->
  </div>
</section>
<div class="notification"></div>