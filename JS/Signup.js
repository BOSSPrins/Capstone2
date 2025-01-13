// document.addEventListener("DOMContentLoaded", () => {
//     const errorText = document.querySelector(".irorSignup");
//     const form = document.querySelector(".saynap");
//     // const SaynapBtn = form.querySelector(".SaynapBtn");
//     const otpSection = document.getElementById('otpSection');
//     const sendOTPBtn = document.getElementById('sendOTPBtn');
//     const verifyOTPBtn = document.getElementById('verifyOTPBtn');
//     const submitBtn = document.getElementById('submitBtn');
//     const OTPinput = document.getElementById('OTPinput');
//     const resendOTPBtn = document.getElementById("resendOTPBtn");
//     const timerDisplay = document.getElementById("timer");
//     const otpExpiryDuration = 60; // Default OTP expiry time in seconds
//     const timerKey = 'otpExpiryTimestamp';// Key to save timer data in localStorage
    
//     let timerInterval;

//     // Ensure submitBtn exists before attempting to disable it
//     if (!submitBtn) {
//         console.error("submitBtn not found in the DOM.");
//         return;
//     }

//     function checkOtpStatus() {
//         if (!OTPinput) {
//             console.warn("OTP input not found in the DOM.");
//             return; // Exit if element is not found
//         }

//         const otpStatus = OTPinput.value || 'Unverified'; // Default to 'Unverified'
//         console.log(otpStatus);
//         submitBtn.disabled = otpStatus !== 'Verified'; // Only disable submitBtn if it exists
//         console.log("OTPinput value on load: ", OTPinput.value);  // Log the value

//         if (OTPinput) {
//             OTPinput.value = 'Unverified';  // Explicitly set the value
//             console.log("OTPinput value after setting: ", OTPinput.value);  // Log updated value
//         } else {
//             console.error("OTPinput element is not found.");
//         }
//     }

//     // Initialize OTP Status Check
//     checkOtpStatus();

//     // Add Change Listener for OTP Status Input
//     if (OTPinput) {
//         OTPinput.addEventListener('change', checkOtpStatus);
//     }

//     function startOtpTimer() {
//         const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
//         const expiryTimestamp = parseInt(localStorage.getItem(timerKey), 10); // Get expiration timestamp
    
//         if (!expiryTimestamp || currentTime >= expiryTimestamp) {
//             // Timer has expired or not set
//             localStorage.removeItem(timerKey); // Clean up expired key
//             timerDisplay.parentElement.style.display = "none";
//             resendOTPBtn.style.display = "block";
//             clearInterval(timerInterval);
//             return;
//         }
    
//         // Calculate remaining time
//         let timeRemaining = expiryTimestamp - currentTime;
//         timerDisplay.parentElement.style.display = "block";
//         resendOTPBtn.style.display = "none";

//         timerInterval = setInterval(() => {
//             const minutes = Math.floor(timeRemaining / 60);
//             const seconds = timeRemaining % 60;
//             timerDisplay.textContent = `${minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
    
//             timeRemaining--;
    
//             if (timeRemaining < 0) {
//                 clearInterval(timerInterval);
//                 timerDisplay.parentElement.style.display = "none";
//                 resendOTPBtn.style.display = "block";
//                 localStorage.removeItem(timerKey); // Clean up when expired
//             }
//         }, 1000);
//     }
    
//     function handleSendOtp() {
//         const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
//         const expiryTimestamp = currentTime + otpExpiryDuration; // Calculate expiration time
//         localStorage.setItem(timerKey, expiryTimestamp); // Save expiration time in localStorage
//         startOtpTimer(); // Start the timer
//     }
    
//     if (sendOTPBtn) {
//         sendOTPBtn.addEventListener('click', () => {
//             const loadingIndicator = document.getElementById('loading-indicator');
//             loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator
    
//             const email = document.getElementById('emailOTP').value;
                
//             if (!email) {
//                 alert('Please enter an email address.');
//                 return;
//             }
    
