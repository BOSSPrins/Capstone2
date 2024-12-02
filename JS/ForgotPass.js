// Function for toggling password show/hide for "New Password"
function toggleMata1(mataShow1Id, mataHide1Id, inputId) {
  var passInput1 = document.getElementById(inputId);  // Reference to the password input
  var mataShow1 = document.getElementById(mataShow1Id);       // Icon to show (open eye)
  var mataHide1 = document.getElementById(mataHide1Id);       // Icon to hide (closed eye)

  // Toggle the password visibility (input type)
  if (passInput1.type === 'password') {
      passInput1.type = 'text';  // Show the password
  } else {
      passInput1.type = 'password';  // Hide the password
  }

  // Toggle visibility of the icons
  mataShow1.style.display = 'none'; // Hide the "show" icon
  mataHide1.style.display = 'inline'; // Show the "hide" icon
}

// Function for toggling password show/hide for "Confirm Password"
function toggleMata2(mataShow2Id, mataHide2Id, inputId) {
  var passInput2 = document.getElementById(inputId);  // Reference to the password input
  var mataShow2 = document.getElementById(mataShow2Id);      // Icon to show (open eye)
  var mataHide2 = document.getElementById(mataHide2Id);       // Icon to hide (closed eye)

  // Toggle the password visibility (input type)
  if (passInput2.type === 'password') {
      passInput2.type = 'text';  // Show the password
  } else {
      passInput2.type = 'password';  // Hide the password
  }

  // Toggle visibility of the icons
  mataShow2.style.display = 'none'; // Hide the "show" icon
  mataHide2.style.display = 'inline'; // Show the "hide" icon
}

function showLoading() {
    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.setProperty('display', 'flex', 'important');
    console.log('Loading indicator displayed.');
}

function hideLoading() {
    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.setProperty('display', 'none', 'important');
    console.log('Loading indicator hidden.');
}

const apiUrl = 'PHPBackend/OTP_handler.php';

// Handle OTP request
document.getElementById('requestOTPForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'send_otp'); // Add action parameter

    showLoading();

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        
        if (data.success) {
            alert(data.message);
            document.getElementById('requestOTPForm').style.display = 'none';
            document.getElementById('verifyOTPForm').style.display = 'block';
            
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    })
    .finally(() => {
        hideLoading();
        
    });
});



// Handle OTP verification
document.getElementById('verifyOTPForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'verify_otp'); // Add action parameter

    // console.log('Showing loading indicator...');
    // const loadingIndicator = document.getElementById('loading-indicator');
    // loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator
    // console.log('Loading indicator displayed.');

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            document.getElementById('verifyOTPForm').style.display = 'none';
            document.getElementById('resetPasswordForm').style.display = 'block';
        }
    });
    // .catch(error => {
    //     console.error('Error:', error);
    //     alert('An error occurred. Please try again later.');
    // })
    // .finally(() => {
    //     loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator
    // });
});

// Handle password reset
document.getElementById('resetPasswordForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'reset_password'); // Add action parameter

    // const loadingIndicator = document.getElementById('loading-indicator');
    // loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            window.location.href = 'LoginPage.php';
        } else {
            alert(data.message); // Alert error message (e.g., passwords do not match)
        }
    });
    // .catch(error => {
    //     console.error('Error:', error);
    //     alert('An error occurred. Please try again later.');
    // })
    // .finally(() => {
    //     loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator
    // });
});

