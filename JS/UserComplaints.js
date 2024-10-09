// FUNCTION PARA SA PAGLABAS NG DROPDOWN CHAT 
document.addEventListener("DOMContentLoaded", function() {
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');

    // Dropdown & Rotation Functionality
    function toggleSubMenu() {
        complaintsSubMenu.classList.toggle('submenu-visible');
        eme2.classList.toggle('eme2-rotate');
    }

    buttonEme2.addEventListener('click', function(event) {
        event.preventDefault();
        toggleSubMenu();
    });
});

// FUNCTION PARA SA PROFILE 
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

// FUNCTION PARA SA DROPDOWN COMPLAINT 
function toggleDropdown() {
    const dropdown = document.querySelector('.dropdownInput');
    const dropdownContent = dropdown.querySelector('.dropdownContentInput');
    const isOpen = dropdown.classList.contains('open');

    if (isOpen) {
        dropdownContent.style.display = 'none';
        dropdown.classList.remove('open');
    } else {
        dropdownContent.style.display = 'block';
        dropdown.classList.add('open');
    }
}

// Add event listeners to the input field and button
document.querySelector('.dropdownInputField').addEventListener('click', toggleDropdown);
document.querySelector('.dropbtnInput').addEventListener('click', toggleDropdown);

// Function to handle selecting an item from the dropdown
function selectComplaint(value) {
    document.getElementById('selectedComplaint').value = value;
    // Close the dropdown after selection
    const dropdown = document.querySelector('.dropdownInput');
    dropdown.classList.remove('open');
    dropdown.querySelector('.dropdownContentInput').style.display = 'none';
}

// Function ng submit ng complaint
document.getElementById('Submit').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission or page reload

    // Get values from inputs
    const complainee = document.getElementById('Complainee').value;
    const complaint = document.getElementById('selectedComplaint').value;
    const description = document.getElementById('Description').value;
    const proof = document.getElementById('Proof').files[0]; // Get file input

    // Extract just the file name (if a file is selected)
    let proofFileName = proof ? proof.name : null;

    // Prepare the data to be sent via AJAX
    let formData = new FormData();
    formData.append('complainee', complainee);
    formData.append('complaint', complaint);
    formData.append('description', description);
    formData.append('proof', proofFileName); // Send the file name

    // Create an XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    
    // Open the request
    xhr.open('POST', 'PHPBackend/Complaint.php', true);

    // Set up a function to handle the response
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Success response from PHP
            console.log(xhr.responseText);
            alert('Complaint submitted successfully!');
        } else {
            // Error response
            console.error('Error: ' + xhr.status);
            alert('There was an issue submitting the complaint.');
        }
    };

    // Send the request with the form data
    xhr.send(formData);
});