//             // Send OTP request to PHP backend
//             fetch('PHPBackend/Verify_OTP.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ action: 'send_otp', email: email }) // Send data as JSON
//             })
//             .then(response => response.json()) // Parse the JSON response
//             .then(data => {
//                 alert(data.message);
//                 if (data.success) {
//                     otpSection.style.display = 'block'; // Show OTP input section
//                     sendOTPBtn.style.display = 'none'; // Hide the send OTP button
//                     handleSendOtp();

//                 } else {
//                     alert(data.message); // Alert message if sending failed
//                 }
//             })
//             .catch(error => {
//                 console.error("Error:", error);
//                 alert("An error occurred while sending OTP.");  
//             })
//             .finally(() => {
//                 loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when email is processed
//             });
//         });
//     } else {
//         console.error('sendOTPBtn not found in the DOM.');
//     }
    

//     resendOTPBtn.addEventListener("click", () => {
//         resendOTPBtn.style.display = "none";
//         sendOTPBtn.click(); // Trigger sending OTP again
//     });


//     // Handle Verify OTP
//     verifyOTPBtn.addEventListener('click', () => {
//         const otp = document.getElementById('EMAILotp').value;
//         const email = document.getElementById('emailOTP').value;

//         if (!otp) {
//             alert('Please enter the OTP.');
//             return;
//         }

//         fetch('PHPBackend/Verify_OTP.php', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify({ action: 'verify_otp', otp: otp, email: email })
//         })
//             .then(response => response.json())
//             .then(data => {
//                 alert(data.message);
//                 if (data.success) {
//                     submitBtn.disabled = false;
//                     otpSection.style.display = 'none';
//                     timerDisplay.parentElement.style.display = "none";
//                     resendOTPBtn.style.display = "none";
//                     clearInterval(timerInterval);
//                     localStorage.removeItem(timerKey); 
//                 }
//             })
//             .catch(error => console.error("Error:", error));
//     });

//     // Start the timer on page load
//     window.addEventListener('load', startOtpTimer);


//     if (SaynapBtn) {
//         console.log("Signup button found");

//         SaynapBtn.addEventListener("click", (event) => {
//             console.log("Signup button clicked");

//             // Prevent default form submission
//             event.preventDefault();

//             const password = document.getElementById("password").value;
//             const confirmPassword = document.getElementById("confirmPassword").value;

//             // Validate new password criteria
//             const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/;
//             if (!passwordRegex.test(password)) {
//                 alert(
//                     "Your password must be at least 6 characters long and include a combination of numbers, letters, and special characters."
//                 );
//                 return; 
//             }


//             // Password match validation
//             if (password !== confirmPassword) {
//                 errorText.textContent = "Passwords do not match.";
//                 errorText.style.display = "block";
//                 console.log("Password mismatch error");

//                 setTimeout(() => {
//                     errorText.style.display = "none";
//                 }, 3000);

//                 return;
//             }

//             const ageInput = document.getElementById("age");
//             const age = parseInt(ageInput.value, 10);

//             if (isNaN(age) || age < 18) {
//                 errorText.textContent = "You must be at least 18 years old to sign up.";
//                 errorText.style.display = "block";
//                 console.log("Age validation failed");
//                 ageInput.value = '';

//                 setTimeout(() => {
//                     errorText.style.display = "none";
//                 }, 3000);   

//                 return;
//             }

//             let formData = new FormData(form);

//             // Debugging: Log all form data entries
//             for (const [key, value] of formData.entries()) {
//                 console.log(`${key}: ${value}`);
//             }

//             let xhr = new XMLHttpRequest();
//             xhr.open("POST", "PHPBackend/Signup.php", true);

//             xhr.onload = () => {
//                 console.log("AJAX request completed");

//                 if (xhr.readyState === XMLHttpRequest.DONE) {
//                     if (xhr.status === 200) {
//                         let data = xhr.response.trim();  // Use trim() to handle unexpected white space
//                         console.log("Response received: ", data);

//                         if (data === "success") {
//                             console.log("Redirecting to LoginPage.php");
//                             // location.reload();
//                             alert("Account Created Successfully");
//                             location.href = "LoginPage.php";

