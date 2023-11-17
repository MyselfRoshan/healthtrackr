import ajax from "./ajax.js";
import exerciseInstructionsObj from "./exercise.js";

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
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY-MM-DD");
  let Exercise = {
    [currentDate]: {
      name: "",
      target: 30,
      actual: 30,
    },
  };
  setExercise();
  // Initialize Exercise object from localStorage

  // Fetch and store exercise instructions
  let exerciseInstructions;

  fetchExerciseInstructions();

  selectDate.value = currentDate;
  selectDate.nepaliDatePicker({
    language: "english",
    dateFormat: "YYYY-MM-DD",
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

  // Event listener for form submission
  document.getElementById("exerciseForm").addEventListener("submit", e => {
    e.preventDefault();
    saveToDatabase();
  });

  /* ***Functions*** */
  // Function To get Exercise obj from Database or Local Storage
  async function setExercise() {
    const response = await ajax(`${window.location.href}/data`);
    Exercise =
      JSON.parse(localStorage.getItem("Exercise")) ?? (await response.json());
    updateExerciseData(currentDate);
  }

  // Function saves Exercise obj to Database
  async function saveToDatabase() {
    const response = await ajax(
      `${window.location.href}`,
      "post",
      localStorage.getItem("Exercise"),
    );
    // console.log(response);
    console.log(await response.json());
    if (response.status === 200) console.log("Saved Sucessfully");
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
    exerciseInstructions = exerciseInstructionsObj;

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
