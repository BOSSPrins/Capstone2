// FUNCTION PARA SA PAGLABAS NG DROPDOWN CHAT 
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

// FUNCTION PARA SA PROFILE 
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

// FUNCTION PARA SA DROPDOWN COMPLAINT 
function toggleDropdown() {
    const dropdown = document.querySelector('.dropdownInput');
    const dropdownContent = dropdown.querySelector('.dropdownContentInput');
    const isOpen = dropdown.classList.contains('open');

    if (isOpen) {
        dropdownContent.style.display = 'none';
        dropdown.classList.remove('open');
    } else {
        dropdownContent.style.display = 'block';
        dropdown.classList.add('open');
    }
}

// Add event listeners to the input field and button
document.querySelector('.dropdownInputField').addEventListener('click', toggleDropdown);
document.querySelector('.dropbtnInput').addEventListener('click', toggleDropdown);

// Function to handle selecting an item from the dropdown
function selectComplaint(value) {
    document.getElementById('selectedComplaint').value = value;
    // Close the dropdown after selection
    const dropdown = document.querySelector('.dropdownInput');
    dropdown.classList.remove('open');
    dropdown.querySelector('.dropdownContentInput').style.display = 'none';
}

