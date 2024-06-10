//FUNCTION NG SIDEBAR 
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".AccountsssContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("AccountsssConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("AccountsssConActivee");
});

//FUNCTION FOR COMPLAIN DROPDOWN 
const eme2 = document.querySelector('.eme2');

// Function to toggle the visibility of the submenu and rotate eme2
function toggleSubMenu() {
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
    complaintsSubMenu.classList.toggle('submenu-visible');
    eme2.classList.toggle('eme2-rotate');
}

// Add click event listener to eme2
eme2.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    toggleSubMenu(); // Toggle the submenu visibility and rotate eme2
});

//FUNCTION SA MODAL 
const profModal = document.getElementById("profileModal"); //Pang kuha ng Modal 
const profModalBtn = document.getElementById("myProfileBtn"); //Pang bukas ng modal sa profile pag pinindot
const spanEkis = document.getElementsByClassName("closeProf")[0]; //Pang close ng modal 

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
    // Hide all pages
    const pages = document.getElementsByClassName("page");
    for (var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("activeProfModal");
    }
    // Show the selected page
    document.getElementById(pageName).classList.add("activeProfModal");
}

// //FUNCTION SA PAGPAPALABAS NG MODAL SA EDIT BUTTON
// const editButton = document.querySelector('.byuModal');
// const editModal = document.querySelector('.containerNgEditModal');
// const closeModalButton = document.querySelector('.klowsModal');

// function showEditModal() {
//     editModal.style.display = 'block';
// }

// function hideEditModal() {
//     editModal.style.display = 'none';
// }

// editButton.addEventListener('click', showEditModal);
// closeModalButton.addEventListener('click', hideEditModal);

// hangganan