//                         } else {
//                             errorText.textContent = data;
//                             errorText.style.display = "block";
//                             console.log("Error text displayed: ", data);

//                             setTimeout(() => {
//                                 errorText.style.display = "none";
//                             }, 3000);
//                         }
//                     } else {
//                         console.log("Error: Request status not 200");
//                     }
//                 } else {
//                     console.log("Error: XHR readyState is not DONE");
//                 }
//             }

//             xhr.onerror = () => {
//                 console.log("Error: AJAX request failed");
//             }

//             console.log("Form data being sent: ", formData);
//             xhr.send(formData);
//         });
//     } else {
//         console.log("Signup button not found");
//     }
// });

// document.addEventListener("DOMContentLoaded", () => {
//   console.log("Second DOMContentLoaded for checkboxes");

//   const checkYes = document.getElementById("checkYes");
//   const checkNo = document.getElementById("checkNo");

//   checkYes.addEventListener("change", () => {
//       console.log("Yes checkbox changed: ", checkYes.checked);
//       if (checkYes.checked) {
//           checkNo.checked = false;
//           console.log("No checkbox unchecked");
//       }
//   });

//   checkNo.addEventListener("change", () => {
//       console.log("No checkbox changed: ", checkNo.checked);
//       if (checkNo.checked) {
//           checkYes.checked = false;
//           console.log("Yes checkbox unchecked");
//       }
//   });
// });


// // Get all the required inputs
// const requiredInputs = [
//     { id: "fname", name: "First Name" },
//     { id: "lname", name: "Last Name" },
//     { id: "block", name: "Block" },
//     { id: "lot", name: "Lot" },
//     { id: "phonenum", name: "Contact Number" },
//     { id: "dob", name: "Date of Birth" },
//     { id: "age", name: "Age" },
//     { id: "emailOTP", name: "Email" },
// ];

// const genderInputs = document.querySelectorAll('input[name="gender"]');
// const sendOTPBtn = document.getElementById("sendOTPBtn");

// // Function to check if all required inputs are filled
// function validateInputs() {
//     let allFilled = true;

//     console.log("Starting validation check...");

//     // Check all required inputs
//     requiredInputs.forEach((input) => {
//         const field = document.getElementById(input.id);
//         if (!field || !field.value.trim()) {
//             console.log(`${input.name} is empty or invalid.`);
//             allFilled = false;
//         } else {
//             console.log(`${input.name} has a valid value: ${field.value}`);
//         }
//     });

//     // Check if a gender is selected
//     const genderSelected = Array.from(genderInputs).some((input) => input.checked);
//     if (!genderSelected) {
//         console.log("Gender is not selected.");
//         allFilled = false;
//     } else {
//         console.log("Gender is selected.");
//     }

//     // Show or hide the Send OTP button based on validation
//     if (allFilled) {
//         sendOTPBtn.style.display = "block";
//         console.log("All inputs are valid. Send OTP button is now visible.");
//     } else {
//         sendOTPBtn.style.display = "none";
//         console.log("Not all inputs are valid. Send OTP button is hidden.");
//     }
// }

// // Add blur event listeners to inputs for validation
// requiredInputs.forEach((input) => {
//     const field = document.getElementById(input.id);
//     if (field) {
//         field.addEventListener("blur", () => {
//             console.log(`Blur event triggered on ${input.name}.`);
//             validateInputs();
//         });
//     }
// });

// // Add change event listeners for gender radio buttons
// genderInputs.forEach((input) => {
//     input.addEventListener("change", () => {
//         console.log("Change event triggered for gender selection.");
//         validateInputs();
//     });
// });

// // Initial validation check
// validateInputs();

