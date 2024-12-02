document.addEventListener("DOMContentLoaded", () => {
    const errorText = document.querySelector(".irorSignup");
    const form = document.querySelector(".saynap");
    const SaynapBtn = form.querySelector(".SaynapBtn");
    const otpSection = document.getElementById('otpSection');
    const sendOTPBtn = document.getElementById('sendOTPBtn');
    const verifyOTPBtn = document.getElementById('verifyOTPBtn');
    const submitBtn = document.getElementById('submitBtn');
    const OTPinput = document.getElementById('OTPinput');
    const resendOTPBtn = document.getElementById("resendOTPBtn");
    const timerDisplay = document.getElementById("timer");
    const otpExpiryDuration = 60; // Default OTP expiry time in seconds
    const timerKey = 'otpExpiryTimestamp';// Key to save timer data in localStorage
    
    let timerInterval;

    // Ensure submitBtn exists before attempting to disable it
    if (!submitBtn) {
        console.error("submitBtn not found in the DOM.");
        return;
    }

    function checkOtpStatus() {
        if (!OTPinput) {
            console.warn("OTP input not found in the DOM.");
            return; // Exit if element is not found
        }

        const otpStatus = OTPinput.value || 'Unverified'; // Default to 'Unverified'
        console.log(otpStatus);
        submitBtn.disabled = otpStatus !== 'Verified'; // Only disable submitBtn if it exists
        console.log("OTPinput value on load: ", OTPinput.value);  // Log the value

        if (OTPinput) {
            OTPinput.value = 'Unverified';  // Explicitly set the value
            console.log("OTPinput value after setting: ", OTPinput.value);  // Log updated value
        } else {
            console.error("OTPinput element is not found.");
        }
    }

    // Initialize OTP Status Check
    checkOtpStatus();

    // Add Change Listener for OTP Status Input
    if (OTPinput) {
        OTPinput.addEventListener('change', checkOtpStatus);
    }

    function startOtpTimer() {
        const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
        const expiryTimestamp = parseInt(localStorage.getItem(timerKey), 10); // Get expiration timestamp
    
        if (!expiryTimestamp || currentTime >= expiryTimestamp) {
            // Timer has expired or not set
            localStorage.removeItem(timerKey); // Clean up expired key
            timerDisplay.parentElement.style.display = "none";
            resendOTPBtn.style.display = "block";
            clearInterval(timerInterval);
            return;
        }
    
        // Calculate remaining time
        let timeRemaining = expiryTimestamp - currentTime;
        timerDisplay.parentElement.style.display = "block";
        resendOTPBtn.style.display = "none";

        timerInterval = setInterval(() => {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timerDisplay.textContent = `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
    
            timeRemaining--;
    
            if (timeRemaining < 0) {
                clearInterval(timerInterval);
                timerDisplay.parentElement.style.display = "none";
                resendOTPBtn.style.display = "block";
                localStorage.removeItem(timerKey); // Clean up when expired
            }
        }, 1000);
    }
    
    function handleSendOtp() {
        const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
        const expiryTimestamp = currentTime + otpExpiryDuration; // Calculate expiration time
        localStorage.setItem(timerKey, expiryTimestamp); // Save expiration time in localStorage
        startOtpTimer(); // Start the timer
    }
    
    if (sendOTPBtn) {
        sendOTPBtn.addEventListener('click', () => {
            const loadingIndicator = document.getElementById('loading-indicator');
            loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator
    
            const email = document.getElementById('emailOTP').value;
                
            if (!email) {
                alert('Please enter an email address.');
                return;
            }
    
            // Send OTP request to PHP backend
            fetch('PHPBackend/Verify_OTP.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: 'send_otp', email: email }) // Send data as JSON
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                alert(data.message);
                if (data.success) {
                    otpSection.style.display = 'block'; // Show OTP input section
                    sendOTPBtn.style.display = 'none'; // Hide the send OTP button
                    handleSendOtp();

                } else {
                    alert(data.message); // Alert message if sending failed
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while sending OTP.");  
            })
            .finally(() => {
                loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when email is processed
            });
        });
    } else {
        console.error('sendOTPBtn not found in the DOM.');
    }
    

    resendOTPBtn.addEventListener("click", () => {
        resendOTPBtn.style.display = "none";
        sendOTPBtn.click(); // Trigger sending OTP again
    });


    // Handle Verify OTP
    verifyOTPBtn.addEventListener('click', () => {
        const otp = document.getElementById('EMAILotp').value;
        const email = document.getElementById('emailOTP').value;

        if (!otp) {
            alert('Please enter the OTP.');
            return;
        }

        fetch('PHPBackend/Verify_OTP.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'verify_otp', otp: otp, email: email })
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    submitBtn.disabled = false;
                    otpSection.style.display = 'none';
                    timerDisplay.parentElement.style.display = "none";
                    resendOTPBtn.style.display = "none";
                    clearInterval(timerInterval);
                    localStorage.removeItem(timerKey); 
                }
            })
            .catch(error => console.error("Error:", error));
    });

    // Start the timer on page load
    window.addEventListener('load', startOtpTimer);


    if (SaynapBtn) {
        console.log("Signup button found");

        SaynapBtn.addEventListener("click", (event) => {
            console.log("Signup button clicked");

            // Prevent default form submission
            event.preventDefault();

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            // Validate new password criteria
            const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/;
            if (!passwordRegex.test(password)) {
                alert(
                    "Your password must be at least 6 characters long and include a combination of numbers, letters, and special characters."
                );
                return; 
            }


            // Password match validation
            if (password !== confirmPassword) {
                errorText.textContent = "Passwords do not match.";
                errorText.style.display = "block";
                console.log("Password mismatch error");

                setTimeout(() => {
                    errorText.style.display = "none";
                }, 3000);

                return;
            }

            const ageInput = document.getElementById("age");
            const age = parseInt(ageInput.value, 10);

            if (isNaN(age) || age < 18) {
                errorText.textContent = "You must be at least 18 years old to sign up.";
                errorText.style.display = "block";
                console.log("Age validation failed");
                ageInput.value = '';

                setTimeout(() => {
                    errorText.style.display = "none";
                }, 3000);   

                return;
            }

            let formData = new FormData(form);

            // Debugging: Log all form data entries
            for (const [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "PHPBackend/Signup.php", true);

            xhr.onload = () => {
                console.log("AJAX request completed");

                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response.trim();  // Use trim() to handle unexpected white space
                        console.log("Response received: ", data);

                        if (data === "success") {
                            console.log("Redirecting to LoginPage.php");
                            // location.reload();
                            alert("Account Created Successfully");
                            location.href = "LoginPage.php";

                        } else {
                            errorText.textContent = data;
                            errorText.style.display = "block";
                            console.log("Error text displayed: ", data);

                            setTimeout(() => {
                                errorText.style.display = "none";
                            }, 3000);
                        }
                    } else {
                        console.log("Error: Request status not 200");
                    }
                } else {
                    console.log("Error: XHR readyState is not DONE");
                }
            }

            xhr.onerror = () => {
                console.log("Error: AJAX request failed");
            }

            console.log("Form data being sent: ", formData);
            xhr.send(formData);
        });
    } else {
        console.log("Signup button not found");
    }
});

function calculateAge() {
  console.log("calculateAge function called");

  const dob = document.getElementById('dob').value;
  const ageInput = document.getElementById('age');
  console.log("DOB value: ", dob);

  if (dob) {
      const dobDate = new Date(dob);
      const today = new Date();
      let age = today.getFullYear() - dobDate.getFullYear();
      const monthDiff = today.getMonth() - dobDate.getMonth();
      const dayDiff = today.getDate() - dobDate.getDate();

      if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
          age--;
      }

      ageInput.value = age;
      console.log("Calculated age: ", age);
  } else {
      ageInput.value = '';
      console.log("DOB not provided, age input cleared");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  console.log("Second DOMContentLoaded for checkboxes");

  const checkYes = document.getElementById("checkYes");
  const checkNo = document.getElementById("checkNo");

  checkYes.addEventListener("change", () => {
      console.log("Yes checkbox changed: ", checkYes.checked);
      if (checkYes.checked) {
          checkNo.checked = false;
          console.log("No checkbox unchecked");
      }
  });

  checkNo.addEventListener("change", () => {
      console.log("No checkbox changed: ", checkNo.checked);
      if (checkNo.checked) {
          checkYes.checked = false;
          console.log("Yes checkbox unchecked");
      }
  });
});


// Get all the required inputs
const requiredInputs = [
    { id: "fname", name: "First Name" },
    { id: "lname", name: "Last Name" },
    { id: "block", name: "Block" },
    { id: "lot", name: "Lot" },
    { id: "phonenum", name: "Contact Number" },
    { id: "dob", name: "Date of Birth" },
    { id: "age", name: "Age" },
    { id: "emailOTP", name: "Email" },
];

const genderInputs = document.querySelectorAll('input[name="gender"]');
const sendOTPBtn = document.getElementById("sendOTPBtn");

// Function to check if all required inputs are filled
function validateInputs() {
    let allFilled = true;

    console.log("Starting validation check...");

    // Check all required inputs
    requiredInputs.forEach((input) => {
        const field = document.getElementById(input.id);
        if (!field || !field.value.trim()) {
            console.log(`${input.name} is empty or invalid.`);
            allFilled = false;
        } else {
            console.log(`${input.name} has a valid value: ${field.value}`);
        }
    });

    // Check if a gender is selected
    const genderSelected = Array.from(genderInputs).some((input) => input.checked);
    if (!genderSelected) {
        console.log("Gender is not selected.");
        allFilled = false;
    } else {
        console.log("Gender is selected.");
    }

    // Show or hide the Send OTP button based on validation
    if (allFilled) {
        sendOTPBtn.style.display = "block";
        console.log("All inputs are valid. Send OTP button is now visible.");
    } else {
        sendOTPBtn.style.display = "none";
        console.log("Not all inputs are valid. Send OTP button is hidden.");
    }
}

// Add blur event listeners to inputs for validation
requiredInputs.forEach((input) => {
    const field = document.getElementById(input.id);
    if (field) {
        field.addEventListener("blur", () => {
            console.log(`Blur event triggered on ${input.name}.`);
            validateInputs();
        });
    }
});

// Add change event listeners for gender radio buttons
genderInputs.forEach((input) => {
    input.addEventListener("change", () => {
        console.log("Change event triggered for gender selection.");
        validateInputs();
    });
});

// Initial validation check
validateInputs();
