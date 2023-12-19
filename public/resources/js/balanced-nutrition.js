import FoodComposition from "./FoodComposition.js";
import ajax from "./ajax.js";
import Notification from "./Notification.js";
import foodsData from "./food.json" assert { type: "json" };

// import Cookie from "./Cookie.js";

// Select DOM elements
const selectFood = document.getElementById("food");
const selectMealType = document.getElementById("mealType");
const quantity = document.getElementById("quantity");
document.addEventListener("DOMContentLoaded", () => {
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD");
  let Food = JSON.parse(localStorage.getItem("Food")) ?? {
    [currentDate]: {
      breakfast: { name: "", quantity: 1 },
      // dinner: { name: "", quantity: 1 },
      // snack: { name: "", quantity: 1 },
      // launch: { name: "", quantity: 1 },
    },
  };

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

  updateLocalStorage();

  selectMealType.addEventListener("change", e => {
    updateFoodData(selectDate.value);
    updateLocalStorage();
  });

  selectFood.addEventListener("change", e => {
    updateFoodCompositionData(e.target.value);
    updateLocalStorage();
  });

  updateFoodCompositionData(selectFood.value);

  quantity.addEventListener("input", e => {
    onlyNumbers(e);
    updateFoodCompositionData(selectFood.value, e.target.value);
    updateLocalStorage();
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
      n.create(
        "<ion-icon name='close-circle'></ion-icon></ion-icon> Error",
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
  });

  /* Functions */
  // Function to handle date change
  function handleDateChange() {
    updateFoodData(selectDate.value);
    updateLocalStorage();
  }

  // Function saves Exercise obj to Database
  async function saveToDatabase() {
    const response = await ajax(
      `${window.location.href}`,
      "post",
      localStorage.getItem("Food"),
    );
    console.log(response);
    // console.log(await response.json());

    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> Success",
        "Exercise data saved successfully",
      );
    }
  }

  // Function to update the displayed information for a selected food based on its quantity.
  function updateFoodCompositionData(selectedFood, quantity = 1) {
    const food = new FoodComposition(
      selectedFood,
      foodsData[selectedFood].composition_per_unit,
      foodsData[selectedFood].unit,
      quantity,
    );

    food.displayInfo();
  }

  // Function to update local storage
  function updateLocalStorage() {
    if (!Food[selectDate.value]) {
      Food[selectDate.value] = {
        breakfast: { name: "", quantity: 1 },
        // dinner: { name: "", quantity: 1 },
        // snack: { name: "", quantity: 1 },
        // launch: { name: "", quantity: 1 },
      };
    }
    Food[selectDate.value][selectMealType.value] = {
      name: selectFood.value,
      quantity: parseInt(quantity.value),
    };
    localStorage.setItem("Food", JSON.stringify(Food));
  }

  // Function to update food data based on selected date
  function updateFoodData(date) {
    if (date in Food) {
      const mealTypes = Object.keys(Food[date]);
      mealTypes.forEach(meal => {
        if (selectMealType.value === meal) {
          selectFood.value = Food[date][meal].name;
          quantity.value = Food[date][meal].quantity;
          updateFoodCompositionData(selectFood.value, quantity.value);
        }
      });
    }
  }

  // Only positive numbers 0-9 are allowed
  function onlyNumbers(event) {
    let inputValue = event.target.value;
    let sanitizedValue = inputValue.replace(/[^0-9]/g, "");
    event.target.value = sanitizedValue;
  }
});