document.addEventListener("DOMContentLoaded", () => {
    const checkYes = document.getElementById('checkYes');
    const checkNo = document.getElementById('checkNo');

    // Event listener for the "Yes" checkbox
    checkYes.addEventListener('change', () => {
        if (checkYes.checked) {
            checkNo.checked = false; // Uncheck "No" if "Yes" is checked
        }
    });

    // Event listener for the "No" checkbox
    checkNo.addEventListener('change', () => {
        if (checkNo.checked) {
            checkYes.checked = false; // Uncheck "Yes" if "No" is checked
        }
    });
});


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

// Function to show success notifications
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


function validatePhoneNumber(input) {
    // Ensure the input always starts with +63
    if (!input.value.startsWith("+63")) {
        input.value = "+63";
    }

    // Allow only numbers after +63 and limit the length to 10 digits
    const phoneNumber = input.value.slice(3).replace(/[^0-9]/g, '').slice(0, 10);

    // Update the input value
    input.value = "+63" + phoneNumber;
}



// let allFilled = true;

function calculateAge() {
    console.log("calculateAge function called");

    const dob = document.getElementById('dob').value;
    const ageInput = document.getElementById('age');
    const seniorInput = document.getElementById('senior');
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

        // If age is 60 or above, set the 'Senior' input field
        if (age >= 60) {
            seniorInput.value = "Senior";
            console.log("Age is 60 or above, Senior status set.");
        } else {
            seniorInput.value = ''; // Clear Senior field if age is below 60
        }

        return true;  // Age is valid
    } else {
        ageInput.value = '';
        seniorInput.value = ''; // Clear Senior field if DOB is not provided
        console.log("DOB not provided, age and Senior input cleared");
        return false; // Invalid if DOB is missing
    }
}

  


// Function to check required inputs
function checkRequiredInputs(form) {
    const requiredInputs = form.querySelectorAll('.SignUpInput[required], .dropdown-button[required]');
    allFilled = true;

    requiredInputs.forEach((input) => {
        let errorMessage = "";
        let labelText = "";

        // Get the label text
        const label = form.querySelector(`label[for="${input.id}"]`);
        if (label) {
            labelText = label.textContent.trim();
        }

        // Validate dropdown
        if (input.classList.contains("dropdown-button")) {
            const selectedValue = input.dataset.value; // Assuming `data-value` holds the selected option
            if (!selectedValue) {
                allFilled = false;
                errorMessage = "Please select your Gender.";
                showErrorNotification(errorMessage);
            }
        }
    });

    const fname = document.getElementById("fname");
    if (fname && fname.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your First name.";
        showErrorNotification(errorMessage);
    }
    const lname = document.getElementById("lname");
    if (lname && lname.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your Last name.";
        showErrorNotification(errorMessage);
    }
    const dob = document.getElementById("dob");
    if (dob && dob.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your Birth date.";
        showErrorNotification(errorMessage);
    }
    const age = document.getElementById("age");
    if (age && age.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your Age.";
        showErrorNotification(errorMessage);
    }
    const block = document.getElementById("block");
    if (block && block.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your Block.";
        showErrorNotification(errorMessage);
    }
    const lot = document.getElementById("lot");
    if (lot && lot.value.trim() === "") {
        allFilled = false;
        const errorMessage = "Please enter your Lot.";
        showErrorNotification(errorMessage);
    }


    // Validate checkbox groups
    const checkboxes = form.querySelectorAll('input[type="checkbox"][name="disabilities"]');
    if (checkboxes.length > 0) {
        const checked = Array.from(checkboxes).some((box) => box.checked);
        if (!checked) {
            allFilled = false;
            showErrorNotification("Please indicate if you have disabilities.");
        }
    }

    // Check if email is valid (Gmail or Yahoo only)
    const emailInput = form.querySelector('.emailed');
    if (emailInput) {
        const emailValue = emailInput.value.trim();
        if (emailValue === "") {
            allFilled = false;
            showErrorNotification("Email is required.");
        } else {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/;
            if (!emailPattern.test(emailValue)) {
                allFilled = false;
                showErrorNotification("Please enter a valid email address (Gmail or Yahoo only).");
            }
        }
    }

    // Check if password fields are empty or do not match
    const passwordInput = form.querySelector('#Pass');
    const confirmPasswordInput = form.querySelector('#Pass2');
    if (passwordInput) {
        const passwordValue = passwordInput.value.trim();
        if (passwordValue === "") {
            allFilled = false;
            showErrorNotification("Password is required.");
        }
    }

    if (confirmPasswordInput) {
        const confirmPasswordValue = confirmPasswordInput.value.trim();
        if (confirmPasswordValue === "") {
            allFilled = false;
            showErrorNotification("Confirm Password is required.");
        } else if (passwordInput && passwordInput.value !== confirmPasswordInput.value) {
            allFilled = false;
            showErrorNotification("Passwords do not match.");
        }
    }


    return allFilled;
}

