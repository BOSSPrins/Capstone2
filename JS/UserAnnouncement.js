// FUNCTION PARA SA SUB-SIDEBAR CHAT
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


// FUNCTION PARA SA PROFILE MODAL 
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

// FUNCTION PARA SA READ MORE 
function toggleAnnounce(pageId) {
    console.log("Toggling Announcement for:", pageId);

    // Hide all pages
    const Dahon = document.querySelectorAll('.AnnouncementCardss');
    Dahon.forEach(page => {
        page.style.display = 'none'; // Hide all containers
        console.log("Hiding:", page.id);
    });

    // Show the selected page
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'flex'; // Use flex to maintain the layout
        console.log("Displaying:", selectedPage.id);
    } else {
        console.error("No container found with ID:", pageId);
    }
}

// Set a default container on page load
window.onload = function() {
    toggleAnnounce('MainAnnouncements'); // Default to 'MainAnnouncements'
};

// function toggleAnnounce(pageId) {
//     console.log("Toggling Announcement for:", pageId);

//     // Hide all pages
//     const Dahon = document.querySelectorAll('.AnnouncementCardss');
//     Dahon.forEach(page => {
//         page.style.display = 'none'; // Hide all containers
//         console.log("Hiding:", page.id);
//     });

//     // Show the selected page
//     const selectedPage = document.getElementById(pageId);
//     if (selectedPage) {
//         selectedPage.style.display = 'flex'; // Use flex to maintain the layout
//         console.log("Displaying:", selectedPage.id);
//     } else {
//         console.error("No container found with ID:", pageId);
//     }

//     // Store the active page in local storage
//     localStorage.setItem('activeContainer', pageId);
// }


// // Check local storage on page load to determine which container to show
// window.onload = function() {
//     const activeContainer = localStorage.getItem('activeContainer');
//     toggleAnnounce(activeContainer || 'MainAnnouncements'); // Default to 'tableCon'
// }

