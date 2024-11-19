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

// Check local storage on page load to determine which container to show // 
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


// Function ng submit ng general complaint
document.getElementById('submitGen').addEventListener('click', function(event) {
    event.preventDefault();

    const GENComplainantUID = document.getElementById('GENComplainantUID').value;
    const GENComplainantName = document.getElementById('GENComplainantName').value;
    const GENComplainantAddress = document.getElementById('GENComplainantAddress').value;
    const selectGenComplaintInput = document.getElementById('selectGenComplaintInput').value;
    const DescriptionGen = document.getElementById('DescriptionGen').value;

    const GENproofInput = document.getElementById('ProofGen');
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

    // Enable the Generate PDF button after fetching details
    document.getElementById('generatePdfBtn').disabled = false;
}

const images = [];

function USERfetchComplaintDetails(complaintId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "PHPBackend/Complaint.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                
                const complaineeName = response.data.complainee;
                const complaineeAddress = response.data.complaineeAddress;

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

                // Display the details section only after data is loaded
            } else {
                console.error('Error fetching complaint details:', response.error);
            }
        }
    };

    xhr.send("action=UserfetchDetails&complaint_id=" + complaintId);
}

