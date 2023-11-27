<section class="quality-sleep add-wrapper">
  <header class="d-flex">
    <h1 class="ff-leauge-gothic fs-700 text-accent">
      Quality Sleep
    </h1>
    <div class="d-flex">
      <span class="text-tertiary fw-500">
        Send email reminder
      </span>
      <input type="checkbox" id="send-reminder__toggle" name="sleep_notification" value="" />
      <label for="send-reminder__toggle">Toggle</label>
    </div>
  </header>
  <form method="post" id="activity-form" enctype="multipart/form-data" class="pt-8">
    <div class=" glass-input-containers pb-4">
      <label for="select-date">Choose Date:</label>
      <input type="text" id="select-date" name="selectDate" readonly />
      <label for="bed-time">Bed Time:</label>
      <input id="bed-time" name="bedTime" class="timepicker" data-default="22:00:00" readonly />
      <label for="wakeup-time">Wakeup Time:</label>
      <input id="wakeup-time" name="wakeupTime" class="timepicker" data-default="06:00:00" readonly />
    </div>
    <p>
      Sleep time:
      <span class="sleep-time">8 hours and 0 minutes</span>
    </p>
    <button type="submit" id="save-button" class="btn btn-m mt-4">
      Save
    </button>
  </form>
</section>
<div class="notification"></div>