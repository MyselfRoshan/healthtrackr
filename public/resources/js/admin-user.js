import ajax from "./ajax.js";
import Notification from "./Notification.js";

document.addEventListener("DOMContentLoaded", function () {
  const deleteBtns = document.querySelectorAll(".delete-btn");
  const editBtns = document.querySelectorAll(".edit-btn");
  const modal = document.querySelector(".modal");
  const closeModalBtn = document.querySelector("#closeModalBtn");
  const yesBtn = document.querySelector("#yesBtn");
  const noBtn = document.querySelector("#noBtn");

  noBtn.addEventListener("click", () => modal.close());
  closeModalBtn.addEventListener("click", () => modal.close());

  window.addEventListener("click", function (e) {
    if (e.target === modal) modal.close();
  });

  let userId = null;

  deleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener("click", function () {
      userId = this.getAttribute("data-user-id");
      modal.showModal();
    });
  });

  yesBtn.addEventListener("click", () => {
    if (userId) {
      fetchData(userId);
      modal.close();
      new Notification(document.querySelector(".notification")).create(
        "<ion-icon name='checkmark-circle'></ion-icon> User Deleted",
        `The user with id <span class='fs-300 text-red'>${userId}</span> has been successfully deleted.`,
        4,
        true,
      );
      setTimeout(() => location.reload(), 4000);
    }
  });

  async function fetchData(id) {
    try {
      const response = await ajax(
        `${window.location.href}/destroy`,
        "delete",
        JSON.stringify({ id: id }),
      );
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(`Error setting data:`, error);
      return null;
    }
  }
});
