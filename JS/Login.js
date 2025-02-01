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
        dropdownButton.dataset.value = selectedValue;  // Set data-value attribute
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


function showSuccessNotification(message) {
  const successNotifications = document.querySelector('.successNotifications');

  const notification = document.createElement('div');
  notification.classList.add('successNotification');

  // Create the notification header with "Success" text and a close button (X)
  const notificationHeader = document.createElement('div');
  notificationHeader.classList.add('saksesnotificationHeader');
  notificationHeader.innerHTML = "Success";
  
  const closeButton = document.createElement('span');
  closeButton.classList.add('saksescloseButton');
  closeButton.innerHTML = "&times;"; // "X" symbol for close

  // Append close button to the header
  notificationHeader.appendChild(closeButton);

  // Append header and message to the notification
  notification.appendChild(notificationHeader);
  const messageContainer = document.createElement('div');
  messageContainer.classList.add('saksesmessageContent');
  messageContainer.innerHTML = message;
  notification.appendChild(messageContainer);

  // Append the new success notification to the container
  successNotifications.appendChild(notification);

  // Close notification on clicking the "X" button
  closeButton.addEventListener('click', () => {
      notification.classList.add('fadeOut');
      setTimeout(() => {
          notification.remove();
      }, 1000); // Wait for the fade-out animation to complete
  });

  // After 3 seconds, fade out and remove the notification
  setTimeout(() => {
      notification.classList.add('fadeOut');
      setTimeout(() => {
          notification.remove();
      }, 1000); // Wait for the fade-out animation to complete
  }, 5000); // Wait for 5 seconds before starting the fade-out
}

// Function to show error notifications
function showErrorNotification(message) {
  const errorNotifications = document.querySelector('.errorNotifications');

  const notification = document.createElement('div');
  notification.classList.add('errorNotification');

  // Create the notification header with "Notification" text and a close button (X)
  const notificationHeader = document.createElement('div');
  notificationHeader.classList.add('notificationHeader');
  notificationHeader.innerHTML = "Notification";
  
  const closeButton = document.createElement('span');
  closeButton.classList.add('closeButton');
  closeButton.innerHTML = "&times;"; // "X" symbol for close

  // Append close button to the header
  notificationHeader.appendChild(closeButton);

  // Append header and message to the notification
  notification.appendChild(notificationHeader);
  const messageContainer = document.createElement('div');
  messageContainer.classList.add('messageContent');
  messageContainer.innerHTML = message;
  notification.appendChild(messageContainer);

  // Append the new error notification to the container
  errorNotifications.appendChild(notification);

  // Close notification on clicking the "X" button
  closeButton.addEventListener('click', () => {
      notification.classList.add('fadeOut');
      setTimeout(() => {
          notification.remove();
      }, 1000); // Wait for the fade-out animation to complete
  });

  // After 3 seconds, fade out and remove the notification
  setTimeout(() => {
      notification.classList.add('fadeOut');
      setTimeout(() => {
          notification.remove();
      }, 1000); // Wait for the fade-out animation to complete
  }, 5000); // Wait for 5 seconds before starting the fade-out
}

//FUNCTION NA PARA SA LOGIN
document.addEventListener("DOMContentLoaded", () => {
  
  // const errorText = form.querySelector(".iror");
  // const saksesText = form.querySelector(".sakses");
  const form = document.querySelector(".lagin");
  const LoginBtn = form.querySelector(".laginbtn");
  const loadingIndicator = document.getElementById("loading-indicator");

  form.onsubmit = (e) => {
    e.preventDefault(); // Prevent default form submission
  };

  if (LoginBtn) {
    LoginBtn.onclick = () => {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "PHPBackend/Login.php", true);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Optional: Helps PHP recognize an AJAX request

      // Show the loading indicator when the request starts
      loadingIndicator.style.setProperty("display", "flex", "important");

      xhr.onload = () => {

         // Hide loading indicator after getting response (success or error)
         loadingIndicator.style.setProperty("display", "none", "important");

        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          try {
            let response = JSON.parse(xhr.responseText); // Parse JSON response

            if (response.status === "success") {
              if (response.message === "admin") {
                window.location.href = "DashBoard.php";
              } else if (response.message === "user") {
                window.location.href = "UserVoting.php";
              } else if (response.message === "barangay") {
                window.location.href = "BarangayTable.php";
              } else {
                showSuccessNotification(response.message);
              }
            } else {
              showErrorNotification(response.message);
            }
          } catch (error) {
            console.error("Invalid JSON response:", xhr.responseText);
            showErrorNotification("An unexpected error occurred.");
          }
        }
      };

      // Handle errors (e.g., network failure)
      xhr.onerror = () => {
        loadingIndicator.style.setProperty("display", "none", "important");
        showErrorNotification("A network error occurred. Please try again.");
      };

      let formData = new FormData(form);
      xhr.send(formData);
    };
  }
});

