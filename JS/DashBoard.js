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


// document.addEventListener("DOMContentLoaded", function () {
//     const sidebarLinks = document.querySelectorAll('.sideside');
//     const submenuLinks = document.querySelectorAll('#complaintsSubMenu a');
//     const complaintsDropdown = document.getElementById('complaintsDropdown');
//     const complaintsSubMenu = document.getElementById('complaintsSubMenu');
//     const buttonEme2 = document.querySelector('.buttonEme2');
//     const eme2 = buttonEme2.querySelector('.eme2');

//     // Get the current page URL
//     const activePage = window.location.pathname.split("/").pop();

//     // Highlight the active sidebar link based on the current page
//     sidebarLinks.forEach(link => {
//         const linkHref = link.getAttribute('href');
//         if (linkHref === activePage) {
//             link.classList.add('baractive');
//         } else {
//             link.classList.remove('baractive');
//         }
//     });

//     // Highlight submenu items if we're in a complaints subpage
//     submenuLinks.forEach(link => {
//         const linkHref = link.getAttribute('href');
//         if (linkHref === activePage) {
//             link.classList.add('baractive');
//             complaintsSubMenu.classList.add('submenu-visible'); // Keep the submenu open
//             complaintsDropdown.classList.add('baractive'); // Highlight the main "Manage Complaints" item
//             eme2.classList.add('eme2-rotate'); // Rotate the button arrow to indicate submenu is open
//         } else {
//             link.classList.remove('baractive');
//         }
//     });

//     // Toggle submenu visibility only when clicking the main dropdown button
//     buttonEme2.addEventListener('click', function (event) {
//         event.preventDefault();
//         complaintsSubMenu.classList.toggle('submenu-visible');
//         eme2.classList.toggle('eme2-rotate');
//     });

//     // Prevent the submenu from closing when a submenu link is clicked
//     submenuLinks.forEach(link => {
//         link.addEventListener('click', function (event) {
//             event.stopPropagation(); // Prevents click from bubbling up to toggle
//             // Set active states based on the clicked submenu item
//             submenuLinks.forEach(item => item.classList.remove('baractive'));
//             link.classList.add('baractive');
//             complaintsDropdown.classList.add('baractive'); // Keep the main item active
//             complaintsSubMenu.classList.add('submenu-visible'); // Ensure submenu remains open
//         });
//     });
// });




