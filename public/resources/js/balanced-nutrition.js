import Food from "./Food.js";
import ajax from "./ajax.js";
// import Cookie from "./Cookie.js";
import foodsData from "./food.json" assert { type: "json" };
// import Notification from "./Notification.js";

// Select DOM elements
const selectFood = document.getElementById("food");
document.addEventListener("DOMContentLoaded", () => {
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD");
  let Exercise = JSON.parse(localStorage.getItem("Food")) ?? {};
  //   {
  //     [currentDate]: {
  //       name: "",
  //       target: 30,
  //       actual: 30,
  //     },
  //   };

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

  selectFood.addEventListener("change", function () {
    const selectedExercise = this.value;
    updateFoodsData(this.value);
    // updateExerciseMetrics();
    // updateLocalStorage();
  });
  /* Functions */
  //   console.log(foodsData);
  // Function to handle date change
  function handleDateChange() {
    console.log("hi");
  }

  const selectedFood = selectFood.value; // Change this to the food you want to display
  updateFoodsData(selectedFood);

  document.getElementById("serving").addEventListener("change", e => {
    console.log(e.target.value);
    const food = new Food(
      selectedFood,
      foodsData[selectedFood].composition_per_unit,
      foodsData[selectedFood].unit,
    );
    console.log(food.calculateComposition(e.target.value));
    food.displayInfo();
  });

  function updateFoodsData(selectedFood) {
    const food = new Food(
      selectedFood,
      foodsData[selectedFood].composition_per_unit,
      foodsData[selectedFood].unit,
    );

    food.displayInfo();
  }
});
