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
