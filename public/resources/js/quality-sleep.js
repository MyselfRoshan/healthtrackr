import ajax from "./ajax.js";
import Notification from "./notification.js";

const selectDate = document.getElementById("select-date");
const bedTime = document.getElementById("bed-time");
const wakeupTime = document.getElementById("wakeup-time");
const sleepDuration = document.querySelector(".sleep-time");

document.addEventListener("DOMContentLoaded", function () {
  // Initial load and change event
  const currentDate = NepaliFunctions.GetCurrentBsDate("YYYY-MM-DD");

  let Sleep = JSON.parse(localStorage.getItem("Sleep")) ?? {
    [currentDate]: {
      bed: {
        hour: "22",
        minute: "00",
      },
      wakeup: {
        hour: "06",
        minute: "00",
      },
      duration: {
        hour: "8",
        minute: "00",
      },
    },
  };
  updateSleepData(currentDate);

  selectDate.value = currentDate;
  selectDate.nepaliDatePicker({
    language: "english",
    dateFormat: "YYYY-MM-DD",
    ndpYear: true,
    ndpMonth: true,
    ndpYearCount: 10,
    disableDaysBefore: 365,
    disableDaysAfter: 0,
    onChange: e => {
      if (e.bs in Sleep) {
        updateSleepData(e.bs);
      } else {
        Sleep[e.bs] = {
          bed: to24HourFormat(bedTime.value),
          wakeup: to24HourFormat(wakeupTime.value),
          duration: calculateSleepDuration(bedTime.value, wakeupTime.value),
        };

        localStorage.setItem("Sleep", JSON.stringify(Sleep));
      }
    },
  });

  // Pickatime configuration
  $(".timepicker").pickatime({
    autoclose: true,
    twelvehour: true,
    vibrate: true,
    donetext: "OK",
    afterDone: (Element, Time) => {
      const selectedDate = selectDate.value;
      if (Element[0].name === "bedTime") {
        const bedTimeValue = !Time ? bedTime.value : Time;
        Sleep[selectedDate] = {
          bed: to24HourFormat(bedTimeValue),
          wakeup: to24HourFormat(wakeupTime.value),
          duration: calculateSleepDuration(bedTimeValue, wakeupTime.value),
        };
      } else if (Element[0].name === "wakeupTime") {
        const wakeupTimeValue = !Time ? wakeupTime.value : Time;
        Sleep[selectedDate] = {
          bed: to24HourFormat(bedTime.value),
          wakeup: to24HourFormat(wakeupTimeValue),
          duration: calculateSleepDuration(bedTime.value, wakeupTimeValue),
        };
      }

      localStorage.setItem("Sleep", JSON.stringify(Sleep));
    },
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
  /* ***Functions*** */
  // Function To saves Sleep obj to Database
  async function saveToDatabase() {
    const response = await ajax(
      `${window.location.href}`,
      "post",
      localStorage.getItem("Sleep"),
    );
    console.log(response);
    // console.log(response.json());
    if (response.status === 200) {
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> Success",
        "Sleep data saved successfully",
      );
    }
  }

  // Function to format time with AM/PM
  function to12HourFormat(hours, minutes) {
    const period = hours < 12 ? "AM" : "PM";
    hours = (hours % 12 || 12).toString().padStart(2, "0");
    minutes = minutes.toString().padStart(2, "0");
    return `${hours}:${minutes}${period}`;
  }

  // Function to calculate sleep duration
  function calculateSleepDuration(bedTimeValue, wakeupTimeValue) {
    const bedTime24Hr = to24HourFormat(bedTimeValue);
    const wakeupTime24Hr = to24HourFormat(
      wakeupTimeValue ?? wakeupTime.dataset.default,
    );

    let hours =
      wakeupTime24Hr.hour > bedTime24Hr.hour
        ? wakeupTime24Hr.hour - bedTime24Hr.hour
        : wakeupTime24Hr.hour + (24 - bedTime24Hr.hour);

    let minutes = wakeupTime24Hr.minute - bedTime24Hr.minute;

    if (minutes < 0) {
      hours--;
      minutes += 60;
    }
    sleepDuration.textContent = `${hours} hours and ${minutes} minutes`;
    return { hour: hours, minute: minutes };
  }

  // Function to convert time to 24-hour format
  function to24HourFormat(timeString) {
    const [hourStr, minuteStr] = timeString.split(":");
    let [hours, minutes] = [parseInt(hourStr), parseInt(minuteStr.slice(0, 2))];

    if (timeString.includes("PM") && hours !== 12) {
      hours += 12;
    } else if (timeString.includes("AM") && hours === 12) {
      hours = 0;
    }

    return { hour: hours, minute: minutes };
  }

  // Function to update sleep data
  function updateSleepData(date) {
    if (date in Sleep) {
      bedTime.value = to12HourFormat(
        Sleep[date].bed.hour,
        Sleep[date].bed.minute,
      );
      wakeupTime.value = to12HourFormat(
        Sleep[date].wakeup.hour,
        Sleep[date].wakeup.minute,
      );

      sleepDuration.textContent = `${Sleep[date].duration.hour} hours and ${Sleep[date].duration.minute} minutes`;
    }
  }
});