// Hide error notifications when focusing on inputs
document.querySelectorAll('.SignUpInput').forEach(input => {
    input.addEventListener('focus', () => {
        const errorNotifications = document.querySelector('.errorNotifications');
        errorNotifications.innerHTML = ''; // Clear all error notifications
    });
});

// Function to toggle form visibility and check for errors
function toggleFormsVisibility(form) {
    const emailForm = document.querySelector(".EmailForm");
    const personalDetailsForm = document.querySelector(".PersonalDetails");

    if (checkRequiredInputs(form)) {
        if (form.classList.contains("PersonalDetails")) {
            personalDetailsForm.style.display = "none";
            emailForm.style.display = "block";
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const personalDetailsForm = document.querySelector(".PersonalDetails");
    const emailForm = document.querySelector(".EmailForm");
    const otpForm = document.querySelector(".OtpForm");

    // Buttons
    const nextBtnPersonalDetails = document.querySelector(".PersonalDetails .NextBtn");
    const backBtnEmailForm = document.querySelector(".EmailForm .backEmail");
    const backOTPEmail = document.getElementById("backOTPEmail");
    const sendBtnEmailForm = document.getElementById("sendOTPButton");

    // Function to check required inputs
    function checkRequiredInputs(form) {
        const inputs = form.querySelectorAll("input[required]");
        return Array.from(inputs).every((input) => input.value.trim() !== "");
    }

    // Personal Details Next Button Logic
    if (nextBtnPersonalDetails) {
        nextBtnPersonalDetails.addEventListener("click", (e) => {
            e.preventDefault();

            const age = document.getElementById("age").value;
            if (parseInt(age) < 18) {
                showErrorNotification("You must be at least 18 years old.");
                return;
            }

            const phoneInput = document.getElementById("phonenum");
            const phoneNumber = phoneInput.value.slice(3);
            if (phoneNumber.length < 10) {
                showErrorNotification("The phone number must be exactly 11 digits long.");
                return;
            }

            if (checkRequiredInputs(personalDetailsForm)) {
                personalDetailsForm.style.display = "none";
                emailForm.style.display = "block";
            } else {
                showErrorNotification("Please complete all required fields.");
            }
        });
    }

    // Email Form Back Button Logic
    if (backBtnEmailForm) {
        backBtnEmailForm.addEventListener("click", (e) => {
            e.preventDefault();
            emailForm.style.display = "none";
            personalDetailsForm.style.display = "block";
        });
    }

    if (backOTPEmail) {
        backOTPEmail.addEventListener("click", (e) => {
            e.preventDefault();
            otpForm.style.display = "none";
            emailForm.style.display = "block";
        });
    }

    // Send OTP Button Logic
    if (sendBtnEmailForm) {
        sendBtnEmailForm.addEventListener("click", (e) => {
            e.preventDefault();

            // Validate email
            const emailInput = emailForm.querySelector(".emailed");
            if (emailInput) {
                const emailValue = emailInput.value.trim();
                if (emailValue === "") {
                    showErrorNotification("Email is required.");
                    return;
                } else {
                    const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/;
                    if (!emailPattern.test(emailValue)) {
                        showErrorNotification("Please enter a valid email address (Gmail or Yahoo only).");
                        return;
                    }
                }
            }

            // Validate password
            const passwordInput = emailForm.querySelector("#Pass");
            const confirmPasswordInput = emailForm.querySelector("#Pass2");
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            if (!passwordPattern.test(password)) {
                showErrorNotification("Password does not meet the required criteria.");
                return;
            }

            if (password !== confirmPassword) {
                showErrorNotification("Passwords do not match. Please try again.");
                return;
            }

            // Validate phone number
            const phoneInput = document.querySelector("#phonenum");
            const phoneValue = phoneInput.value.trim();
            const remainingNumber = phoneValue.slice(3);

            if (remainingNumber.length !== 10 || isNaN(remainingNumber)) {
                showErrorNotification("Phone number must have exactly 10 digits after +63.");
                return;
            }

            // Check required inputs
            if (!checkRequiredInputs(emailForm)) {
                showErrorNotification("Please complete all required fields before proceeding.");
                return;
            }

            // Success Logic
            console.log("All fields are valid. Proceeding to OTP...");
            showSuccessNotification("All fields are valid! Redirecting to OTP form...");

            // Hide the email form and show the OTP form
            emailForm.style.display = "none";
            otpForm.style.display = "block";

            // Setup OTP handlers
            setupOTPHandlers(() => {
                console.log("OTP process completed.");
            });
        });
    } else {
        console.error("Send button in Email Form not found!");
    }
});



// Define the function
function setupOTPHandlers() {
    const personalDetailsForm = document.querySelector(".PersonalDetails");
    const emailForm = document.querySelector(".EmailForm");
    const OtpForm = document.querySelector(".OtpForm");

    const testBTN = document.getElementById("testBTN");
    const sendOTPButton = document.getElementById("sendOTP");
    const verifyOTPButton = document.getElementById("verifyOTP");
    const emailOTP = document.querySelector("#emailOTP");
    const otpInput = document.querySelector("#beripayOTP");
    const emailParag = document.querySelector(".OtpParagg");
    const sentEmailSpan = document.getElementById("sentEmail");

    // Function to show error notifications
    function showErrorNotification(message) {
        console.log(message); // Replace with a styled notification if needed
    }

    // Function to show success notifications
    function showSuccessNotification(message) {
        console.log(message); // Replace with a styled notification if needed
    }


    if (testBTN) {
        testBTN.addEventListener("click", () => {
            submitFormData();
        });
    } else {
        console.error(" button not found!");
    }

    // Send OTP logic
    if (sendOTPButton) {
        sendOTPButton.addEventListener("click", () => {
            const loadingIndicator = document.getElementById('loading-indicator');
                  loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator

            const email = emailOTP?.value.trim();
            if (!email) {
                showErrorNotification("Please enter your email.");
                return;
            }

            // Send request to send OTP
            fetch("PHPBackend/Verify_OTP.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    action: "sendOTP",
                    email: email
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("OTP sent successfully.");
                        emailForm.style.display = "none";
                        personalDetailsForm.style.display = "none";
                        OtpForm.style.display = "block";
                        // Update and display the email paragraph
                        sentEmailSpan.textContent = email;
                        emailParag.style.display = "block";
                        alert("OTP sent successfully.");
                        showSuccessNotification(data.message);
                    } else {
                        showErrorNotification(data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    showErrorNotification("Failed to send OTP. Please try again.");
                })
                .finally(() => {
                loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when email is processed
            });
        });
    }
    //  else {
    //     console.error("Send OTP button not found!");
    // }

    // Verify OTP logic
if (verifyOTPButton) {
    verifyOTPButton.addEventListener("click", () => {
        const loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator

        const otp = otpInput.value.trim(); // Get OTP input value
        console.log("OTP input value:", otp); // Debugging the OTP input value

        // Validate OTP: Check if it's exactly 6 digits
        const otpPattern = /^[0-9]{6}$/; // Regex for 6-digit number

        if (!otpPattern.test(otp)) {
            console.log("OTP failed regex check");
            showErrorNotification("Please enter a valid 6-digit OTP.");
            return;
        }

        // Send request to verify OTP
        fetch("PHPBackend/Verify_OTP.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                action: "verifyOTP",
                otp: otp
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Response from OTP verification:", data);
                if (data.success) {
                    alert("OTP verified successfully. Registration Complete");

                    // alert("Sign-up successful! Reloading...");
                    //     // Reload page only after notification is removed
                    //     location.reload();
                    
                } else {
                    showErrorNotification(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showErrorNotification("Failed to verify OTP. Please try again.");
           
            })
            .finally(() => {
                loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when email is processed
        });
    });

    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        alert("Session has been cleared. Please request a new OTP.");
    }
} else {
        console.error("Verify OTP button not found!");
    }
}

function submitFormData() {
    const formData = new FormData();

    // Collect all the form data that you want to send to the server
    formData.append('fname', document.querySelector('#fname').value);
    formData.append('mname', document.querySelector('#mname').value);
    formData.append('lname', document.querySelector('#lname').value);
    formData.append('suffix', document.querySelector('#suffix').value);

    // Get the selected gender from the dropdown button text
    const selectedGender = document.querySelector('.dropdown-button').textContent.trim();

    console.log("Selected gender:", selectedGender); // Debugging log

    // If no gender is selected, alert and stop form submission
    if (selectedGender === 'Select Option' || selectedGender === '') {
        alert("Please select a gender.");
        return; // Prevent form submission if no gender is selected
    }

    // Append the selected gender to formData
    formData.append('gender', selectedGender);

    formData.append('dob', document.querySelector('#dob').value);
    formData.append('age', document.querySelector('#age').value);
    formData.append('phonenum', document.querySelector('#phonenum').value);
    formData.append('block', document.querySelector('#block').value);
    formData.append('lot', document.querySelector('#lot').value);
    formData.append('street', document.querySelector('#street').value);
    formData.append('email', document.querySelector('#emailOTP').value);
    formData.append('password', document.querySelector('#Pass').value);

    // Handle disabilities checkbox (Yes or No)
    const disabilitiesYes = document.querySelector('#checkYes').checked;
    const disabilitiesNo = document.querySelector('#checkNo').checked;
    
    // We assume that at least one checkbox will be checked, and it can't be both
    if (disabilitiesYes) {
        formData.append('disabilities', 'Yes');
    } else if (disabilitiesNo) {
        formData.append('disabilities', 'No');
    } else {
        formData.append('disabilities', ''); // If neither checkbox is selected (shouldn't happen)
    }


    const loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.setProperty('display', 'flex', 'important');
    // Send the form data to the server
    fetch('PHPBackend/Signup2.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Proceed with further steps if needed
            } else {
                alert(data.message); // Display the error message from the backend
            }
        })
    .catch(error => {
        console.error("Error:", error);
        showErrorNotification("Failed to submit registration data. Please try again.");
    })
    .finally(() => {
        loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when email is processed
});
}


// let timer;
// let timerValue = 60; // Countdown from 60 seconds

// function startOTPTimer() {
//     const timerDisplay = document.querySelector("#otpTimer");
//     const resendBtn = document.querySelector(".resendOTP");

//     // Show the timer when countdown starts
//     timerDisplay.classList.remove("hidden");

//     // Initially hide the "Resend OTP" button
//     resendBtn.classList.add("hidden");

//     timer = setInterval(() => {
//         if (timerValue <= 0) {
//             // Stop the timer when it reaches 0
//             clearInterval(timer);
//             resendBtn.classList.remove("hidden"); // Show the resend button
//             timerDisplay.textContent = "Time's up! You can resend OTP now.";
//         } else {
//             // Calculate minutes and seconds
//             const minutes = Math.floor(timerValue / 60);
//             const seconds = timerValue % 60;

//             // Format the timer as MM:SS (e.g., 1:00)
//             timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
//         }
//         timerValue--; // Decrease the timer by 1 second
//     }, 1000);
// }

// function resendOTP() {
//     // Here you can call the function to resend OTP (the same function that sends the OTP)
//     console.log("Resending OTP...");

//     // Reset timer for the next OTP resend
//     timerValue = 60;
//     startOTPTimer();
// }

