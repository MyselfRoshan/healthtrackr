import Notification from "./Notification.js";
import ajax from "./ajax.js";

const reminder = document.querySelector("#send-reminder__toggle");
reminder.addEventListener("click", e => {
  // const reminder.hasAttribute("checked") = reminder.hasAttribute("checked");
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

  toggleNotification();

  async function toggleNotification() {
    const response = await ajax(
      `${window.location.href}/notification`,
      "post",
      JSON.stringify({
        [reminder.name]: e.target.hasAttribute("checked"),
      }),
    );
    console.log(response);
    console.log(await response.json());
    if (response.status === 200) {
      console.log("Saved Sucessfully");
    }
  }
});
