const inputResetPswd = document.querySelector(".input__password-reset");
inputResetPswd.addEventListener("input", () => {
  inputResetPswd.setAttribute("value", inputResetPswd.value);
  localStorage.setItem(`${inputResetPswd.id}`, inputResetPswd.value);
});
