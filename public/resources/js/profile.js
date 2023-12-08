const profilePicUploader = document.querySelector("#profile__pic-uploader");
const profilePic = document.querySelector("#profile__pic");
const upload = document.querySelector("#upload");
const cancel = document.querySelector("#cancel");
const confirm = document.querySelector("#confirm");
const previousProfilePic = profilePic.src;
profilePicUploader.addEventListener("change", () => {
  profilePic.src = URL.createObjectURL(profilePicUploader.files[0]);
  cancel.classList.remove("d-none");
  confirm.classList.remove("d-none");
  upload.classList.add("d-none");
});

cancel.addEventListener("click", () => {
  profilePic.src = previousProfilePic;
  cancel.classList.add("d-none");
  confirm.classList.add("d-none");
  upload.classList.remove("d-none");
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
