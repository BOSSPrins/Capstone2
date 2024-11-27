// Modal functionality (unchanged)
const profModal = document.getElementById("profileModal");
const profModalBtn = document.getElementById("myProfileBtn");
const spanEkis = document.getElementsByClassName("closeProf")[0];

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
    const pages = document.getElementsByClassName("page");
    for (var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("activeProfModal");
    }
    document.getElementById(pageName).classList.add("activeProfModal");
}


// PROFILE NG NAGAMIT 
document.getElementById('myProfileBtn').addEventListener('click', function() {
    const uniqueIdInput = document.getElementById('fetchUID');
    const uniqueId = uniqueIdInput?.value;
    console.log('Unique ID:', uniqueId);

    if (uniqueId) {
        const action = 'fetch_user_data';
        
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Set up the request: POST method, and the URL
        xhr.open('POST', 'PHPBackend/ProfileAccount.php', true);
        
        // Set the request header for form data (ensure content type is correct)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Create a URL-encoded string of parameters
        const params = `unique_id=${encodeURIComponent(uniqueId)}&action=${encodeURIComponent(action)}`;

        // Set the onload function to handle the server response
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Parse the JSON response
                const data = JSON.parse(xhr.responseText);
                if (data.success) {
                    // Populate the fields with data or set them to 'N/A' if not available
                    document.getElementById('fname').value = data.fname || 'N/A';
                    document.getElementById('mname').value = data.mname || 'N/A';
                    document.getElementById('lname').value = data.lname || 'N/A';
                    document.getElementById('suffix').value = data.suffix || 'N/A';
                    document.getElementById('bday').value = data.bday || 'N/A';
                    document.getElementById('age').value = data.age || 'N/A';
                    document.getElementById('sex').value = data.sex || 'N/A';
                    document.getElementById('contNum').value = data.contact_number || 'N/A';
                    document.getElementById('blk').value = data.block || 'N/A';
                    document.getElementById('lot').value = data.lot || 'N/A';
                    document.getElementById('street').value = data.street || 'N/A';
                    document.getElementById('ecName').value = data.ec_name || 'N/A';
                    document.getElementById('ecPhoneNum').value = data.ec_phone_number || 'N/A';
                    document.getElementById('relasyon').value = data.relationship || 'N/A';
                    document.getElementById('ecAddress').value = data.ec_address || 'N/A';

                    if (data.pwd === 'Yes') {
                        document.getElementById('pwdYes').checked = true;
                        document.getElementById('pwdNo').checked = false;
                    } else if (data.pwd === 'No') {
                        document.getElementById('pwdYes').checked = false;
                        document.getElementById('pwdNo').checked = true;
                    } else {
                        // In case there's no value or invalid value in "pwd"
                        document.getElementById('pwdYes').checked = false;
                        document.getElementById('pwdNo').checked = false;
                    }
                } else {
                    console.error('No data found for this user.');
                }
            } else {
                console.error('Error fetching user data: ' + xhr.status);
            }
        };

        // Set the onerror function to handle network errors
        xhr.onerror = function() {
            console.error('Request failed');
        };

        // Send the request with the parameters
        xhr.send(params);

    } else {
        console.error('Unique ID is not available.');
    }
});


