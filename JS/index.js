document.addEventListener("DOMContentLoaded", function () {
  const hiddenHeader = document.querySelector('.hiddenHeader');
  const showHeaderOffset = document.querySelector('.HeaderWithLogo').offsetHeight;

  window.addEventListener('scroll', function () {
      if (window.scrollY > showHeaderOffset) {
          hiddenHeader.classList.add('visible');
      } else {
          hiddenHeader.classList.remove('visible');
      }
  });
});