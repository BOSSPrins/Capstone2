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


// FUNCTION PARA SA PAGES NG TABLE LIST AT FILE NEW COMPLAINTS 
function togglePageNewAndTbl(pageId) {
    // Hide all containers
    const pages = document.querySelectorAll('.ContainerForComplaints');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected container
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'flex'; // Use flex to maintain the layout
    }

    // Store the active page in local storage
    localStorage.setItem('activeComplaintContainer', pageId);
}

// Check local storage on page load to determine which container to show
window.onload = function() {
    const activeContainer = localStorage.getItem('activeComplaintContainer');
    togglePageNewAndTbl(activeContainer || 'tblConforComplaints'); // Default to 'tblConforComplaints'
}

// FUNCTION PARA SA STATUS CHANGE DROPDOWN 
// This function toggles the visibility of the dropdown options
function toggleType() {
    const dropdown = document.querySelector('.TypedropOptions');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

// This function sets the selected option, hides the dropdown, and shows the corresponding content
function setType(type) {
    const typeDisplay = document.querySelector('.TypeDisplay');
    typeDisplay.textContent = type;  // Set the text of the selected type
    document.querySelector('.TypedropOptions').style.display = 'none';  // Hide the dropdown

    // Hide both content sections
    document.getElementById('generalContent').style.display = 'none';
    document.getElementById('directContent').style.display = 'none';

    // Show the corresponding content based on the selected type
    if (type === 'General Complaint') {
        document.getElementById('generalContent').style.display = 'block';
    } else if (type === 'Direct Complaint') {
        document.getElementById('directContent').style.display = 'block';
    }
}


// FUNCTION PARA SA PAG UPLOAD NG PICTURES DIRECT
// When the file-upload-container is clicked, trigger the file input dialog
document.querySelector('.file-upload-container').addEventListener('click', function() {
    document.querySelector('.inputFile').click();  // Open the file selection dialog
});

// Handle file input change (when files are selected)
document.querySelector('.inputFile').addEventListener('change', function(event) {
    let fileList = event.target.files;
    let imagePreviewContainer = document.getElementById('imagePreviewContainer');

    // Clear previous previews
    imagePreviewContainer.innerHTML = '';

    // Iterate over selected files and preview them
    Array.from(fileList).forEach(file => {
        const reader = new FileReader();
        
        if (file.type.startsWith('image/')) {
            reader.onload = function(e) {
                // Create an image element to display the image thumbnail
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('image-preview');
                
                // Add an event listener to the image for opening the lightbox
                imgElement.addEventListener('click', function() {
                    openLightbox(e.target.result);
                });

                // Create a wrapper for the image with a remove option
                const wrapper = document.createElement('div');
                wrapper.classList.add('image-preview-wrapper');
                
                // Add the image to the wrapper
                wrapper.appendChild(imgElement);

                // Add a remove icon
                const removeIcon = document.createElement('span');
                removeIcon.classList.add('remove-image');
                removeIcon.textContent = '×';
                
                // Add remove functionality to the icon
                removeIcon.addEventListener('click', function() {
                    wrapper.remove();
                });

                // Append the wrapper to the container
                wrapper.appendChild(removeIcon);
                imagePreviewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        } else {
            // If it's not an image, display the file name
            const fileNameElement = document.createElement('div');
            fileNameElement.classList.add('file-name');
            fileNameElement.textContent = file.name;
            imagePreviewContainer.appendChild(fileNameElement);
        }
    });
});

// Open the lightbox with the image
function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    lightbox.style.display = 'flex';
    lightboxImage.src = src;
}

// Close the lightbox when clicking the close button
document.getElementById('closeLightbox').addEventListener('click', function() {
    document.getElementById('lightbox').style.display = 'none';
});

// Close the lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(event) {
    if (event.target === document.getElementById('lightbox')) {
        document.getElementById('lightbox').style.display = 'none';
    }
});


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


// FUNCTION PARA SA DROPDOWN COMPLAINT 
function toggleDropdownGen() {
    const dropdownGen = document.querySelector('.dropdownInputGen');
    const dropdownContentGen = dropdownGen.querySelector('.DropContentInputGen');
    const isBukas = dropdownGen.classList.contains('Buksan'); // Check if 'Buksan' class exists

    if (isBukas) {
        dropdownContentGen.style.display = 'none';
        dropdownGen.classList.remove('Buksan'); // Remove the 'Buksan' class to close the dropdown
    } else {
        dropdownContentGen.style.display = 'block';
        dropdownGen.classList.add('Buksan'); // Add the 'Buksan' class to open the dropdown
    }
}

// Add event listeners to the input field and button
document.querySelector('.InputFiledGen').addEventListener('click', toggleDropdownGen);
document.querySelector('.BtnInputGendrop').addEventListener('click', toggleDropdownGen);

// Function to handle selecting an item from the dropdown
function selectGenComplaint(value) {
    // Set the value of the input field to the selected complaint
    const inputField = document.getElementById('selectGenComplaintInput');
    inputField.value = value;

    // Close the dropdown after selection
    const dropdownGen = document.querySelector('.dropdownInputGen');
    dropdownGen.classList.remove('Buksan');
    dropdownGen.querySelector('.DropContentInputGen').style.display = 'none';
}


