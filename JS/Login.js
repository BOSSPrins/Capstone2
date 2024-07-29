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
                window.location.href = "UserAnnounce.php";
              } else {
                errorText.textContent = data;
                errorText.style.display = "block";
                console.log(data);
              }
            }
          }
        };
  
        let formData = new FormData(form);
        xhr.send(formData);
      };
    }
  });
  