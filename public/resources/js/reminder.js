import Notification from "./Notification.js";
import ajax from "./ajax.js";

document.addEventListener("DOMContentLoaded", () => {
  initializeTimepickers();
  initializeReminderForms();
  handleInputField("#exerciseFrequency", 10);
  handleInputField("#waterFrequency", 20);
  handleInputField("#foodFrequency", 6);
});

function initializeTimepickers() {
  $(".timepicker").pickatime({
    autoclose: true,
    twelvehour: true,
    vibrate: true,
    donetext: "OK",
  });
}

function initializeReminderForms() {
  document.querySelectorAll(".reminder-card").forEach(form => {
    let canClick = true;
    form.addEventListener("submit", e => {
      e.preventDefault();
      const submitButton = form.lastElementChild.lastElementChild;

      if (canClick) {
        saveToDatabase(form, submitButton);
        canClick = false;
        setTimeout(() => {
          canClick = true;
        }, 5000);
      } else {
        handleClickDelay(submitButton);
      }
    });
  });
}

function handleClickDelay(submitButton) {
  submitButton.disabled = true;
  const n = new Notification(document.querySelector(".notification"));
  n.create(
    "<ion-icon class='fs-500' name='close-circle'></ion-icon> Error",
    `Wait for 5 seconds before clicking again.`,
    6,
  );
  let countdown = 4;
  const countdownInterval = setInterval(() => {
    n.updateDescription(
      `Wait for ${countdown} second${
        countdown === 1 ? "" : "s"
      } before clicking again.`,
    );
    countdown--;

    if (countdown < 0) {
      clearInterval(countdownInterval);
      submitButton.disabled = false;
    }
  }, 1000);
}

async function saveToDatabase(form, submitButton) {
  const formData = new FormData(form, submitButton);
  const formDataObject = {};

  formData.forEach(function (value, key) {
    formDataObject[key] = value;
  });
  try {
    const response = await ajax(
      `${window.location.href}`,
      "patch",
      JSON.stringify(formDataObject),
    );
    // console.log(response);
    // console.log(await response.json());
    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon class='fs-500' name='checkmark-circle'></ion-icon> Success",
        `${form.name.replace("-", " ")} updated successfully`,
        3,
      );
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

function handleInputField(inputFieldId, max, min = 1) {
  const inputField = document.querySelector(inputFieldId);
  if (inputField) {
    inputField.addEventListener("input", e => {
      let inputValue = e.target.value;
      inputValue = inputValue.replace(/\D/g, "");
      inputValue = Math.min(max, Math.max(min, inputValue));
      e.target.value = inputValue;
    });
  }
}

// document.addEventListener('DOMContentLoaded', function () {window.setTimeout(document.querySelector('svg').classList.add('animated'),1000);})
