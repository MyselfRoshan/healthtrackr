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

// const dateOfBirth = document.querySelector("#age");
const dateOfBirth = document.querySelector("#nepaliDOB");
const currentYear = NepaliFunctions.GetCurrentBsYear("YYYY/MM/DD");
const maxDOBYear = currentYear - 80;
const minDOBYear = currentYear - 10;
const minDOBMonthAndDay =
  NepaliFunctions.GetCurrentBsDate("YYYY/MM/DD").substring(4);
const noOfDaysInMinDOBYear = NepaliFunctions.GetDaysInBsMonth(minDOBYear, 12);
dateOfBirth.value = NepaliFunctions.AD2BS(
  dateOfBirth.getAttribute("data-default"),
  "YYYY-MM-DD",
  "YYYY/MM/DD",
);

dateOfBirth.nepaliDatePicker({
  language: "english",
  dateFormat: "YYYY/MM/DD",
  ndpYear: true,
  ndpMonth: true,
  disableBefore: `${maxDOBYear}/01/01`,
  disableAfter: `${minDOBYear}${minDOBMonthAndDay}`,
  readOnlyInput: true,
  ndpEnglishInput: "englishDOB",
});

document
  .querySelector("#height")
  .addEventListener("input", e => onlyNumbers(e));
document
  .querySelector("#weight")
  .addEventListener("input", e => onlyNumbers(e));
document
  .querySelector("#fname")
  .addEventListener("input", e => onlyAlphabets(e));
document
  .querySelector("#lname")
  .addEventListener("input", e => onlyAlphabets(e));

// Only letters a-z and A-z are allowed
function onlyAlphabets(e) {
  let inputValue = e.target.value;
  let sanitizedValue = inputValue.replace(/[^a-zA-Z]/g, "");
  e.target.value = sanitizedValue;
}

// Only positive numbers 0-9 are allowed
function onlyNumbers(e) {
  let inputValue = e.target.value;
  let sanitizedValue = inputValue.replace(/[^0-9]/g, "");
  e.target.value = sanitizedValue;
}
