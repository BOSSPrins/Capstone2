document.addEventListener("DOMContentLoaded", function () {
  const sidebarLinks = document.querySelectorAll('.sideside');
  const submenuLinks = document.querySelectorAll('#complaintsSubMenu a');
  const complaintsDropdown = document.getElementById('complaintsDropdown');
  const complaintsSubMenu = document.getElementById('complaintsSubMenu');
  const buttonEme2 = document.querySelector('.buttonEme2');
  const eme2 = buttonEme2.querySelector('.eme2');

  // Get the current page URL
  const activePage = window.location.pathname.split("/").pop();

  // Highlight the active sidebar link based on the current page
  sidebarLinks.forEach(link => {
      const linkHref = link.getAttribute('href');
      if (linkHref === activePage) {
          link.classList.add('baractive');
      } else {
          link.classList.remove('baractive');
      }
  });

  // Highlight submenu items but remove highlight from parent item (complaintsDropdown)
  submenuLinks.forEach(link => {
      const linkHref = link.getAttribute('href');
      if (linkHref === activePage) {
          link.classList.add('baractive'); // Highlight the active submenu item

          // Keep submenu open but remove highlight from the parent
          complaintsDropdown.classList.remove('baractive');
          complaintsSubMenu.classList.add('submenu-visible'); // Ensure submenu remains open
          eme2.classList.add('eme2-rotate'); // Rotate the arrow to indicate submenu is open
      } else {
          link.classList.remove('baractive');
      }
  });

  // Toggle submenu visibility only when clicking the main dropdown button
  buttonEme2.addEventListener('click', function (event) {
      event.preventDefault();
      complaintsSubMenu.classList.toggle('submenu-visible');
      eme2.classList.toggle('eme2-rotate');
  });

  // Ensure submenu doesn't close when a submenu link is clicked
  submenuLinks.forEach(link => {
      link.addEventListener('click', function (event) {
          event.stopPropagation(); // Prevent click from bubbling up to toggle

          // Set active states based on the clicked submenu item
          submenuLinks.forEach(item => item.classList.remove('baractive'));
          link.classList.add('baractive');
          complaintsSubMenu.classList.add('submenu-visible'); // Ensure submenu remains open

          // Remove highlight from the parent item (complaintsDropdown)
          complaintsDropdown.classList.remove('baractive');
      });
  });

  // Close submenu when clicking outside the dropdown button
  document.addEventListener('click', function (event) {
      if (!complaintsDropdown.contains(event.target) && !buttonEme2.contains(event.target)) {
          complaintsSubMenu.classList.remove('submenu-visible');
          eme2.classList.remove('eme2-rotate');
      }
  });
});
