window.addEventListener("beforeunload", () => {
  localStorage.clear();
});

// Function that doesn't revert back the value of inputfield after losing focus
const inputTxtFields = document.querySelectorAll(".input-signup");
inputTxtFields.forEach((inputTxtField) => {
  inputTxtField.addEventListener("input", () => {
    inputTxtField.setAttribute("value", inputTxtField.value);
    localStorage.setItem(`${inputTxtField.id}`, inputTxtField.value);
  });
});

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

// Only letters a-z and A-z allowed
function onlyAlphabets(e) {
  let ASCIICode = e.which ?? e.keyCode;
  if (
    (ASCIICode >= 65 && ASCIICode <= 90) ||
    (ASCIICode >= 97 && ASCIICode <= 122)
  )
    return true;
  return false;
}
