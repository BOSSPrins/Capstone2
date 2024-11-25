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


// FUNCTION PARA SA PAG SHOW NG MODAL FOR DETAILS
const btn = document.getElementById('ViewDetBtn');

btn.addEventListener('click', function() {
    modalViewDetails.style.display = 'flex';  // Show modal
});

const modalViewDetails = document.querySelector('.BiewwModalPoIto');
const closeModalButton = document.querySelector('.EkisToo');

// Close the modal when the "X" button is clicked
closeModalButton.addEventListener('click', function() {
    modalViewDetails.style.display = 'none';  // Hide modal
});

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function(event) {
    if (event.target === modalViewDetails) {
        modalViewDetails.style.display = 'none';  // Hide modal if clicked outside
    }
});


// FUNCTION PARA SA PAGES NG TABLE LIST AND REQUEST NEW DOCUMENTS
function togglePageNewReqAndTbl(pageId) {
    // Hide all containers
    const allContainers = document.querySelectorAll('.ContainerForDocuments');
    allContainers.forEach(container => {
        container.style.display = 'none'; // Hide all containers
    });

    // Show the selected container
    const selectedContainer = document.getElementById(pageId);
    if (selectedContainer) {
        selectedContainer.style.display = (pageId === 'TblConForDocs') ? 'flex' : 'block'; // 'flex' for 'TblConForDocs', 'block' for others
    }
}

// Always show the TblConForDocs section on page load
window.onload = function() {
    // Hide all containers initially
    const pages = document.querySelectorAll('.ContainerForDocuments');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Always show the TblConForDocs section by default
    const tblConforComplaints = document.getElementById('TblConForDocs');
    if (tblConforComplaints) {
        tblConforComplaints.style.display = 'flex'; // Use flex to maintain the layout for TblConForDocs
    }
};


// FUNCTION PARA SA TYPE OF DOCUMENT
function toggleTypeDoc() {
    const typeDropdown = document.querySelector('.TypeDropOptionsDoc');
    // Toggle the dropdown visibility
    typeDropdown.style.display = typeDropdown.style.display === 'none' ? 'block' : 'none';
}

function TypeSet(Uri) {
    const TyDis = document.querySelector('.TyDis');
    TyDis.textContent = Uri; // Set the text based on the selected option
    document.querySelector('.TypeDropOptionsDoc').style.display = 'none'; // Hide the dropdown options

    // Toggle visibility of moveOutCon and moveInCon based on the selected type
    if (Uri === 'Move Out') {
        document.getElementById('moveOutCon').style.display = 'block';
        document.getElementById('moveInCon').style.display = 'none';
    } else if (Uri === 'Move In') {
        document.getElementById('moveOutCon').style.display = 'none';
        document.getElementById('moveInCon').style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Initial state: Show Move Out section and hide Move In section
    document.getElementById('moveOutCon').style.display = 'block';
    document.getElementById('moveInCon').style.display = 'none';
});
