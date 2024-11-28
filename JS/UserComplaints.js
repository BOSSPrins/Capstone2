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


// FUNCTION PARA SA PAGES NG TABLE LIST AT FILE NEW COMPLAINTS 
// Function to toggle between containers
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
}

// Always show the tblConforComplaints section on page load
window.onload = function() {
    // Hide all containers initially
    const pages = document.querySelectorAll('.ContainerForComplaints');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Always show the tblConforComplaints section by default
    const tblConforComplaints = document.getElementById('tblConforComplaints');
    if (tblConforComplaints) {
        tblConforComplaints.style.display = 'flex'; // Use flex to maintain the layout
    }
};


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

    // Ensure that the default content is displayed first
    if (type === 'General Complaint') {
        document.getElementById('generalContent').style.display = 'block';
        document.getElementById('directContent').style.display = 'none';
    } else if (type === 'Direct Complaint') {
        document.getElementById('generalContent').style.display = 'none';
        document.getElementById('directContent').style.display = 'block';
    }
}

// Ensure generalContent is shown by default on page load
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('generalContent').style.display = 'block';
    document.getElementById('directContent').style.display = 'none';
});


// FUNCTION PARA SA PAG UPLOAD NG PICTURES DIRECT
// When the file-upload-wrapper is clicked, trigger the file input dialog
document.querySelector('.file-upload-wrapper').addEventListener('click', function() {
    document.querySelector('.inputFile').click();  // Open the file selection dialog
});

