import ajax from "./ajax.js";
import Cookie from "./Cookie.js";
import exerciseInstructions from "./exercise.json" assert { type: "json" };
import Notification from "./Notification.js";
import ExerciseMetrics from "./ExerciseMetrics.js";
/**
 * TO DO use fet instead of import for exerciseInstructions as it is not supported by firefox
 */
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
  updateExerciseInstructions(selectExercise.value);
  updateExerciseMetrics();

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

  handleInputField(targetExerciseDuration, 1, 120);
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

  // Function to update exercise statistics
  function updateExerciseMetrics() {
    const exerciseMetrics = new ExerciseMetrics();
    const metValue = exerciseInstructions[selectExercise.value].metValue;
    const age = Cookie.getObj("user").age;
    const height = Cookie.getObj("user").height;
    const weight = Cookie.getObj("user").weight;
    exerciseMetrics.calculateCaloriesBurned(
      weight,
      height,
      age,
      actualExerciseDuration.value,
      metValue,
    );
    exerciseMetrics.calculateFatBurn();
    exerciseMetrics.calculateVO2Max(weight, actualExerciseDuration.value);
    exerciseMetrics.calculateExerciseIntensity(actualExerciseDuration.value);

    const calorieBurn = document.getElementById("calorieBurned");
    const fatBurn = document.getElementById("fatBurned");
    const vo2Max = document.getElementById("vo2Max");
    const intensity = document.getElementById("intensity");

    calorieBurn.innerText = `${exerciseMetrics.caloriesBurned.toFixed(2)} cal`;
    fatBurn.innerText = `${exerciseMetrics.fatBurn.toFixed(2)} cal`;
    vo2Max.innerText = `${exerciseMetrics.vo2Max.toFixed(2)}  ml/min/kg`;
    intensity.innerText = `${exerciseMetrics.intensity.toFixed(2)} cal/min`;
  }

  // Function to update exercise instructions based on the selected exercise
  function updateExerciseInstructions(selectedExercise) {
    const exerciseStepsContainer = document.getElementById("exerciseSteps");
    const exerciseVideosContainer = document.getElementById("exerciseVideos");

    const stepsList = document.createElement("ol");

    exerciseInstructions[selectedExercise].steps.forEach(instruction => {
      const stepItem = document.createElement("li");
      stepItem.classList.add("step");
      stepItem.textContent = instruction;
      stepsList.style.listStyle = "none";
      stepsList.appendChild(stepItem);
    });

    // Clear previous instructions
    exerciseStepsContainer.innerHTML = "";
    exerciseStepsContainer.classList.add("active");
    exerciseStepsContainer.appendChild(stepsList);

    /* New video list */
    // Create a new videos list
    const videosList = document.createElement("ul");

    exerciseInstructions[selectedExercise].videos.forEach(videoUrl => {
      const videoItem = document.createElement("li");

      // Extract the video ID from the YouTube URL
      const videoId = extractVideoId(videoUrl);
      const videoIframe = document.createElement("iframe");
      videoIframe.src = `https://www.youtube.com/embed/${videoId}`;
      videoIframe.allowFullscreen = true;
      videoIframe.allow =
        "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture";
      videoItem.appendChild(videoIframe);

      // Append the list item to the list
      videosList.appendChild(videoItem);
    });

    // Clear previous videos in the exerciseVideosContainer
    exerciseVideosContainer.innerHTML = "";

    // Check if the videosList is not empty
    if (videosList.children.length > 0) {
      // Append the new list to the exerciseVideosContainer
      exerciseVideosContainer.appendChild(videosList);
    } else {
      // If there are no videos, display a message
      const noVideosMessage = document.createElement("p");
      noVideosMessage.textContent = "No videos available for this exercise.";
      exerciseVideosContainer.appendChild(noVideosMessage);
    }

    // Function to extract video ID from YouTube URL
    function extractVideoId(url) {
      const regex = /[?&]v=([^?&]+)/;
      const match = url.match(regex);
      return match ? match[1] : null;
    }
  }

  // Function to fetch exercise instructions from JSON file
  function fetchExerciseInstructions() {
    selectExercise.addEventListener("change", function () {
      const selectedExercise = this.value;
      updateExerciseInstructions(selectedExercise);
      updateExerciseMetrics();
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
      updateExerciseMetrics();
      updateLocalStorage();
    });
  }

  // Function to handle date change
  function handleDateChange() {
    updateExerciseData(selectDate.value);
    updateExerciseMetrics();
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
