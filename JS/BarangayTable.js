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


// FUNCTION SA NAVBAR 
document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.NavTop');
    const currentPage = window.location.pathname; // Get the current page's path

    sidebarLinks.forEach(link => {
        const linkHref = link.getAttribute('href');

        // If the href matches the current page, add the 'baractive' class
        if (currentPage.includes(linkHref)) {
            link.classList.add('NavActive');
        } else {
            link.classList.remove('NavActive');
        }
    });
});

// FUNCTION SA COMPLAINT DETAILS 
function toggleBarangayCon(pageId) {
    // Hide all pages
    const pages = document.querySelectorAll('.EachContainerBarang');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected page
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'flex'; // Use flex to maintain layout
    }

    // Store the active page in local storage under 'currentPage'
    localStorage.setItem('currentPage', pageId);
}

// Check local storage on page load to determine which container to show
window.onload = function() {
    const currentPage = localStorage.getItem('currentPage');
    toggleBarangayCon(currentPage || 'TableListEsca'); // Default to 'TableListEsca'
}



// FUNCTION PARA SA MGA TEXTAREA
// Select all textareas with the class "textAreaCompDeta"
const BarangTextareas = document.querySelectorAll(".textAreaBarangDeta");

BarangTextareas.forEach(textarea => {
    textarea.addEventListener("input", function() {
        adjustTextareaHeight(textarea);
    });
});

function adjustTextareaHeight(textarea) {
    // Reset the height to auto to shrink if text is deleted
    textarea.style.height = "auto";
    // Set the height based on the scrollHeight, which adjusts to the content size
    textarea.style.height = textarea.scrollHeight + "px";
}



// FUNCTION PARA SA TAKE ACTION BUTTON 
function toggleStatusFields() {
    // Get the elements for Status and Remark fields
    var statusContainer = document.getElementById('status-container');
    var remarkContainer = document.getElementById('remark-container');

    // Toggle visibility of the Status and Remark containers
    if (statusContainer.style.display === 'none') {
        statusContainer.style.display = 'block';
        remarkContainer.style.display = 'block';
    } else {
        statusContainer.style.display = 'none';
        remarkContainer.style.display = 'none';
    }
}

// FUNCTION PARA SA STATUS cHANGE DROPDOWN
function toggleDropdown() {
    const options = document.querySelector('.dropdown-options');
    options.style.display = options.style.display === 'none' ? 'block' : 'none';
}

function setStatus(status) {
    const display = document.querySelector('.dropdown-display');
    display.textContent = status;
    document.querySelector('.dropdown-options').style.display = 'none';
}


// FUNCTION PARA SA PICTURE MODAL PREVIEW 
// Example list of images that you want to display in the modal (use your actual image list here)
const images = [
    "image1.jpg", // Replace with actual image URLs
    "image2.jpg",
    "image3.jpg"
];

// Modal and Image elements
const modal = document.querySelector('.imageModal');
const modalImage = document.querySelector('.modalImage');
let currentIndex = 0;  // Track the current image index

// Show the modal and display the first image
document.querySelector('.BiewwPicture').addEventListener('click', function() {
    currentIndex = 0;  // Reset to first image
    showModal();
});

// Function to display the modal and set the image
function showModal() {
    modal.style.display = 'flex';  // Show the modal
    modalImage.src = images[currentIndex];  // Set the image source
}

// Close the modal when clicking the close button
document.querySelector('.closeModal').addEventListener('click', function() {
    modal.style.display = 'none';  // Hide the modal
});

// Function to change the image when clicking next or previous
function changeImage(direction) {
    currentIndex += direction;

    // Loop the images: if we're at the start or end, loop around
    if (currentIndex < 0) {
        currentIndex = images.length - 1;  // Go to last image
    } else if (currentIndex >= images.length) {
        currentIndex = 0;  // Go to first image
    }

    modalImage.src = images[currentIndex];  // Update the image source
}