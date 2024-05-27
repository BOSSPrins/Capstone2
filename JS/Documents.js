//FUNCTION NG SIDEBAR 
function showSidebar() {
  const sidebar = document.querySelector(".sidebarContainer");
  const mainContainer = document.querySelector(".DocumentsContainerr");
  const pagessContainer = document.querySelector(".pagess.active");
  sidebar.classList.remove("sideActive");
  mainContainer.classList.remove("DocumentsConActivee");
  pagessContainer.classList.remove("pagessActive");
}

const menuImage = document.querySelector(".menu");
menuImage.addEventListener("click", function() {
  const sidebar = document.querySelector(".sidebarContainer");
  const mainContainer = document.querySelector(".DocumentsContainerr");
  const pagessContainer = document.querySelector(".pagess.active");
  sidebar.classList.toggle("sideActive");
  mainContainer.classList.toggle("DocumentsConActivee");
  pagessContainer.classList.toggle("pagessActive");
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

function showPage(pageId) {
  // Hide all pages
  var pages = document.getElementsByClassName('pagess');
  for (var i = 0; i < pages.length; i++) {
      pages[i].classList.remove('active');
  }
  // Show the selected page
  var pageToShow = document.getElementById(pageId);
  if (pageToShow) {
      pageToShow.classList.add('active');
  }
}

function goBack() {
  // Hide all pages
  var pages = document.getElementsByClassName('pagess');
  for (var i = 0; i < pages.length; i++) {
      pages[i].classList.remove('active');
  }
} 




document.addEventListener("DOMContentLoaded", function () {
  const generateBtns = document.querySelectorAll(".GenerateBtn");
  const certificateModal = document.getElementById("certificateModal");

  generateBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
          certificateModal.style.display = "block";
      });
  });

  const closeCertificateBtn = document.querySelector(".certificateModal .CertClose");
  closeCertificateBtn.addEventListener("click", function () {
      certificateModal.style.display = "none";
  });
});