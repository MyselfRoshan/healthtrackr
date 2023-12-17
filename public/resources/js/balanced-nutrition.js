import Food from "./Food.js";
import ajax from "./ajax.js";
// import Cookie from "./Cookie.js";

/** TO DO
 * select specific food items according to different meal type
 * save the value to the local storage
 * cave the data to the database if saved button clicked by user
 */
import foodsData from "./food.json" assert { type: "json" };
// import Notification from "./Notification.js";

// Select DOM elements
const selectFood = document.getElementById("food");
const mealType = document.getElementById("mealType");
const quantity = document.getElementById("quantity");
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

  selectFood.addEventListener("change", e => {
    updateFoodsData(e.target.value);
    // updateExerciseMetrics();
    // updateLocalStorage();
  });

  updateFoodsData(selectFood.value);

  quantity.addEventListener("input", e => {
    onlyNumbers(e);
    updateFoodsData(selectFood.value, e.target.value);
  });

  /* Functions */
  // Function to handle date change
  function handleDateChange() {}

  // Function to update the displayed information for a selected food based on its quantity.
  function updateFoodsData(selectedFood, quantity = 1) {
    const food = new Food(
      selectedFood,
      foodsData[selectedFood].composition_per_unit,
      foodsData[selectedFood].unit,
      quantity,
    );

    food.displayInfo();
  }

  // Only positive numbers 0-9 are allowed
  function onlyNumbers(event) {
    let inputValue = event.target.value;
    let sanitizedValue = inputValue.replace(/[^0-9]/g, "");
    event.target.value = sanitizedValue;
  }
});