// Handle file input change (when files are selected)
document.querySelector('.inputFile').addEventListener('change', function(event) {
    let fileList = event.target.files;
    let imagePreviewContainer = document.getElementById('imagePreviewContainer');

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
                    openDirectComplaintLightbox(e.target.result);
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
function openDirectComplaintLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.querySelector('.lightbox-image');
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
// When the file-upload-wrapper is clicked, trigger the file input dialog
document.querySelector('.FileUploadWrapp').addEventListener('click', function() {
    document.querySelector('.InputFileGen').click();  // Open the file selection dialog
});

// Handle file input change (when files are selected)
document.querySelector('.InputFileGen').addEventListener('change', function(event) {
    let fileList = event.target.files;
    let imagePreviewContainer = document.querySelector('.ImagePreviewCon');

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



// FUNCTION PARA SA PAG SHOW NG MODAL TRACKING

// Nasa USERviewDetails function na to
// const btn = document.getElementById('viewDetailsBtn');

// btn.addEventListener('click', function() {
//     modalViewDetails.style.display = 'flex';  // Show modal
// });

// const modalViewDetails = document.querySelector('.ModalNato');
// const closeModalButton = document.querySelector('.PagEkis');

// Close the modal when the "X" button is clicked
// closeModalButton.addEventListener('click', function() {
//     modalViewDetails.style.display = 'none';  // Hide modal
// });

// Close the modal when clicking outside of the modal content
// window.addEventListener('click', function(event) {
//     if (event.target === modalViewDetails) {
//         modalViewDetails.style.display = 'none';  // Hide modal if clicked outside
//     }
// });


// Select all textareas with the class "RemarkTextareaa" inside the "ModalNato" div
const textAreaModalDet = document.querySelectorAll(".ModalNato .textAreaModalDet");

textAreaModalDet.forEach(textarea => {
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




//Funcion sa pagremove ng multiple pdf sa Direct complaints 
document.getElementById('PDFDir').addEventListener('change', function () {
    const DIRproof = this;
    const DIRpreviewContainer = document.getElementById('DIRpdfPreviewContainer');
    DIRpreviewContainer.innerHTML = ''; // Clear previous previews

    // Display previews and add remove functionality
    for (let i = 0; i < DIRproof.files.length; i++) {
        const file = DIRproof.files[i];

        // Create a preview item
        const previewItem = document.createElement('div');
        previewItem.className = 'dir-pdf-preview-item';
        previewItem.innerHTML = `
            <span>${file.name}</span>
            <button class="dir-remove-pdf" dir-data-index="${i}">Remove</button>
        `;

        // Append to the preview container
        DIRpreviewContainer.appendChild(previewItem);
    }

    // Add remove functionality
    DIRpreviewContainer.querySelectorAll('.dir-remove-pdf').forEach((button) => {
        button.addEventListener('click', function () {
            const index = parseInt(this.getAttribute('dir-data-index'));

            // Remove the file from the input
            const dt = new DataTransfer();
            Array.from(DIRproof.files)
                .filter((_, i) => i !== index)
                .forEach((file) => dt.items.add(file));
                DIRproof.files = dt.files;

            // Update the preview
            DIRproof.dispatchEvent(new Event('change'));
        });
    });
});

document.getElementById('ComplaineeAddress').addEventListener('blur', function() {
    let address = this.value.trim(); // Get the address value and trim any extra spaces
    
    // Normalize input: Replace common abbreviations
    address = address.replace(/\bblk\b/i, 'Block').replace(/\blt\b/i, 'Lot');

    // Split the address and extract Block and Lot values
    let addressParts = address.split(' ');
    let block, lot;

    // Check for the expected format: "Block X Lot Y"
    if (addressParts.includes('Block') && addressParts.includes('Lot')) {
        block = addressParts[addressParts.indexOf('Block') + 1]; // Get the value after 'Block'
        lot = addressParts[addressParts.indexOf('Lot') + 1];   // Get the value after 'Lot'

        // Send AJAX request to fetch resident info based on block and lot
        fetch('PHPBackend/Complaint.php', {
            method: 'POST',
            body: JSON.stringify({ action: 'fetchBLOCKnLOT', block: block, lot: lot }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); 
            if (data.unique_id) {
                // Now use the unique_id to fetch the email from tblaccounts
                fetchEmailFromUniqueId(data.unique_id);
            } else {
                console.log('No resident found for this address.');
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Invalid address format. Please use "Block X Lot Y".');
    }
});

function fetchEmailFromUniqueId(unique_id) {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: JSON.stringify({ action: 'fetch_email', unique_id: unique_id }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.email) {
            // Set the email in the ComplaineeEmail input field
            document.getElementById('ComplaineeEmail').value = data.email;
        } else {
            console.log('No email found for this unique_id.');
        }
    })
    .catch(error => console.error('Error:', error));
}


// Function ng submit ng direct complaint
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
    const DIRproof = document.getElementById('PDFDir');
    let formData = new FormData();

    formData.append('action', 'submit_complaint');
    formData.append('complainee', complainee);
    formData.append('ComplaineeAddress', ComplaineeAddress);
    formData.append('ComplainantUID', ComplainantUID);
    formData.append('ComplainantName', ComplainantName);
    formData.append('ComplainantAddress', ComplainantAddress);
    formData.append('complaint', complaint);
    formData.append('description', description);

    // Loop through each file and append it to the FormData
    if (proofInput.files.length > 0) {
        for (let i = 0; i < proofInput.files.length; i++) {
            formData.append('proofFiles[]', proofInput.files[i]); // Append each file
        }
    }

    if (DIRproof.files.length > 0) {
        for (let i = 0; i < DIRproof.files.length; i++) {
            formData.append('DIRproof[]', DIRproof.files[i]); // Append each file
        }
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/Complaint.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Raw Response:', xhr.responseText); // Log raw response for debugging
            try {
                const response = JSON.parse(xhr.responseText); // Parse the JSON response
                alert(response.success ? response.message : response.error);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                alert('There was an issue with the response format.');
            }
        } else {
            alert('There was an issue submitting the complaint.');
        }
    };

    xhr.send(formData);
});




// Function sa pdf ng general
document.getElementById('PDFGen').addEventListener('change', function () {
    const fileInput = this;
    const previewContainer = document.getElementById('pdfPreviewContainer');
    previewContainer.innerHTML = ''; // Clear previous previews

    // Display previews and add remove functionality
    for (let i = 0; i < fileInput.files.length; i++) {
        const file = fileInput.files[i];

        // Create a preview item
        const previewItem = document.createElement('div');
        previewItem.className = 'pdf-preview-item';
        previewItem.innerHTML = `
            <span>${file.name}</span>
            <button class="remove-pdf" data-index="${i}">Remove</button>
        `;

        // Append to the preview container
        previewContainer.appendChild(previewItem);
    }

    // Add remove functionality
    previewContainer.querySelectorAll('.remove-pdf').forEach((button) => {
        button.addEventListener('click', function () {
            const index = parseInt(this.getAttribute('data-index'));

            // Remove the file from the input
            const dt = new DataTransfer();
            Array.from(fileInput.files)
                .filter((_, i) => i !== index)
                .forEach((file) => dt.items.add(file));
            fileInput.files = dt.files;

            // Update the preview
            fileInput.dispatchEvent(new Event('change'));
        });
    });
});


// Function ng submit ng general complaint
document.getElementById('submitGen').addEventListener('click', function(event) {
    event.preventDefault();

    const GENComplainantUID = document.getElementById('GENComplainantUID').value;
    const GENComplainantName = document.getElementById('GENComplainantName').value;
    const GENComplainantAddress = document.getElementById('GENComplainantAddress').value;
    const selectGenComplaintInput = document.getElementById('selectGenComplaintInput').value;
    const DescriptionGen = document.getElementById('DescriptionGen').value;

    const GENproofInput = document.getElementById('ProofGen');
    const PDFGenProof = document.getElementById('PDFGen');
    let formData = new FormData();

    if (!GENComplainantUID || !GENComplainantName || !selectGenComplaintInput || !DescriptionGen || !GENComplainantAddress) {
        alert('Please fill in all required fieldss.');
        return; // Stop further processing
    }

    formData.append('action', 'submit_GEN_complaint');
    formData.append('GENComplainantUID', GENComplainantUID);
    formData.append('GENComplainantName', GENComplainantName);
    formData.append('selectGenComplaintInput', selectGenComplaintInput);
    formData.append('GENComplainantAddress', GENComplainantAddress);
    formData.append('DescriptionGen', DescriptionGen);

    // Loop through each file and append it to the FormData 
    if (GENproofInput.files.length > 0) {
        for (let i = 0; i < GENproofInput.files.length; i++) {
            formData.append('GENproofFiles[]', GENproofInput.files[i]); // Append each file
        }
    }

    if (PDFGenProof.files.length > 0) {
        for (let i = 0; i < PDFGenProof.files.length; i++) {
            formData.append('PDFGENproof[]', PDFGenProof.files[i]); // Append each file
        }
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/Complaint.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Raw Response:', xhr.responseText); // Log raw response for debugging
            try {
                const response = JSON.parse(xhr.responseText); // Parse the JSON response
                alert(response.success ? response.message : response.error);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                alert('There was an issue with the response format.');
            }
        } else {
            alert('There was an issue submitting the complaint.');
        }
    };

    xhr.send(formData);
});



window.addEventListener('load', function() {
    const UserUID = document.getElementById('UserUID').value;
    USERfetchComplaints(UserUID);
});

function formatDateTimeToWords(dateString) {
    const date = new Date(dateString);
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: 'numeric', 
        minute: 'numeric', 
        second: 'numeric',
        hour12: true  // To show time in AM/PM format
    };
    return date.toLocaleString(undefined, options);
}

function USERfetchComplaints(userUID) {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'user_get_complaints',
            userUID: userUID
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            USERgenerateTable(data.data); // Pass complaints data to USERgenerateTable function
        } else {
            USERgenerateTable([]); 
            console.log(data.error);
        }
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

function USERgenerateTable(complaints) {
    const tableBody = document.querySelector('.ListTablee tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    if (complaints.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="5" style="text-align: center; color: black;">No Complaints</td>`;
        tableBody.appendChild(row);
    } else {
        complaints.forEach(complaint => {
            const row = document.createElement('tr');
            const formattedDateTime = formatDateTimeToWords(complaint.filed_date);

            row.innerHTML = `
                <td>${complaint.complaint_number}</td>
                <td>${complaint.complaint}</td>
                <td>${formattedDateTime}</td>
                <td style="color: ${complaint.status === 'Resolved' ? 'green' : (complaint.status === 'Escalated' ? 'red' : '#FFB300')}; font-weight: bold;"">${complaint.status}</td>
                <td><button class="viewDetailsBtn" data-id="${complaint.complaint_number}">View Details</button></td>
            `;
            
            row.querySelector('.viewDetailsBtn').addEventListener('click', function () {
                USERviewDetails(this);
            });

            tableBody.appendChild(row);
        });
    }
}


function USERviewDetails(button) {
    const complaintId = button.getAttribute('data-id');
    
    // Open the modal
    const modal = document.querySelector('.ModalNato');
    modal.style.display = 'flex';  // Display the modal

    // Fetch complaint details and populate modal
    USERfetchComplaintDetails(complaintId);

    // Close the modal when clicking the "X" close button
    document.querySelector('.PagEkis').addEventListener('click', () => {
        modal.style.display = 'none';  // Hide modal
    });

    // Close the modal if the user clicks outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';  // Hide modal if clicked outside
        }
    });

     // Enable the Generate PDF button after fetching details, but we will handle the PDF generation later
     const generatePdfBtn = document.getElementById('generatePdfBtn');
     generatePdfBtn.disabled = false;
 
    // // Store the complaintId for later use
    // generatePdfBtn.setAttribute('data-complaint-id', complaintId);
}

