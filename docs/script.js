adminBtn = document.querySelector(".admin-btn");
dealerBtn = document.querySelector(".dealer-btn");

adminBtn.addEventListener("click", () => {
  window.location.href = "./admin-login.html";
});

dealerBtn.addEventListener("click", () => {
  window.location.href = "./dealer-login.html";
});
function logout() {
  alert("You have successfully logged out");
  window.location.href = "admin-login.html";
}
