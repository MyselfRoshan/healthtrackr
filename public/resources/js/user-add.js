//  Toggle password to text and vice versa
const togglePassword = document.querySelector("#toggle-password");
const password = document.querySelector("#password");
togglePassword.addEventListener("click", () => {
  const pskType =
    password.getAttribute("type") === "password" ? "text" : "password";
  const iconType =
    togglePassword.getAttribute("name") === "eye-outline"
      ? "eye-off-outline"
      : "eye-outline";
  password.setAttribute("type", pskType);
  togglePassword.setAttribute("name", iconType);
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
