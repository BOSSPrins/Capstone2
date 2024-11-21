function showSignUpForm() {
    document.getElementById("loginForm").classList.remove("show");
    document.getElementById("signUpForm").classList.add("show");
}

function showLoginForm() {
    document.getElementById("signUpForm").classList.remove("show");
    document.getElementById("loginForm").classList.add("show");
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

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".lagin");
    const errorText = form.querySelector(".iror");
    const saksesText = form.querySelector(".sakses");
    const LoginBtn = form.querySelector(".laginbtn");
  
    form.onsubmit = (e) => {
      // Prevent the form from submitting normally
      e.preventDefault();
    };
  
    if (LoginBtn) {
      LoginBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "PHPBackend/Login.php", true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.response;
              console.log(data);
  
              if (data === "admin") {
                window.location.href = "DashBoard.php";
              } else if (data === "user") {
                window.location.href = "UserVoting.php";
              } else if (data === "barangay") {
                window.location.href = "BarangayTable.php";
              } else if (data === "Please wait for confirmation") {
                // Display success message
                saksesText.textContent = data;
                saksesText.style.display = "block";
                console.log(data);
                
                // Hide success text after 5 seconds
                setTimeout(() => {
                    saksesText.style.display = "none";
                }, 5000);           

              } else {
                errorText.textContent = data;
                errorText.style.display = "block";
                console.log(data);


                setTimeout(() => {
                  errorText.style.display = "none";
              }, 3000);
              }
            }
          }
        };
  
        let formData = new FormData(form);
        xhr.send(formData);
      };
    }
}); 


//   function fetchAccountsData() {
//     console.log('Fetching accounts data...');
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'PHPBackend/Login.php', true); // Point to the PHP script

//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             console.log('XHR ReadyState:', xhr.readyState);
//             console.log('XHR Status:', xhr.status);

//             if (xhr.status === 200) {
//                 console.log('Response received:', xhr.responseText);
//                 var response = JSON.parse(xhr.responseText);

//                 if (response.success) {
//                     console.log('Accounts data:', response.accounts);
//                 } else {
//                     console.error('Error:', response.error);
//                 }
//             } else {
//                 console.error('Request failed with status:', xhr.status);
//             }
//         }
//     };

//     xhr.send();
// }

// // Call the function to fetch and log the accounts data
// fetchAccountsData();


// FUNCTION PARA SA TOGGLE PASSWORD SHOW AND HIDE IN LOGIN 
function togglePasswordVisibilityLog(showIconId, hideIconId) {
  var passwordInput = document.getElementById('loginpassword');
  var showIcon = document.getElementById(showIconId);
  var hideIcon = document.getElementById(hideIconId);

  // Toggle the password visibility (input type)
  if (passwordInput.type === 'password') {
      passwordInput.type = 'text'; // Show the password
  } else {
      passwordInput.type = 'password'; // Hide the password
  }

  // Toggle visibility of the icons
  showIcon.style.display = 'none'; // Hide the "show" icon
  hideIcon.style.display = 'inline'; // Show the "hide" icon
}


// FUNCTION PARA SA TOGGLE PASSWORD SHOW AND HIDE IN SIGN UP 
function togglePasswordVisibilitySign(showIconId, hideIconId, inputFieldId) {
  // Reference to the password input and the icons
  var passwordInput = document.getElementById(inputFieldId);
  var showIcon = document.getElementById(showIconId);
  var hideIcon = document.getElementById(hideIconId);

  // Toggle the password visibility
  if (passwordInput.type === 'password') {
      passwordInput.type = 'text';  // Show the password
      showIcon.style.display = 'inline'; // Show the "show" icon
      hideIcon.style.display = 'none';   // Hide the "hide" icon
  } else {
      passwordInput.type = 'password';  // Hide the password
      showIcon.style.display = 'none';  // Hide the "show" icon
      hideIcon.style.display = 'inline'; // Show the "hide" icon
  }
}

