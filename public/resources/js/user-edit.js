//  Toggle password to text and vice versa
const togglePasswords = document.querySelectorAll(".toggle-password");
const passwords = document.querySelectorAll("[data-password]");
togglePasswords.forEach((togglePassword, index) => {
  togglePassword.addEventListener("click", () => {
    const pskType =
      passwords[index].getAttribute("type") === "password"
        ? "text"
        : "password";
    const iconType =
      togglePassword.getAttribute("name") === "eye-outline"
        ? "eye-off-outline"
        : "eye-outline";
    passwords[index].setAttribute("type", pskType);
    togglePassword.setAttribute("name", iconType);
  });
});

const profilePicUploader = document.querySelector("#profile__pic-uploader");
const profilePic = document.querySelector("#profile__pic");
const profilePicPreview = document.querySelector("#profile__pic-view");
const cancel = document.querySelector("#cancel");
const previousProfilePic = profilePic.src;
profilePicUploader.addEventListener("change", () => {
  profilePic.src = URL.createObjectURL(profilePicUploader.files[0]);
  profilePicPreview.src = profilePic.src;
  cancel.classList.remove("d-none");
});

cancel.addEventListener("click", () => {
  profilePic.src = previousProfilePic;
  cancel.classList.add("d-none");
});

document
  .querySelector("#fname")
  .addEventListener("input", e => onlyAlphabets(e));
document
  .querySelector("#lname")
  .addEventListener("input", e => onlyAlphabets(e));

// Only letters a-z and A-z allowed
function onlyAlphabets(e) {
  let inputValue = e.target.value;
  let sanitizedValue = inputValue.replace(/[^a-zA-Z]/g, "");
  e.target.value = sanitizedValue;
}
