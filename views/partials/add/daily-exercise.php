<section class="daily-exercise add-wrapper">
  <header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">
      Daily Exercise
    </h1>
  </header>
  <!-- Get inspiration from samsung health -->
  <form id="exerciseForm">
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

    <label for="startTime">Start Time:</label>
    <input type="datetime-local" id="startTime" name="startTime" min="<?= date('Y-m-d\TH:i'); ?>" step="60" required />

    <label for="duration">Duration (minutes):</label>
    <input type="number" id="duration" name="duration" value="30" min="10" max="120" required />

    <button type="submit" class="btn btn-m">Start Exercise</button>
  </form>

  <div id="exerciseVideos">
    <!-- YouTube videos will be populated here -->
  </div>
</section>