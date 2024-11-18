document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll('.sideside');
    const submenuLinks = document.querySelectorAll('#complaintsSubMenu a');
    const complaintsDropdown = document.getElementById('complaintsDropdown');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');

    // Variable to track submenu visibility
    let submenuVisible = false;

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

    // Highlight submenu items and open submenu if needed
    submenuLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        if (linkHref === activePage) {
            link.classList.add('baractive');
            complaintsDropdown.classList.remove('baractive');
            complaintsSubMenu.classList.add('submenu-visible');
            eme2.classList.add('eme2-rotate');
            submenuVisible = true;  // Set the submenu as visible
        } else {
            link.classList.remove('baractive');
        }
    });

    // Toggle submenu visibility when clicking the main dropdown button (buttonEme2)
    buttonEme2.addEventListener('click', function (event) {
        event.preventDefault();

        // Toggle submenu visibility
        submenuVisible = !submenuVisible;

        if (submenuVisible) {
            complaintsSubMenu.classList.add('submenu-visible');
            eme2.classList.add('eme2-rotate');
        } else {
            complaintsSubMenu.classList.remove('submenu-visible');
            eme2.classList.remove('eme2-rotate');
        }
    });

    // Ensure submenu doesn't close when a submenu link is clicked
    submenuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent click from bubbling up to toggle

            // Highlight the clicked link
            submenuLinks.forEach(item => item.classList.remove('baractive'));
            link.classList.add('baractive');

            // Ensure submenu remains open
            complaintsSubMenu.classList.add('submenu-visible');
            complaintsDropdown.classList.remove('baractive'); // Remove highlight from parent dropdown
        });
    });

    // Close submenu when clicking outside the dropdown button or submenu
    document.addEventListener('click', function (event) {
        if (!complaintsDropdown.contains(event.target) && !buttonEme2.contains(event.target)) {
            if (submenuVisible) {
                complaintsSubMenu.classList.remove('submenu-visible');
                eme2.classList.remove('eme2-rotate');
                submenuVisible = false;
            }
        }
    });
});