// FUNCTION PARA SA PAG UPLOAD NG PICTURES GENERAL COMPLAINT
// When the file-upload-container is clicked, trigger the file input dialog
document.querySelector('.FileUploadCont').addEventListener('click', function() {
    document.querySelector('.InputFileGen').click();  // Open the file selection dialog
});

// Handle file input change (when files are selected)
document.querySelector('.InputFileGen').addEventListener('change', function(event) {
    let fileList = event.target.files;
    let imagePreviewContainer = document.querySelector('.ImagePreviewCon');

    // Clear previous previews
    imagePreviewContainer.innerHTML = '';

    // Iterate over selected files and preview them
    Array.from(fileList).forEach(file => {
        const reader = new FileReader();
        
        if (file.type.startsWith('image/')) {
            reader.onload = function(e) {
                // Create an image element to display the image thumbnail
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('imagePreviewGenn');
                
                // Add an event listener to the image for opening the lightbox
                imgElement.addEventListener('click', function() {
                    openLightbox(e.target.result);
                });

                // Create a wrapper for the image with a remove option
                const wrapper = document.createElement('div');
                wrapper.classList.add('imagePreview-WrapperGen');
                
                // Add the image to the wrapper
                wrapper.appendChild(imgElement);

                // Add remove icon
                const removeIcon = document.createElement('span');
                removeIcon.classList.add('removeImageProofGen');
                removeIcon.textContent = '×';
                
                // Add remove functionality to the icon
                removeIcon.addEventListener('click', function() {
                    wrapper.remove();
                });

                // Append the wrapper to the container
                wrapper.appendChild(removeIcon);
                imagePreviewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        } else {
            // If it's not an image, display the file name
            const fileNameElement = document.createElement('div');
            fileNameElement.classList.add('fileNameGen');
            fileNameElement.textContent = file.name;
            imagePreviewContainer.appendChild(fileNameElement);
        }
    });
});

// Open the lightbox with the image
function openLightbox(src) {
    const lightbox = document.querySelector('.lightboxGen');
    const lightboxImage = document.querySelector('.LarawanContainer');
    lightbox.style.display = 'flex';
    lightboxImage.src = src;
}

// Close the lightbox when clicking the close button
document.querySelector('.LightBoxClose').addEventListener('click', function() {
    document.querySelector('.lightboxGen').style.display = 'none';
});

// Close the lightbox when clicking outside the image
document.querySelector('.lightboxGen').addEventListener('click', function(event) {
    if (event.target === document.querySelector('.lightboxGen')) {
        document.querySelector('.lightboxGen').style.display = 'none';
    }
});

// Function to handle selecting a complaint type
function selectGenComplaint(value) {
    const inputField = document.querySelector('#selectGenComplaintInput');
    inputField.value = value;

    // Close the dropdown after selection
    const dropdownGen = document.querySelector('.dropdownInputGen');
    dropdownGen.classList.remove('Buksan');
    dropdownGen.querySelector('.DropContentInputGen').style.display = 'none';
}

// Toggle the dropdown visibility
function toggleDropdownGen() {
    const dropdownGen = document.querySelector('.dropdownInputGen');
    const dropdownContentGen = dropdownGen.querySelector('.DropContentInputGen');
    const isBukas = dropdownGen.classList.contains('Buksan'); 

    if (isBukas) {
        dropdownContentGen.style.display = 'none';
        dropdownGen.classList.remove('Buksan');
    } else {
        dropdownContentGen.style.display = 'block';
        dropdownGen.classList.add('Buksan');
    }
}

// Event listeners to toggle the dropdown
document.querySelector('.InputFiledGen').addEventListener('click', toggleDropdownGen);
document.querySelector('.BtnInputGendrop').addEventListener('click', toggleDropdownGen);



// DUNCTION PARA SA PAG SHOW NG MODAL TRACKING
// Get the modal, button, and close button elements
const modalViewDetails = document.querySelector('.ModalNato');
const btn = document.getElementById('viewDetailsBtn');
const closeModalButton = document.querySelector('.PagEkis');

// Show the modal when the "View Details" button is clicked
btn.addEventListener('click', function() {
    modalViewDetails.style.display = 'flex';  // Show modal
});

// Close the modal when the "X" button is clicked
closeModalButton.addEventListener('click', function() {
    modalViewDetails.style.display = 'none';  // Hide modal
});

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function(event) {
    if (event.target === modalViewDetails) {
        modalViewDetails.style.display = 'none';  // Hide modal if clicked outside
    }
});


// Select all textareas with the class "RemarkTextareaa" inside the "ModalNato" div
const remarkTextareas = document.querySelectorAll(".ModalNato .RemarkTextareaa");

remarkTextareas.forEach(textarea => {
    // Add an event listener to each textarea to adjust its height on input
    textarea.addEventListener("input", function() {
        adjustTextareaHeight(textarea);
    });
});

// Function to adjust the height of the textarea
function adjustTextareaHeight(textarea) {
    // Reset the height to 'auto' to shrink if text is deleted
    textarea.style.height = "auto";
    
    // Set the height based on the scrollHeight, which adjusts to the content size
    textarea.style.height = textarea.scrollHeight + "px";
}
