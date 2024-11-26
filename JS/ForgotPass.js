const apiUrl = 'PHPBackend/OTP_handler.php';

// Handle OTP request
document.getElementById('requestOTPForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'send_otp'); // Add action parameter

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            document.getElementById('requestOTPForm').style.display = 'none';
            document.getElementById('verifyOTPForm').style.display = 'block';
        }
    });
});

// Handle OTP verification
document.getElementById('verifyOTPForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'verify_otp'); // Add action parameter

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
});

// Handle password reset
document.getElementById('resetPasswordForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('action', 'reset_password'); // Add action parameter

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
});