const images = [];

function USERfetchComplaintDetails(complaintId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "PHPBackend/Complaint.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            console.log('Fetched complaint details:', response);

            if (response.success) {

                const firstRemark = response.data.Remark1 || '';
                const secondRemark = response.data.Remark2 || '';
                
                const complaineeName = response.data.complainee;
                const complaineeAddress = response.data.complaineeAddress;

                console.log("Complainee Name:", complaineeName, "Complainee Address:", complaineeAddress); // Debug

                // Get the input and label elements
                const complaineeNameInput = document.getElementById('UserComplaineeName');
                const complaineeAddressInput = document.getElementById('UserComplaineeAddress');
                const complaineeNameLabel = complaineeNameInput.previousElementSibling; // Get the label for name
                const complaineeAddressLabel = complaineeAddressInput.previousElementSibling; // Get the label for address

                // Set the input values
                complaineeNameInput.value = complaineeName || '';
                complaineeAddressInput.value = complaineeAddress || '';

                // Hide the respective fields and their labels if their values are empty
                if (!complaineeName) {
                    complaineeNameInput.style.display = 'none'; // Hide name field
                    complaineeNameLabel.style.display = 'none'; // Hide name label
                } else {
                    complaineeNameInput.style.display = 'block'; // Show name field
                    complaineeNameLabel.style.display = 'block'; // Show name label
                }

                if (!complaineeAddress) {
                    complaineeAddressInput.style.display = 'none'; // Hide address field
                    complaineeAddressLabel.style.display = 'none'; // Hide address label
                } else {
                    complaineeAddressInput.style.display = 'block'; // Show address field
                    complaineeAddressLabel.style.display = 'block'; // Show address label
                }

                // Optionally hide the entire Complainee section if both are hidden
                const complaineeSection = document.getElementById('ComplaineeSection');
                if (!complaineeName && !complaineeAddress) {
                    complaineeSection.style.display = 'none';
                } else {
                    complaineeSection.style.display = 'block';
                }

                document.getElementById('UserComplaineeName').value = response.data.complainee;
                document.getElementById('UserComplaineeAddress').value = response.data.complaineeAddress;
                document.getElementById('UserComplainantName').value = response.data.complainantName;
                document.getElementById('UserComplainantAddress').value = response.data.complainantAddress;
                document.getElementById('UserDateSubmit').value = formatDateTimeToWords(response.data.filed_date);
                document.getElementById('UserComplaintType').value = response.data.complaint;
                document.getElementById('UserDescription').value = response.data.description;
                document.getElementById('UserStatus').value = response.data.status;
                document.getElementById('UserProcessDate').value = formatDateTimeToWords(response.data.processed_date);

                document.getElementById('UserFirstRemark').value = response.data.Remark1;
                document.getElementById('UserFirstRemarkBy').value = response.data.RemarkBy1;
                document.getElementById('UserFirstStatus').value = response.data.status1;
                document.getElementById('UserFirstRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate1);

                document.getElementById('UserSecondRemark').value = response.data.Remark2;
                document.getElementById('UserSecondRemarkBy').value = response.data.RemarkBy2;
                document.getElementById('UserSecondStatus').value = response.data.status2;
                document.getElementById('UserSecondRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate2);

                 // Parse the proof field as JSON
                const proofFiles = JSON.parse(response.data.proof);

                // Clear the images array and add the new images
                images.length = 0; // Clear any existing images
                proofFiles.forEach(file => images.push("Pictures/" + file));

                // Update the main displayed image
                // document.getElementById('ProofFileName').src = images[0]; // Display the first image by default

                // Store the images for modal use
                document.querySelector('.BiewwPicture').dataset.proofImages = JSON.stringify(images);

                const pdfFiles = response.data.pdf_files || [];  // This will be the array of PDF filenames

                const pdfSection = document.getElementById('pdfSection');

                // Clear existing links if any
                const pdfLinksContainer = document.getElementById('pdfLinksContainer');
                pdfLinksContainer.innerHTML = '';

                    // Check if there are any PDF files
                    if (pdfFiles.length > 0) {
                        // Show the section
                        pdfSection.style.display = 'block';

                        // Loop through each PDF file and create a styled download card
                        pdfFiles.forEach(file => {
                            const card = document.createElement('div');
                            card.classList.add('pdf-card');

                            // Create the PDF icon
                            const pdfIcon = document.createElement('img');
                            pdfIcon.src = 'Pictures/pdf.png';  // Use the actual path to your PDF icon
                            card.appendChild(pdfIcon);

                            // Create the file name display
                            const fileName = document.createElement('div');
                            fileName.classList.add('file-name');
                            fileName.innerText = file;
                            card.appendChild(fileName);

                            // When the card is clicked, download the PDF and change favicon
                            card.onclick = function () {

                                window.open("view_pdf.php?file=PDF_Reports/" + file, "_blank");
                            };

                            // Append the card to the container
                            pdfLinksContainer.appendChild(card);
                        });
                    } else {
                        // Hide the section if no PDFs
                        pdfSection.style.display = 'none';
                    }

                 // Hide First Remark container if remark is empty
                 const firstRemarkCont = document.getElementById('FirstRemarkCont');
                 if (!firstRemark) {
                     firstRemarkCont.style.display = 'none';
                 } else {
                     firstRemarkCont.style.display = 'block';
                 }
 
                 // Hide Second Remark container if remark is empty
                 const secondRemarkCont = document.getElementById('SecondRemarkCont');
                 if (!secondRemark) {
                     secondRemarkCont.style.display = 'none';
                 } else {
                     secondRemarkCont.style.display = 'block';
                 }
 
                 // Hide the "Generate Complaint Letter" container if both remarks are empty
                 const letterGeneratorCont = document.getElementById('LetterGeneratorCont');
                 if (!firstRemark && !secondRemark) {
                     letterGeneratorCont.style.display = 'none';
                 } else {
                     letterGeneratorCont.style.display = 'block';
                 }

                 // Hide UserProcessDate if status is "Pending"
                 const userStatusInput = document.getElementById('UserStatus');
                 const userProcessDateInput = document.getElementById('UserProcessDate');
                 const userProcessDateLabel = userProcessDateInput.previousElementSibling;
 
                 if (userStatusInput.value === "Pending") {
                     userProcessDateInput.style.display = 'none';
                     userProcessDateLabel.style.display = 'none';
                     userProcessDateInput.value = "";
                 } else {
                     userProcessDateInput.style.display = 'block';
                     userProcessDateLabel.style.display = 'block';
                 }


                // Para sa papuntang pdf
                const complaintData = {
                    complaintNumber: response.data.complaint_number,  
                    complaintType: response.data.complaint,
                    complaineeName: response.data.complainee,
                    complaineeAddress: response.data.complaineeAddress,
                    complaintDescription: response.data.description,
                    complainantName1: response.data.complainantName,
                    complainantAddress: response.data.complainantAddress,
                    dateSubmit: formatDateTimeToWords(response.data.filed_date),
                    complainantName2: response.data.complainantName,
                    dateNow: formatDateTimeToWords(new Date())
                    
                  };

                  console.log('Prepared complaintData for PDF:', complaintData); // Debug
                console.log("Eto yung walang laman:",complaintData.complainantName1 );
          
                  document.getElementById('generatePdfBtn').setAttribute('data-complaint-data', JSON.stringify(complaintData));
                  console.log('Assigned data-complaint-data to generatePdfBtn:', JSON.stringify(complaintData)); // Debug

            } else {
                console.error('Error fetching complaint details:', response.error);
            }
        }
    };

    xhr.send("action=UserfetchDetails&complaint_id=" + complaintId);
}


