document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');

  menuToggle.addEventListener('click', function () {
      navMenu.classList.toggle('active');
  });
});

function toggleMenu() {
  const navMenu = document.getElementById('navMenu');
  navMenu.classList.remove('active');
}
