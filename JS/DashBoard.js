// Modal functionality (unchanged)
const profModal = document.getElementById("profileModal");
const profModalBtn = document.getElementById("myProfileBtn");
const spanEkis = document.getElementsByClassName("closeProf")[0];

profModalBtn.onclick = function() {
    profModal.style.display = "block";
    const sidebarLinks = document.querySelectorAll(".profileSidebar a");
    sidebarLinks.forEach(function(link) {
        link.classList.remove("active");
    });
}

spanEkis.onclick = function() {
    profModal.style.display = "none";
    const pages = document.getElementsByClassName("page");
    for(var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("activeProfModal");
    }
}

function openPage(pageName) {
    const pages = document.getElementsByClassName("page");
    for (var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("activeProfModal");
    }
    document.getElementById(pageName).classList.add("activeProfModal");
}



//FUNCTION SA SUB-SIDEBAR 
// document.addEventListener("DOMContentLoaded", function() {
//     // Get references to necessary elements
//     const sidebarLinks = document.querySelectorAll('.sideside'); 
//     const submenuLinks = document.querySelectorAll('#complaintsSubMenu a'); 
//     const complaintsDropdown = document.getElementById('complaintsDropdown'); 
//     const complaintsSubMenu = document.getElementById('complaintsSubMenu'); 
//     const buttonEme2 = document.querySelector('.buttonEme2'); 
//     const eme2 = buttonEme2.querySelector('.eme2'); 
    
//     // Function to toggle submenu visibility
//     function toggleSubMenu() {
//         // If submenu is being toggled off, remove active state from submenu
//         if (complaintsSubMenu.classList.contains('submenu-visible')) {
//             submenuLinks.forEach(item => item.classList.remove('baractive')); 
//         }

//         // Toggle submenu visibility
//         complaintsSubMenu.classList.toggle('submenu-visible');
//         eme2.classList.toggle('eme2-rotate');
//     }
    
//     // Handle the "Manage Complaints" submenu toggle
//     buttonEme2.addEventListener('click', function(event) {
//         event.preventDefault();
//         toggleSubMenu();
//     });

//     // Handle the active state for the sidebar items (main items)
//     sidebarLinks.forEach(link => {
//         link.addEventListener('click', function() {
//             // Remove 'baractive' class from all sidebar items
//             sidebarLinks.forEach(item => item.classList.remove('baractive'));
//             // Add 'baractive' class to the clicked sidebar item
//             link.classList.add('baractive');
//         });
//     });

//     // Handle the active state for the submenu items (under "Manage Complaints")
//     submenuLinks.forEach(link => {
//         link.addEventListener('click', function(event) {
//             event.preventDefault();  // Prevent the default action if it’s just a placeholder link

//             // Remove 'baractive' class from the parent sidebar item ("Manage Complaints")
//             complaintsDropdown.classList.remove('baractive');

//             // Remove active state from all submenu items
//             submenuLinks.forEach(item => item.classList.remove('baractive'));
//             // Add 'baractive' class to the clicked submenu item
//             link.classList.add('baractive');
//         });
//     });
// });


document.addEventListener("DOMContentLoaded", function() {
    const sidebarLinks = document.querySelectorAll('.sideside'); 
    const submenuLinks = document.querySelectorAll('#complaintsSubMenu a'); 
    const complaintsDropdown = document.getElementById('complaintsDropdown'); 
    const complaintsSubMenu = document.getElementById('complaintsSubMenu'); 
    const buttonEme2 = document.querySelector('.buttonEme2'); 
    const eme2 = buttonEme2.querySelector('.eme2'); 

    // Toggle submenu visibility without affecting complaintsDropdown highlight
    buttonEme2.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation(); // Prevent event from reaching complaintsDropdown
        complaintsSubMenu.classList.toggle('submenu-visible');
        eme2.classList.toggle('eme2-rotate');
    });

    // Highlight the `Complaints.php` only when clicked directly
    complaintsDropdown.addEventListener('click', function() {
        // Remove highlight from all sidebar items
        sidebarLinks.forEach(item => item.classList.remove('baractive'));
        // Add highlight to `Complaints.php` link
        complaintsDropdown.classList.add('baractive');
    });

    // Handle highlighting for submenu items
    submenuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            submenuLinks.forEach(item => item.classList.remove('baractive'));
            link.classList.add('baractive');
        });
    });
});
