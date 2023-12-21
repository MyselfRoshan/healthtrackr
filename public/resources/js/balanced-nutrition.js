import FoodComposition from "./FoodComposition.js";
import ajax from "./ajax.js";
import Notification from "./Notification.js";

// Select DOM elements
let foodsData = {};
const selectFood = document.getElementById("food");
const selectMealType = document.getElementById("mealType");
const quantity = document.getElementById("quantity");
const targetQuantity = document.getElementById("targetQuantity");
const quantityAdd = document.querySelector(".quantity-add");
const quantityRemove = document.querySelector(".quantity-remove");
const maximumQuantityTarget = targetQuantity.max;
const minimumQuantityTarget = 0;
document.addEventListener("DOMContentLoaded", () => {
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD");
  let Food = JSON.parse(localStorage.getItem("Food")) ?? {
    [currentDate]: {
      breakfast: { name: "", targetQuantity: 1, actualQuantity: 0 },
      // dinner: { name: "", targetQuantity: 1, actualQuantity: 0 },
      // snack: { name: "", targetQuantity: 1, actualQuantity: 0 },
      // launch: { name: "", targetQuantity: 1, actualQuantity: 0 },
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

  let quantityValue = Number(quantity.textContent);
  // if (quantityValue === minimumQuantityTarget - 1)
  if (quantityValue === minimumQuantityTarget)
    quantityRemove.setAttribute("disabled", "true");
  if (quantityValue === maximumQuantityTarget - 1)
    quantityAdd.setAttribute("disabled", "true");

  fetchFoodData();

  selectMealType.addEventListener("change", e => {
    updateFoodData(selectDate.value);
    updateLocalStorage();
  });

  selectFood.addEventListener("change", e => {
    updateFoodCompositionData(e.target.value, quantity.textContent);
    updateLocalStorage();
  });

  targetQuantity.addEventListener("change", e => {
    onlyNumbers(e);
    document.getElementById("targetQuantityValue").textContent = e.target.value;
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

  quantityAdd.addEventListener("click", () => handleQuantityAction(true));
  quantityRemove.addEventListener("click", () => handleQuantityAction(false));

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
    // console.log(response);
    // console.log(await response.json());

    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> Success",
        "Exercise data saved successfully",
      );
    }
  }

  async function fetchFoodData() {
    const response = await ajax(`/resources/js/food.json`);
    foodsData = await response.json();
    if (foodsData) {
      updateFoodCompositionData(selectFood.value);
      updateFoodData(currentDate);
      updateLocalStorage();
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
        breakfast: { name: "", targetQuantity: 1, actualQuantity: 0 },
        // dinner: { name: "", targetQuantity: 1, actualQuantity: 0 },
        // snack: { name: "", targetQuantity: 1, actualQuantity: 0 },
        // launch: { name: "", targetQuantity: 1, actualQuantity: 0 },
      };
    }
    Food[selectDate.value][selectMealType.value] = {
      name: selectFood.value,
      targetQuantity: parseInt(targetQuantity.value),
      actualQuantity: parseInt(quantity.textContent),
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
          targetQuantity.value = Food[date][meal].targetQuantity;
          quantity.textContent = Food[date][meal].actualQuantity;
          updateFoodCompositionData(selectFood.value, quantity.textContent);
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

  function handleQuantityAction(increase) {
    let quantityValue = Number(quantity.textContent);

    quantityValue += increase ? 1 : -1;
    quantity.textContent = quantityValue;
    updateFoodCompositionData(selectFood.value, quantityValue);
    updateLocalStorage();
    if (increase) {
      if (quantityValue < maximumQuantityTarget) {
        quantityRemove.removeAttribute("disabled");
      }

      if (quantityValue === maximumQuantityTarget) {
        quantityAdd.setAttribute("disabled", "true");
      }
    } else {
      if (quantityValue > minimumQuantityTarget) {
        quantityAdd.removeAttribute("disabled");
      }

      if (quantityValue === minimumQuantityTarget) {
        quantityRemove.setAttribute("disabled", "true");
      }
    }
  }
});