// Modal and Image elements
const modal = document.querySelector('.imageModal');
const modalImage = document.querySelector('.modalImage');
const prevButton = document.querySelector('.prevImage');
const nextButton = document.querySelector('.nextImage');
let currentIndex = 0;  // Track the current image index

// Show the modal and display the first image
document.querySelector('.BiewwPicture').addEventListener('click', function () {
    const proofImages = JSON.parse(this.dataset.proofImages); // Get all images for the modal
    currentIndex = 0; // Reset to the first image
    images.length = 0; // Ensure images array matches the current proof
    proofImages.forEach(image => images.push(image));

    showModal(); // Open the modal
});

// Function to display the modal and set the image
function showModal() {
    modal.style.display = 'flex'; // Show the modal
    modalImage.src = images[currentIndex]; // Set the first image

    // Hide or show the navigation buttons depending on the number of images
    if (images.length === 1) {
        prevButton.style.display = 'none'; // Hide previous button if there's only one image
        nextButton.style.display = 'none'; // Hide next button if there's only one image
    } else {
        prevButton.style.display = 'block'; // Show previous button if there are multiple images
        nextButton.style.display = 'block'; // Show next button if there are multiple images
    }
}

// Close the modal when clicking the close button
document.querySelector('.closeModal').addEventListener('click', function() {
    modal.style.display = 'none';  // Hide the modal
});

