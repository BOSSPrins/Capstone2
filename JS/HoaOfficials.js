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


// FUNCTION PARA SA PAG SHOW NG EDITING POSITION
const btnEd = document.getElementById('HoaEditing');

btnEd.addEventListener('click', function() {
    modalEditing.style.display = 'flex';  // Show modal
});

const modalEditing = document.querySelector('.ModalEditingPos');
const closeModalEdit = document.querySelector('.EkisHo');

// Close the modal when the "X" button is clicked
closeModalEdit.addEventListener('click', function() {
    modalEditing.style.display = 'none';  // Hide modal
});

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function(event) {
    if (event.target === modalEditing) {
        modalEditing.style.display = 'none';  // Hide modal if clicked outside
    }
});


// FUNCTION SA PAG PILI NG PICTURE
document.getElementById("PictureWrapper").addEventListener("click", function() {
    document.getElementById("Picturee").click();  // Trigger file input click
});

document.getElementById("Picturee").addEventListener("change", function(event) {
    const file = event.target.files[0];  // Get the selected file
    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            // Create an image element
            const img = document.createElement("img");
            img.src = e.target.result;
            img.classList.add("imgDisplay");  // Add class to style the image

            // Clear the container and append the new image
            const imgContainer = document.getElementById("imgContainerr");
            imgContainer.innerHTML = '';  // Clear previous images (if any)
            imgContainer.appendChild(img);  // Add the new image
        };

        reader.readAsDataURL(file);  // Read the file as a data URL
    }
});