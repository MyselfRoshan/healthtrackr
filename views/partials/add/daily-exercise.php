<section class="daily-exercise add-wrapper">
  <header class="d-flex">
    <h1 class="ff-leauge-gothic fs-700 text-accent">
      Daily Exercise
    </h1>
    <div class="d-flex">
      <span class="text-tertiary fw-500">
        Send notification
      </span>
      <input type="checkbox" id="switch" name="exercise_notification" value="" />
      <label for="switch">Toggle</label>
    </div>
  </header>
  <!-- Get inspiration from samsung health -->
  <form id="exerciseForm" enctype="multipart/form-data" class="pt-8">
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