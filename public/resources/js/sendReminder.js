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

  const isReminderOn = reminder.hasAttribute("checked");
  const reminderStatus = isReminderOn ? "ON" : "OFF";
  const reminderIcon = isReminderOn ? "" : "off-";

  const reminderMessage = isReminderOn
    ? `Click <a class='text-primary' href='../reminder'>here</a> to customize your reminder settings.`
    : `Enable reminders to stay updated on important information.`;

  const reminderHead = `<ion-icon size="large" name="notifications-${reminderIcon}circle-outline"></ion-icon> Reminders are turned ${reminderStatus}`;

  const n = new Notification(document.querySelector(".notification"));
  n.create(reminderHead, reminderMessage, 5);

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
