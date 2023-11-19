import ajax from "./ajax.js";

document.querySelector("#switch").addEventListener("click", e => {
  const notification = e.target;
  notification.value = notification.value === "on" ? "" : "on";
  toggleNotification();

  async function toggleNotification() {
    const response = await ajax(
      `${window.location.href}/notification`,
      "post",
      JSON.stringify({ [notification.name]: notification.value }),
    );
    console.log(response);
    console.log(await response.json());
    if (response.status === 200) console.log("Saved Sucessfully");
  }
});
