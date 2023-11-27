import Notification from "./Notification.js";
import ajax from "./ajax.js";

document
  .querySelector("#send-reminder__toggle")
  .addEventListener("click", e => {
    const notification = e.target;

    notification.value = notification.value === "on" ? "" : "on";

    const notificationMessage =
      notification.value === "on"
        ? "Your notification are turned ON"
        : "Your notification are turned OFF";

    const n = new Notification(document.querySelector(".notification"));
    n.create(
      "<ion-icon name='checkmark-circle'></ion-icon> Success",
      notificationMessage,
      2,
    );

    toggleNotification();

    async function toggleNotification() {
      const response = await ajax(
        `${window.location.href}/notification`,
        "post",
        JSON.stringify({ [notification.name]: notification.value }),
      );
      console.log(response);
      console.log(await response.json());
      if (response.status === 200) {
        console.log("Saved Sucessfully");
      }
    }
  });
