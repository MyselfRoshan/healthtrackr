document.cookie = `timeZone=${
  Intl.DateTimeFormat().resolvedOptions().timeZone
}; SameSite=None; Secure`;
console.log(cookie.timeZone);
