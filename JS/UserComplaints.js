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
    event.preventDefault();

    const complainee = document.getElementById('Complainee').value;
    const ComplaineeAddress = document.getElementById('ComplaineeAddress').value;

    const ComplainantUID = document.getElementById('ComplainantUID').value;
    const ComplainantName = document.getElementById('ComplainantName').value;
    const ComplainantAddress = document.getElementById('ComplainantAddress').value;

    const complaint = document.getElementById('selectedComplaint').value;
    const description = document.getElementById('Description').value;

    const proofInput = document.getElementById('Proof');
    let proofFileName = '';

    // Check if the file input exists and has files
    if (proofInput && proofInput.files && proofInput.files.length > 0) {
        proofFileName = proofInput.files[0].name; // Retrieve file name
    }

    let formData = new FormData();
    formData.append('action', 'submit_complaint');
    formData.append('complainee', complainee);
    formData.append('ComplaineeAddress', ComplaineeAddress);
    formData.append('ComplainantUID', ComplainantUID);
    formData.append('ComplainantName', ComplainantName);
    formData.append('ComplainantAddress', ComplainantAddress);
    formData.append('complaint', complaint);
    formData.append('description', description);
    
    if (proofFileName) {
        formData.append('proofFileName', proofInput.files[0]); // Append the actual file
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/Complaint.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            alert(response.success ? response.message : response.error);
        } else {
            alert('There was an issue submitting the complaint.');
        }
    };

    xhr.send(formData);
});


