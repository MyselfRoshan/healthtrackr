<section class="quality-sleep add-wrapper">
  <header>
    <h1 class="ff-leauge-gothic fs-700 text-accent text-center">
      Quality Sleep
    </h1>
  </header>
  <form id="hydrationForm">
    <p class="">Select sleep time</p>
    <div class="glass-input-containers py-4">
      <label for="date-to-record">Choose Date:</label>
      <input type="date" id="date-to-record" max="<?= date('Y-m-d') ?>" min="<?= date("Y-m-d", strtotime("-1 year")) ?>" value="<?= date('Y-m-d') ?>" name="dateToRecord" />

      <label for="sleep-start-time">Start Time:</label>
      <input type="time" id="sleep-start-time" name="sleepStartTime" />

      <label for="sleep-end-time">End Time:</label>
      <input type="time" id="sleep-end-time" name="sleepEndTime" />
    </div>
    <button type="submit" class="btn btn-m mt-4">Save</button>
  </form>
</section>