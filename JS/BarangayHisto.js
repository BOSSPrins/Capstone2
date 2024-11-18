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
function toggleHistoBiew(pageId) {
    // Hide all pages
    const Pahina = document.querySelectorAll('.EachContainerBarang2');
    Pahina.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected page
    const selectedPahina = document.getElementById(pageId);
    if (selectedPahina) {
        selectedPahina.style.display = 'flex'; // Use flex to maintain layout
    }

    // Store the active page in local storage under 'currentPage'
    localStorage.setItem('currentPahina', pageId);
}

// Check local storage on page load to determine which container to show
window.onload = function() {
    const currentPahina = localStorage.getItem('currentPahina');
    toggleHistoBiew(currentPahina || 'TableHistory'); // Default to 'TableHistory' if no page is stored
}


// FUNCTION PARA SA MGA TEXTAREA
// Select all textareas with the class "textAreaCompDeta"
const BarangTextareass = document.querySelectorAll(".textAreaBarangDeta2");

BarangTextareass.forEach(textarea => {
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


// FUNCTION PARA SA PICTURE MODAL PREVIEW 
// Example list of images that you want to display in the modal (use your actual image list here)
const images = [
    "image1.jpg", // Replace with actual image URLs
    "image2.jpg",
    "image3.jpg"
];

// Modal and Image elements
const imageModalHistory = document.querySelector('.imageModalHistory');
const modalImageHisto = document.querySelector('.modalImageHisto');
let currentIndexx = 0;  // Track the current image index

// Show the modal and display the first image
document.querySelector('.BiewPictures').addEventListener('click', function() {
    currentIndexx = 0;  // Reset to first image
    showModal();
});

// Function to display the modal and set the image
function showModal() {
    imageModalHistory.style.display = 'flex';  // Show the modal
    modalImageHisto.src = images[currentIndexx];  // Set the image source
}

// Close the modal when clicking the close button
document.querySelector('.closeModalHisto').addEventListener('click', function() {
    imageModalHistory.style.display = 'none';  // Hide the modal
});

// Function to change the image when clicking next or previous
function changeImage(direction) {
    currentIndexx += direction;

    // Loop the images: if we're at the start or end, loop around
    if (currentIndexx < 0) {
        currentIndexx = images.length - 1;  // Go to last image
    } else if (currentIndexx >= images.length) {
        currentIndexx = 0;  // Go to first image
    }

    modalImageHisto.src = images[currentIndexx];  // Update the image source
}
