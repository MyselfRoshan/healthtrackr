import ajax from "./ajax.js";
import exerciseInstructions from "./exercise.js";
import Notification from "./Notification.js";

// Select DOM elements
const selectExercise = document.getElementById("exercise");
const targetExerciseDuration = document.getElementById(
  "targetExerciseDuration",
);
const actualExerciseDuration = document.getElementById(
  "actualExerciseDuration",
);

// Initialize exercise instructions when the page loads
document.addEventListener("DOMContentLoaded", () => {
  // Function to initialize the page

  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD");
  let Exercise = JSON.parse(localStorage.getItem("Exercise")) ?? {
    [currentDate]: {
      name: "",
      target: 30,
      actual: 30,
    },
  };
  updateExerciseData(currentDate);
  fetchExerciseInstructions();
  updateCalorieBurn();

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

  handleInputField(targetExerciseDuration, 10, 120);
  handleInputField(actualExerciseDuration, 0, 120);

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

  /* ***Functions*** */

  // Function saves Exercise obj to Database
  async function saveToDatabase() {
    const response = await ajax(
      `${window.location.href}`,
      "post",
      localStorage.getItem("Exercise"),
    );
    console.log(response);
    // console.log(response.json());
    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> Success",
        "Exercise data saved successfully",
      );
    }
  }

  // Function to update calorie burn
  function updateCalorieBurn() {
    const targetCalorieToBeBurn = document.getElementById(
      "targetCalorieToBeBurn",
    );
    const actualCalorieBurned = document.getElementById("actualCalorieBurned");
    targetCalorieToBeBurn.innerText =
      parseFloat(
        exerciseInstructions[selectExercise.value].calorieBurnPerMinute,
      ) * parseFloat(targetExerciseDuration.value);
    actualCalorieBurned.innerText =
      parseFloat(
        exerciseInstructions[selectExercise.value].calorieBurnPerMinute,
      ) * parseFloat(actualExerciseDuration.value);
  }

  // Function to update calorie burn
  function calculateFatBurn(metValue, weightKg, durationMinutes) {
    const durationHours = durationMinutes / 60;
    const totalCaloriesBurned = metValue * weightKg * durationHours;
    const fatBurnPercentage = metValue < 5 ? 0.5 : 0.3; // Adjust based on intensity
    const fatBurn = totalCaloriesBurned * fatBurnPercentage;
    return fatBurn;
  }

  // Function to update exercise instructions based on the selected exercise
  function updateExerciseInstructions(selectedExercise) {
    const exerciseStepsContainer = document.getElementById("exerciseSteps");
    const exerciseVideosContainer = document.getElementById("exerciseVideos");

    const stepsList = document.createElement("ol");
    const header = document.createElement("li");
    header.textContent = "Instructions:";
    header.classList.add("fs-500");
    stepsList.appendChild(header);

    exerciseInstructions[selectedExercise].steps.forEach(instruction => {
      const stepItem = document.createElement("li");
      stepItem.classList.add("step", "flow");
      stepItem.textContent = instruction;
      stepsList.style.listStyle = "none";
      stepsList.appendChild(stepItem);
    });

    // Clear previous instructions
    exerciseStepsContainer.innerHTML = "";
    exerciseStepsContainer.classList.add("active");
    exerciseStepsContainer.appendChild(stepsList);

    const videosList = document.createElement("ul");
    exerciseInstructions[selectedExercise].videos.forEach(videoUrl => {
      const videoItem = document.createElement("li");
      const videoLink = document.createElement("a");
      videoLink.href = videoUrl;
      videoLink.textContent = "Watch Video";
      videoItem.appendChild(videoLink);
      videosList.appendChild(videoItem);
    });

    exerciseVideosContainer.innerHTML = ""; // Clear previous videos
    exerciseVideosContainer.appendChild(videosList);
  }

  // Function to fetch exercise instructions from JSON file
  function fetchExerciseInstructions() {
    selectExercise.addEventListener("change", function () {
      const selectedExercise = this.value;
      updateExerciseInstructions(selectedExercise);
      updateLocalStorage();
    });
  }

  // Function to handle input field updates
  function handleInputField(inputField, min, max) {
    inputField.addEventListener("input", e => {
      let inputValue = e.target.value;
      inputValue = inputValue.replace(/\D/g, "");
      inputValue = Math.min(max, Math.max(min, inputValue));
      e.target.value = inputValue;
      updateCalorieBurn();
      updateLocalStorage();
    });
  }

  // Function to handle date change
  function handleDateChange() {
    updateExerciseData(selectDate.value);
    updateLocalStorage();
  }

  // Function to update local storage
  function updateLocalStorage() {
    Exercise[selectDate.value] = {
      name: selectExercise.value,
      target: parseInt(targetExerciseDuration.value),
      actual: parseInt(actualExerciseDuration.value),
    };
    localStorage.setItem("Exercise", JSON.stringify(Exercise));
  }

  // Function to update exercise data based on selected date
  function updateExerciseData(date) {
    if (date in Exercise) {
      selectExercise.value = Exercise[date].name;
      targetExerciseDuration.value = Exercise[date].target;
      actualExerciseDuration.value = Exercise[date].actual;
      updateExerciseInstructions(selectExercise.value);
    }
  }
});
