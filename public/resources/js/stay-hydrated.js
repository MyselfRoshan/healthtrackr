import ajax from "./ajax.js";
import Notification from "./Notification.js";

const glassWater = document.querySelector(".glass-water");
const glassAdd = document.querySelector(".glass-add");
const glassRemove = document.querySelector(".glass-remove");
const setGlassTarget = document.querySelector("#set-glass-target");
const glassTarget = document.querySelector(".glass-target");
const glassToIntake = document.querySelector(".glass-to-intake");
const waterToIntake = document.querySelector(".water-to-intake");
const selectDate = document.querySelector("#select-date");

const maximumGlassTarget = parseInt(setGlassTarget.getAttribute("max"));
const minimumGlassTarget = parseInt(setGlassTarget.getAttribute("min"));
const waterPerGlass = 250; // 250ml

document.addEventListener("DOMContentLoaded", () => {
  // Initial load and change event
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD");
  let Water = JSON.parse(localStorage.getItem("Water")) ?? {
    [currentDate]: {
      target: 8,
      intaked: 0,
    },
  };
  updateWaterData(currentDate);

  selectDate.value = currentDate;
  selectDate.nepaliDatePicker({
    language: "english",
    dateFormat: "YYYY/MM/DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 10,
    readOnlyInput: true,
    disableDaysBefore: 365,
    disableDaysAfter: 0,
    onChange: handleDateChange,
  });

  let glassToIntakeValue = Number(glassToIntake.textContent);
  if (glassToIntakeValue === minimumGlassTarget - 1)
    glassRemove.setAttribute("disabled", "true");
  if (glassToIntakeValue === maximumGlassTarget - 1)
    glassAdd.setAttribute("disabled", "true");

  setGlassTarget.addEventListener("input", handleSetGlassTargetChange);

  document.querySelectorAll(".input-signup").forEach(inputTxtField => {
    inputTxtField.addEventListener("input", () => {
      inputTxtField.setAttribute("value", inputTxtField.value);
      localStorage.setItem(`${inputTxtField.id}`, inputTxtField.value);
    });
  });

  // Event listener for form submission enable clicking after 5 seconds
  let canClick = true;
  document.querySelector("#activity-form").addEventListener("submit", e => {
    e.preventDefault();
    const submitButton = document.querySelector("[type=submit]");

    if (canClick) {
      // Execute your function here
      saveToDatabase();
      canClick = false;
      setTimeout(() => {
        canClick = true;
      }, 5000);
    } else {
      submitButton.disabled = true;
      const n = new Notification(document.querySelector(".notification"));
      console.log(
        n.create(
          "<ion-icon name='close-circle'></ion-icon></ion-icon> Error",
          `Wait for 5 seconds before clicking again.`,
          6,
        ),
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
  });

  glassAdd.addEventListener("click", () => handleGlassAction(true));
  glassRemove.addEventListener("click", () => handleGlassAction(false));

  /* ***Functions*** */

  // Function saves Water obj to Database
  async function saveToDatabase() {
    const response = await ajax(
      `${window.location.href}`,
      "post",
      localStorage.getItem("Water"),
    );
    console.log(response);
    // console.log(await response.json());
    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> Success",
        "Drinking Water data saved successfully",
      );
    }
  }

  function waterLevel(controller) {
    let noOfGlassTarget = parseInt(setGlassTarget.value);
    let noOfGlassToIntake = parseInt(glassToIntake.textContent);
    let percentageChange = 106 / noOfGlassTarget;
    let waveHeight = parseFloat(
      getComputedStyle(glassWater).getPropertyValue("--wave"),
    );
    let newHeight = waveHeight;

    if (controller === "increase" && noOfGlassToIntake <= noOfGlassTarget) {
      newHeight -= percentageChange;
    } else if (
      controller === "decrease" &&
      noOfGlassTarget > noOfGlassToIntake
    ) {
      newHeight += percentageChange;
    } else if (controller === "new-target") {
      newHeight = -((noOfGlassToIntake / noOfGlassTarget) * 106 + 100);
    }

    newHeight = Math.max(-206, Math.min(-100, newHeight));
    glassWater.style.setProperty("--wave", `${newHeight}%`);
  }

  function updateWaterData(date) {
    if (date in Water) {
      setGlassTarget.value = Water[date].target;
      glassToIntake.textContent = Water[date].intaked;
      glassTarget.textContent = `${setGlassTarget.value} Glass${
        setGlassTarget.value != "1" ? "es" : ""
      }`;
      waterToIntake.textContent = `(${
        parseInt(glassToIntake.textContent) * waterPerGlass
      } ml)`;
      waterLevel("new-target");
    }
  }

  function updateLocalStorage() {
    Water[selectDate.value] = {
      target: parseInt(setGlassTarget.value),
      intaked: parseInt(glassToIntake.textContent),
    };
    localStorage.setItem("Water", JSON.stringify(Water));
  }

  function handleGlassAction(increase) {
    let glassToIntakeValue = Number(glassToIntake.textContent);

    if (increase) {
      glassToIntake.textContent = glassToIntakeValue + 1;
    } else {
      glassToIntake.textContent = glassToIntakeValue - 1;
    }

    waterToIntake.textContent = `(${
      parseInt(glassToIntake.textContent) * waterPerGlass
    } ml)`;
    waterLevel(increase ? "increase" : "decrease");

    if (increase) {
      if (glassToIntakeValue < maximumGlassTarget) {
        glassRemove.removeAttribute("disabled");
      }

      if (glassToIntakeValue === maximumGlassTarget - 1) {
        glassAdd.setAttribute("disabled", "true");
      }
    } else {
      if (glassToIntakeValue > minimumGlassTarget) {
        glassAdd.removeAttribute("disabled");
      }

      if (glassToIntakeValue === minimumGlassTarget) {
        glassRemove.setAttribute("disabled", "true");
      }
    }

    updateLocalStorage();
  }

  function handleSetGlassTargetChange(e) {
    let inputValue = e.target.value;
    inputValue = inputValue.replace(/\D/g, "");
    inputValue = Math.min(50, Math.max(1, inputValue));
    e.target.value = inputValue;
    glassTarget.textContent = `${inputValue} Glass${
      inputValue !== "1" ? "es" : ""
    }`;
    glassTarget.textContent = `${setGlassTarget.value} Glass${
      parseInt(setGlassTarget.value) !== 1 ? "es" : ""
    }`;
    waterLevel("new-target");
    updateLocalStorage();
  }

  function handleDateChange() {
    updateWaterData(selectDate.value);
    updateLocalStorage();
  }
});
