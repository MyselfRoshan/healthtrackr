const menuToggle = document.querySelector(".menu-toggle[role = 'switch']");
const menuItems = document.querySelectorAll(".menu-item");
const menuItemsDesc = document.querySelectorAll(".menu-item__desc");
const dashboard = document.querySelector(".dashboard");
menuToggle.addEventListener("click", () => {
  dashboard.classList.toggle("menu-open");
  const profileUsername = document.querySelector(".profile__username");
  const profileRole = document.querySelector(".profile__role");
  const profileLogout = document.querySelector(".profile__logout > *");
  profileUsername.toggleAttribute("hidden");
  profileRole.toggleAttribute("hidden");
  profileLogout.toggleAttribute("hidden");
  menuItemsDesc.forEach(menuItemDesc => {
    menuItemDesc.toggleAttribute("hidden");
  });
});