// Sa profile ng update
document.addEventListener('DOMContentLoaded', () => {
    const editButton = document.getElementById('editButton');
    const updateButton = document.getElementById('updateButton');
    const cancelButton = document.getElementById('cancelButton');
    const inputs = document.querySelectorAll('#EditProfile input');
    const form = document.getElementById('editProfileForm');

    editButton.addEventListener('click', () => {
        inputs.forEach(input => {
            // Keep blk, lot, and street fields readonly
            if (input.id !== 'blk' && input.id !== 'lot' && input.id !== 'street') {
                input.removeAttribute('readonly');
            }
        });
        editButton.style.display = 'none';
        updateButton.style.display = 'inline-block';
        cancelButton.style.display = 'inline-block';
    
        document.getElementById('pwdYes').disabled = false;
        document.getElementById('pwdNo').disabled = false;
    });

    document.getElementById('updateButton').addEventListener('click', function(event) {
        const uniqueId = document.getElementById('fetchUID').value;

        const formData = new FormData(form);
        formData.append('action', 'update_user_data');
        formData.append('unique_id', uniqueId);
    
        fetch('PHPBackend/ProfileAccount.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the response for debugging
    
            if (data.success) {
                alert('Profile updated successfully');
                toggleButtons();
                resetCheckboxState();
                inputs.forEach(input => input.setAttribute('readonly', 'true'));
            } else {
                alert('Failed to update profile: ' + (data.message || 'No message returned'));
                console.log('Failed to update profile: ' + (data.message || 'No message returned'));
            }
        })
        .catch(error => {
            console.error('Error updating profile:', error);
        });
    });

    document.getElementById('cancelButton').addEventListener('click', function(event) {
        event.preventDefault();
        inputs.forEach(input => input.setAttribute('readonly', 'true'));
        toggleButtons();
        resetCheckboxState();
    });

    function toggleButtons() {
        editButton.style.display = 'inline-block';
        updateButton.style.display = 'none';
        cancelButton.style.display = 'none';
    }

    function resetCheckboxState() {
        const pwdYes = document.getElementById('pwdYes');
        const pwdNo = document.getElementById('pwdNo');

        pwdYes.checked = pwdYes.defaultChecked;
        pwdNo.checked = pwdNo.defaultChecked;

        pwdYes.disabled = true;
        pwdNo.disabled = true;
    }
});

//Sa palit ng email
document.getElementById('submitEmail').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = document.getElementById('formEmail');
    const oldEmail = document.getElementById('oldEmail').value;
    const newEmail = document.getElementById('newEmail').value;
    console.log('Old Email:', oldEmail); 

    // Ensure the new email is not empty and has the correct domain
    if (!newEmail) {
        alert('Please enter a new email');
        return;
    }

    if (!newEmail.endsWith('@gmail.com')) {
        alert('Please enter a valid Gmail email address');
        return;
    }

    // Create FormData object to send the data
    const formData = new FormData(form);
    formData.append('action', 'updateEmail'); // Action parameter
    formData.append('oldEmail', oldEmail);
    formData.append('newEmail', newEmail);

    // Send AJAX request to PHP script
    fetch('PHPBackend/ProfileAccount.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse the JSON response from the PHP script
    .then(data => {
        if (data.success) {
            alert('Email updated successfully!');
            // Optionally, update the session email or page without reloading
            // document.getElementById('oldEmail').value = newEmail; // Update the displayed old email
        } else {
            alert('Failed to update email: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error updating email:', error);
        alert('There was an error processing your request.');
    });
});


// Change pass na
document.getElementById("profileChangePass").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    const form = document.getElementById("profileChangePass");
    const oldPass = document.getElementById("OldPass").value;
    const newPass = document.getElementById("NewPass").value;
    const confirmNewPass = document.getElementById("confirmNewPass").value;

    // Check if old password is provided
    if (!oldPass) {
        alert("Please enter your current password.");
        return;
    }

    // Validate new password criteria
    const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/;
    if (!passwordRegex.test(newPass)) {
        alert(
            "Your password must be at least 6 characters long and include a combination of numbers, letters, and special characters."
        );
        return;
    }

    // Check if the new passwords match
    if (newPass !== confirmNewPass) {
        alert("New password and confirmation do not match.");
        return;
    }

    // Create FormData object to send data
    const formData = new FormData(form);
    formData.append("action", "changePassword");
    formData.append("oldPass", oldPass);
    formData.append("newPass", newPass);

    // Send AJAX request to PHP
    fetch("PHPBackend/ProfileAccount.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log('Response Data:', data);
            if (data.success) {
                alert("Password updated successfully!");
                // Optionally reset the form
                // document.getElementById("profileChangePass").reset();
            } else {
                alert("Failed to update password: " + data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error processing your request.");
        });
});

