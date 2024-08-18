document.addEventListener("DOMContentLoaded", function() {
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');

    // Dropdown & Rotation Functionality
    function toggleSubMenu() {
        complaintsSubMenu.classList.toggle('submenu-visible');
        eme2.classList.toggle('eme2-rotate');
    }

    buttonEme2.addEventListener('click', function(event) {
        event.preventDefault();
        toggleSubMenu();
    });
});