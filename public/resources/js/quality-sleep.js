// script.js
document.addEventListener("DOMContentLoaded", function () {
  const saveButton = document.getElementById("save-button");
  const startTimeInput = document.getElementById("start-time");
  const endTimeInput = document.getElementById("end-time");

  saveButton.addEventListener("click", function () {
    const startTime = startTimeInput.value;
    const endTime = endTimeInput.value;

    alert(`Sleep Start Time: ${startTime}\nSleep End Time: ${endTime}`);
  });
});