// Function to change the image when clicking next or previous
function changeImage(direction) {
    currentIndex += direction;

    // Loop the images: if we're at the start or end, loop around
    if (currentIndex < 0) {
        currentIndex = images.length - 1; // Go to last image
    } else if (currentIndex >= images.length) {
        currentIndex = 0; // Go to first image
    }

    modalImage.src = images[currentIndex]; // Update the image source
}


// Load jsPDF library (if not already loaded)
const { jsPDF } = window.jspdf;

// Function to generate the PDF
function generatePDF(complaintData) {
    if (!complaintData || Object.keys(complaintData).length === 0) {
        console.error("generatePDF called with undefined or null complaintData.");
        return; // Stop execution
    }
    console.log("Starting generatePDF function."); // Debug
    console.log("Received complaintData:", complaintData); // Debug
    
const doc = new jsPDF();

// Add logo image
doc.addImage('Pictures/Mabuhay_Logo.png', 'PNG', 20, 10, 40, 40); // Adjust the position and size as needed

// Set text styles for the NameOfMabuhay
doc.setFont("Helvetica", "bold");
doc.setFontSize(22);
doc.setTextColor(0, 0, 154); // Color for "MABUHAY HOMES 2000 PHASE V"
doc.text("MABUHAY HOMES 2000 PHASE V", 70, 20 ); // Adjust position

// Address line
doc.setFontSize(14);
doc.setTextColor(7, 7, 178); // Address color
doc.text("Brgy. Salawag, Dasmarinas, Cavite", 93, 30); // Adjust position

// HLURB REGISTRATION
doc.setTextColor(214, 0, 0); // Color for "HLURB REG. #"
doc.text("HLURB REG. # 04-3792", 107, 37); // Adjust position

// Tel. No.
doc.setTextColor(7, 7, 178); // Color for Tel. No.
doc.text("Tel. No. 973-9422", 114, 44); // Adjust position

// Add horizontal line (using rectangle as a line)
doc.setLineWidth(0.5);
doc.setDrawColor(0, 81, 168); // Line color
doc.line(15, 60, 200, 60); // Adjust the line's position

doc.setFont("Helvetica", "normal");
doc.setFontSize(12); // Change font size for the letter content
doc.setTextColor(0, 0, 0); // Black color for the body text

// Constructing the letter content
doc.setFont("Helvetica", "bold");
doc.text(`${complaintData.complainantName1}`, 20, 70);
doc.setFont("Helvetica", "normal");
let letter = `
${complaintData.complainantAddress}
Mabuhay Homes 2000 Phase V
Brgy. Salawag, Dasmariñas, Cavite

`;

doc.setFont("Helvetica", "bold");
doc.text(`Date: ${complaintData.dateNow}`, 20, 96);
doc.setFont("Helvetica", "normal");

letter += `


To: 
`;

doc.setFont("Helvetica", "bold");
doc.text(`Homeowners Association (HOA)`, 20, 114);
doc.setFont("Helvetica", "normal");

letter += `
Mabuhay Homes 2000 Phase V
Brgy. Salawag, Dasmariñas, Cavite


`;

doc.setFont("Helvetica", "bold");
doc.text(`Dear Mabuhay Homes HOA,`, 20, 138);
doc.setFont("Helvetica", "normal");

letter += `
I am writing to formally bring to your attention an issue that has been affecting my experience as a resident of Mabuhay Homes 2000 Phase V. The matter pertains to the following:`;

letter += `

• Complaint Type: ${complaintData.complaintType}
`;

// Only add Complainee section if both name and address are not empty
if (complaintData.complaineeName || complaintData.complaineeAddress) {
    let complaineeText = '';
    if (complaintData.complaineeName) {
        complaineeText += complaintData.complaineeName;
    }
    if (complaintData.complaineeAddress) {
        complaineeText += ` ${complaintData.complaineeAddress}`;
    }
    letter += `• Complainee: ${complaineeText}\n`;
}

letter += `• Details of Concern: ${complaintData.complaintDescription} `;


letter += `





The problem started on ${complaintData.dateSubmit} and has continued despite efforts on my part to address the situation. The issue has caused major inconvenience, having an impact on my daily life. As a concerned resident, I kindly request the management’s immediate attention to this matter and appropriate action to resolve it.

Please let me know if further details are required or if a meeting would be beneficial. 

Thank you for your time and attention. I look forward to your response.

Sincerely,`;

doc.setFont("Helvetica", "bold");
doc.text(`${complaintData.complainantName2}`, 20, 250);
doc.setFont("Helvetica", "normal");




// Add the letter line by line for formatting control
const lines = doc.splitTextToSize(letter, 170); // Wrap text to fit within the page width
doc.text(lines, 20, 70); // Starting position for the text

// Save the PDF
const fileName = `Complaint-${complaintData.complaintNumber}.pdf`; // Dynamic file name based on the complaint number
doc.save(fileName);
}
  


document.getElementById('generatePdfBtn').addEventListener('click', function (event) {
    event.preventDefault();
    const complaintData = JSON.parse(event.target.getAttribute("data-complaint-data") || "{}");
    if (!complaintData || Object.keys(complaintData).length === 0) {
        console.error("generatePDF called with undefined or null complaintData.");
        return;
    }
    generatePDF(complaintData);
});
