function showForms(formName) {
  // Hide both forms
  document.getElementById('LoginFormContainer').style.display = 'none';
  document.getElementById('SignUpFormContainer').style.display = 'none';

  // Show the selected form based on the form name
  if (formName === 'LoginForm') {
      document.getElementById('LoginFormContainer').style.display = 'flex';
  } else if (formName === 'SignUpForm') {
      document.getElementById('SignUpFormContainer').style.display = 'flex';
  }
}


document.addEventListener('DOMContentLoaded', function () {
// Dropdown elements
const dropdownButton = document.querySelector('.dropdown-button');
const dropdownContent = document.querySelector('.dropdown-content');
const options = dropdownContent.querySelectorAll('.option');

// Toggle dropdown visibility on button click
dropdownButton.addEventListener('click', function (event) {
event.stopPropagation(); // Prevent click event from bubbling up to document
dropdownContent.classList.toggle('show');
});

// Update dropdown button text when an option is selected
options.forEach(option => {
option.addEventListener('click', function () {
  const selectedValue = this.querySelector('input').value;
  dropdownButton.textContent = this.textContent.trim();
  dropdownContent.classList.remove('show');
});
});

// Close the dropdown if the user clicks outside of it
document.addEventListener('click', function (event) {
if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
  dropdownContent.classList.remove('show');
}
});
});



// FUNCTION PARA SA TOGGLE PASSWORD SHOW AND HIDE IN LOGIN 
function togglePasswordVisibilityLog(showIconId, hideIconId) {
  var passwordInput1 = document.getElementById('loginpassword');
  var showIcon1 = document.getElementById(showIconId);
  var hideIcon1 = document.getElementById(hideIconId);

  // Toggle the password visibility (input type)
  if (passwordInput1.type === 'password') {
      passwordInput1.type = 'text'; // Show the password
  } else {
      passwordInput1.type = 'password'; // Hide the password
  }

  // Toggle visibility of the icons
  showIcon1.style.display = 'none'; // Hide the "show" icon
  hideIcon1.style.display = 'inline'; // Show the "hide" icon
}

// FUNCTION PARA SA TOGGLE PASSWORD SHOW AND HIDE IN SIGN UP
function toggleEye1(KitaId, TagoId) {
  var Pass = document.getElementById('Pass');
  var KitaId = document.getElementById(KitaId);
  var TagoId = document.getElementById(TagoId);

  // Toggle the password visibility (input type)
  if (Pass.type === 'password') {
      Pass.type = 'text'; // Show the password
  } else {
      Pass.type = 'password'; // Hide the password
  }

  // Toggle visibility of the icons
  KitaId.style.display = 'none'; // Hide the "show" icon
  TagoId.style.display = 'inline'; // Show the "hide" icon
}

function toggleEye2(Kita2Id, Tago2Id) {
  var PassCon = document.getElementById('Pass2');
  var Kita2Id = document.getElementById(Kita2Id);
  var Tago2Id = document.getElementById(Tago2Id);

  // Toggle the password visibility (input type)
  if (PassCon.type === 'password') {
      PassCon.type = 'text'; // Show the password
  } else {
      PassCon.type = 'password'; // Hide the password
  }

  // Toggle visibility of the icons
  Kita2Id.style.display = 'none'; // Hide the "show" icon
  Tago2Id.style.display = 'inline'; // Show the "hide" icon
}

// FUNCTION PARA SA HAMVURGER 
function toggleNavbar() {
  const navbar = document.querySelector('.MhNavv');
  navbar.classList.toggle('active'); // Toggle the 'active' class to show/hide the navbar
}

// FUNCTION SA ACTIVE STATE NG NAVBAR 
const navLinks = document.querySelectorAll('.MhNavv a');

// Function to set active state based on screen size
function setActiveLink(link) {
// Remove the 'activee' or 'clicked' class from all links
navLinks.forEach(link => {
  link.classList.remove('activee');
  link.classList.remove('clicked');
});

// Add the appropriate active class based on screen width
if (window.innerWidth > 905) {
  link.classList.add('activee');
} else {
  link.classList.add('clicked');
}
}

// Handle active link state on click
navLinks.forEach(link => {
link.addEventListener('click', function (event) {
  event.preventDefault(); // Prevent default navigation for anchor links
  
  // Set the active state on the clicked link
  setActiveLink(this);

  // Navigate to the link after setting the active class (allowing navigation only after state change)
  setTimeout(() => {
    window.location.href = this.href;
  }, 150); // Allow time for active state transition before navigating
});
});

// On page load, check the current URL or hash to apply active state
document.addEventListener("DOMContentLoaded", () => {
const currentUrl = window.location.href; // Get the full current URL

// Find the link that matches the current URL (including the base URL or hash for internal links)
const activeLink = Array.from(navLinks).find(link => link.href === currentUrl);

// If a matching link is found, set it as active
if (activeLink) {
  setActiveLink(activeLink);
}
});
