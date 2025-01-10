document.addEventListener("DOMContentLoaded", function () {
  const hiddenHeader = document.querySelector('.hiddenHeader');
  const showHeaderOffset = document.querySelector('.HeaderWithLogo').offsetHeight;

  window.addEventListener('scroll', function () {
      if (window.scrollY > showHeaderOffset) {
          hiddenHeader.classList.add('visible');
      } else {
          hiddenHeader.classList.remove('visible');
      }
  });
});

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
