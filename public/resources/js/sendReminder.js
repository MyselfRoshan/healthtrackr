// import Notification from "./Notification.js";
// import ajax from "./ajax.js";

// const reminder = document.querySelector("#send-reminder__toggle");
// document.addEventListener("DOMContentLoaded", () => {
//   // Retrieve Reminder data from local storage
//   const storedReminder = JSON.parse(localStorage.getItem("Reminder")) || {};
//   for (const [name, value] of Object.entries(storedReminder)) {
//     const reminderButton = document.querySelector(`[name="${name}"]`);

//     if (reminderButton) reminderButton.toggleAttribute("checked", value);
//   }

//   reminder.addEventListener("click", e => {
//     reminder.toggleAttribute("checked");
//     const reminderMessage = `Your email reminder is turned ${
//       reminder.hasAttribute("checked") ? "ON" : "OFF"
//     }`;

//     const n = new Notification(document.querySelector(".notification"));
//     n.create(
//       "<ion-icon name='checkmark-circle'></ion-icon> Success",
//       reminderMessage,
//       2,
//     );

//     toggleNotification();

//     async function toggleNotification() {
//       let Reminder = JSON.parse(localStorage.getItem("Reminder")) ?? {};
//       Reminder = {
//         ...Reminder,
//         [reminder.name]: e.target.hasAttribute("checked"),
//       };
//       localStorage.setItem("Reminder", JSON.stringify(Reminder));
//       const response = await ajax(
//         `${window.location.href}/notification`,
//         "post",
//         JSON.stringify(Reminder),
//       );
//       console.log(response);
//       console.log(await response.json());
//       if (response.status === 200) {
//         console.log("Saved Sucessfully");
//       }
//     }
//   });
// });

import Notification from "./Notification.js";
import ajax from "./ajax.js";

document.addEventListener("DOMContentLoaded", handleDOMContentLoaded);

function handleDOMContentLoaded() {
  const storedReminder = JSON.parse(localStorage.getItem("Reminder")) || {};
  for (const [name, value] of Object.entries(storedReminder)) {
    const reminderButton = document.querySelector(`[name="${name}"]`);
    if (reminderButton) reminderButton.toggleAttribute("checked", value);
  }

  const reminder = document.querySelector("#send-reminder__toggle");
  reminder.addEventListener("click", handleReminderClick);
}

async function handleReminderClick() {
  const reminder = document.querySelector("#send-reminder__toggle");
  reminder.toggleAttribute("checked");

  const reminderMessage = `Your email reminder is turned ${
    reminder.hasAttribute("checked") ? "ON" : "OFF"
  }`;

  const n = new Notification(document.querySelector(".notification"));
  n.create(
    "<ion-icon name='checkmark-circle'></ion-icon> Success",
    reminderMessage,
    2,
  );

  const Reminder = {
    ...(JSON.parse(localStorage.getItem("Reminder")) || {}),
    [reminder.name]: reminder.hasAttribute("checked"),
  };

  localStorage.setItem("Reminder", JSON.stringify(Reminder));

  const response = await ajax(
    `${window.location.href}/notification`,
    "post",
    JSON.stringify(Reminder),
  );

  // console.log(response);
  // console.log(await response.json());

  if (response.status === 200) {
    console.log("Saved Successfully");
  }
}
