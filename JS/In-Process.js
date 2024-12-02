// FUNCTION PARA SA PROFILE MODAL 
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


// //FUNCTION SA SUB-SIDEBAR 
document.addEventListener("DOMContentLoaded", function() { 
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2'); 
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');

    function toggleSubMenu() {
        complaintsSubMenu.classList.toggle('submenu-visible'); 
        eme2.classList.toggle('eme2-rotate'); 
    } 

    buttonEme2.addEventListener('click', function(event) { 
        event.preventDefault(); // Prevent default button action
        toggleSubMenu(); 
    });
});

//FUNCTION PARA SA SORTING 

document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.querySelector("tbody");
    const pageUl = document.querySelector(".pagination");
    const dropdownSelected = document.getElementById("dropdownSelected");
        
    let tr = Array.from(tbody.querySelectorAll("tr"));
    let emptyBox = [...tr];
    let index = 1;
    let itemPerPage = 23;
    
    // Handle dropdown
    dropdownSelected.addEventListener("click", function() {
        this.parentElement.classList.toggle("open");
    });
    
    document.querySelectorAll(".option").forEach(option => {
        option.addEventListener("click", function() {
            const value = this.dataset.value;
            const selected = this.closest(".dropdown").querySelector(".selected");
            selected.textContent = this.textContent;
            itemPerPage = parseInt(value);
            index = 1; // Reset to the first page when the items per page changes
            displayPage(itemPerPage);
            pageGenerator(itemPerPage);
            activatePageLinks(itemPerPage);
        });
    });
    
    // Handle sorting
    function sortTable(n, evt) {
        const table = document.querySelector('table');
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const isAscending = !evt.target.classList.contains('asc');
    
        rows.sort((a, b) => {
            const x = a.cells[n].innerText.trim();
            const y = b.cells[n].innerText.trim();
            const isNumeric = !isNaN(parseFloat(x)) && !isNaN(parseFloat(y));
    
            if (isNumeric) {
                return isAscending ? parseFloat(x) - parseFloat(y) : parseFloat(y) - parseFloat(x);
            } else {
                return isAscending ? x.localeCompare(y) : y.localeCompare(x);
            }
        });
    
        rows.forEach(row => tbody.appendChild(row));
        table.querySelectorAll('th').forEach(th => th.classList.remove('asc', 'desc'));
        evt.target.classList.toggle('asc', isAscending);
        evt.target.classList.toggle('desc', !isAscending);
    
        // Update emptyBox with sorted rows and refresh pagination
        emptyBox = Array.from(tbody.querySelectorAll("tr"));
        displayPage(itemPerPage);
        pageGenerator(itemPerPage);
        activatePageLinks(itemPerPage);
    }
    
    // Attach sorting event to headers
    document.querySelectorAll('th').forEach((th, index) => {
        th.addEventListener('click', function(event) {
            sortTable(index, event);
        });
    });
    
    // Handle pagination
    function displayPage(limit) {
        tbody.innerHTML = '';
        for (let i = (index - 1) * limit; i < index * limit && i < emptyBox.length; i++) {
            tbody.appendChild(emptyBox[i]);
        }
    }
    
    function pageGenerator(itemsPerPage) {
        pageUl.querySelectorAll('.list').forEach(n => n.remove());
        const num_of_tr = emptyBox.length;
        const num_Of_Page = Math.ceil(num_of_tr / itemsPerPage);
    
        for (let i = 1; i <= num_Of_Page; i++) {
            const li = document.createElement('li');
            li.className = 'list';
            const a = document.createElement('a');
            a.href = '#';
            a.innerText = i;
            a.setAttribute('data-page', i);
            li.appendChild(a);
            pageUl.insertBefore(li, pageUl.querySelector('.next'));
        }
    }
    
    function activatePageLinks(itemsPerPage) {
        const pageLinks = pageUl.querySelectorAll("a[data-page]");
        pageLinks.forEach(link => {
            link.onclick = (e) => {
                e.preventDefault();
                index = parseInt(link.getAttribute('data-page'));
                displayPage(itemsPerPage);
                updateActiveClass(pageLinks, link);
            };
        });
        
        // Set default active page to 1
        if (pageLinks.length > 0) {
            updateActiveClass(pageLinks, pageLinks[0]);
        }
        
        // Previous link
        document.getElementById("prev").onclick = (e) => {
            e.preventDefault();
            if (index > 1) index--;
            displayPage(itemsPerPage);
            updateActiveClass(pageLinks, pageLinks[index - 1]);
        };
        
        // Next link
        document.getElementById("next").onclick = (e) => {
            e.preventDefault();
            if (index < Math.ceil(emptyBox.length / itemsPerPage)) index++;
            displayPage(itemsPerPage);
            updateActiveClass(pageLinks, pageLinks[index - 1]);
        };
    }
        
    function updateActiveClass(links, currentLink) {
        links.forEach(link => link.classList.remove("Pageactive"));
        currentLink.classList.add("Pageactive");
    }
});


// Show the second container and hide the first (Same lang to ng function na nasa baba pero etong function na to walang retain pag)
// function showDetails() {
//     document.getElementById('tableCon').style.display = 'none';
//     document.getElementById('PangalawangCon').style.display = 'block';
// }

// Show the first container and hide the second
// function hideDetails() {
//     document.getElementById('PangalawangCon').style.display = 'none';
//     document.getElementById('tableCon').style.display = 'block';
// }

// Initially show the first container
// document.getElementById('tableCon').style.display = 'block';


// Function to show the second container
// function showDetails() {
//     document.getElementById('tableCon').style.display = 'none';
//     document.getElementById('PangalawangCon').style.display = 'block';
//     localStorage.setItem('activeContainer', 'PangalawangCon');
// }

// // Function to show the first container
// function hideDetails() {
//     document.getElementById('PangalawangCon').style.display = 'none';
//     document.getElementById('tableCon').style.display = 'block';
//     localStorage.setItem('activeContainer', 'tableCon');
// }

// // Check local storage on page load to determine which container to show
// window.onload = function() {
//     const activeContainer = localStorage.getItem('activeContainer');
//     if (activeContainer === 'PangalawangCon') {
//         document.getElementById('tableCon').style.display = 'none';
//         document.getElementById('PangalawangCon').style.display = 'block';
//     } else {
//         document.getElementById('tableCon').style.display = 'block';
//         document.getElementById('PangalawangCon').style.display = 'none';
//     }
// };

// FUNCTION PARA SA COMPLAINT DETAILS 
function togglePage(pageId) {
    // Hide all pages
    const pages = document.querySelectorAll('.TablessContainer');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected page
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'flex'; // Use flex to maintain the layout
    }

    // Store the active page in local storage
    localStorage.setItem('activeContainer', pageId);
}

// Check local storage on page load to determine which container to show
window.onload = function() {
    const activeContainer = localStorage.getItem('activeContainer');
    togglePage(activeContainer || 'tableCon'); // Default to 'tableCon'
}

// FUNCTION PARA SA TAKE ACTION BUTTON 
function toggleStatusFields() {
    // Get the elements for Status and Remark fields
    var statusContainer = document.getElementById('status-container');
    // var remarkContainer = document.getElementById('remark-container');

    // Toggle visibility of the Status and Remark containers
    if (statusContainer.style.display === 'none') {
        statusContainer.style.display = 'block';
        // remarkContainer.style.display = 'block';
    } else {
        statusContainer.style.display = 'none';
        // remarkContainer.style.display = 'none';
    }
}

// FUNCTION PARA SA STATUS cHANGE DROPDOWN
function toggleDropdown() {
    const options = document.querySelector('.dropdown-options');
    options.style.display = options.style.display === 'none' ? 'block' : 'none';
}

function setStatus(status) {
    const display = document.querySelector('.dropdown-display');
    const generatePdfBtn = document.getElementById('generatePdfBtn');
    // const generatedFileName = document.getElementById('generatedFileName');

    // Set the dropdown display text
    display.textContent = status;

    // Hide the dropdown options
    document.querySelector('.dropdown-options').style.display = 'none';

    // Show or hide the button based on the selected status
    if (status === 'Escalated') {
        generatePdfBtn.style.display = 'block'; // Show the button
        generatePdfBtn.disabled = false;
        // generatedFileName.style.display = 'block';
    } else if (status === 'Resolved'){
        generatePdfBtn.style.display = 'none'; // Hide the button
        // generatedFileName.style.display = 'none';
    } else {
        generatePdfBtn.style.display = 'none'; // Hide the button
        
    }

    
}

// FUNCTION PARA SA MGA TEXTAREA
// Select all textareas with the class "textAreaCompDeta"
const detailsTextareas = document.querySelectorAll(".textAreaCompDeta");

detailsTextareas.forEach(textarea => {
    textarea.addEventListener("input", function() {
        adjustTextareaHeight(textarea);
    });
});

function adjustTextareaHeight(textarea) {
    // Reset the height to auto to shrink if text is deleted
    textarea.style.height = "auto";
    // Set the height based on the scrollHeight, which adjusts to the content size
    textarea.style.height = textarea.scrollHeight + "px";
}


//Backend na 
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

function fetchComplaints() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'In-process_complaints'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            generateTable(data.data); // Pass complaints data to generateTable function
        } else {
            generateTable([]); 
            console.log(data.error);
        }
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

function generateTable(complaints) {
    const tableBody = document.querySelector('.TableComPend tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    if (complaints.length === 0) {
        // Create a row for the "No pending complaints" message
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="5" style="text-align: center; color: black;">No In-Process Complaints</td>`;
        tableBody.appendChild(row);
    } else {
        complaints.forEach(complaint => {
            const row = document.createElement('tr');
            const formattedDateTime = formatDateTimeToWords(complaint.filed_date);
            
            row.innerHTML = `
                <td>${complaint.complaint_number}</td>
                <td>${complaint.complaint}</td>
                <td>${formattedDateTime}</td>
                <td style="color: #FFB300; font-weight: bold;">${complaint.status}</td>              
                <td><button class="BiewPendBtn" data-id="${complaint.complaint_number}" onclick="viewDetails(this)">View Details</button></td>
            `;
            
            tableBody.appendChild(row);
        });
    }
}



function viewDetails(button) {
    const complaintId = button.getAttribute('data-id');
    document.getElementById('ComplaintID').value = complaintId;
    fetchComplaintDetails(complaintId);
}

const images = []; // Initialize an empty array to store images

function fetchComplaintDetails(complaintId) {
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
                const complaineeNameInput = document.getElementById('ComplaineeName');
                const complaineeAddressInput = document.getElementById('ComplaineeAddress');
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

                document.getElementById('complainantUID').value = response.data.complainantUID;
                document.getElementById('complaint_number').value = response.data.complaint_number;

                document.getElementById('ComplaineeName').value = response.data.complainee;
                document.getElementById('ComplaineeAddress').value = response.data.complaineeAddress;
                document.getElementById('ComplaineeEmail').value = response.data.ComplaineeEmail;
                document.getElementById('ComplainantName').value = response.data.complainantName;
                document.getElementById('ComplainantAddress').value = response.data.complainantAddress;
                document.getElementById('DateSubmit').value = formatDateTimeToWords(response.data.filed_date);
                document.getElementById('ComplaintType').value = response.data.complaint;
                document.getElementById('Description').value = response.data.description;
                document.getElementById('Status').value = response.data.status;
                document.getElementById('ProcessDate').value = formatDateTimeToWords(response.data.processed_date);

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

                    const complaintData = {
                        complaintNumber: response.data.complaint_number,  
                        complaintType: response.data.complaint,
                        complaineeName: response.data.complainee,
                        complaineeAddress: response.data.complaineeAddress,
                        complaintDescription: response.data.description,
                        complainantName: response.data.complainantName,
                        complainantAddress: response.data.complainantAddress,
                        dateSubmit: formatDateTimeToWords(response.data.filed_date),
                        dateNow: formatDateTimeToWords(new Date()) // Use your existing function
                        
                      };

                    document.getElementById('generatePdfBtn').setAttribute('data-complaint-data', JSON.stringify(complaintData));

                // Display the details section only after data is loaded
                togglePage('PangalawangCon');
            } else {
                console.error('Error fetching complaint details:', response.error);
            }
        }
    };

    xhr.send("action=fetch_In-process&complaint_id=" + complaintId);
}


function submitComplaintUpdate() {
    const complaintId = document.getElementById('ComplaintID').value;
    const status = document.getElementById('RemarkStatus').innerText;
    const remark = document.getElementById('NewRemark').value;
    const role = document.getElementById('RemarkRole').value;
    const generatedFileName = document.getElementById('generatedFileName').value;
    const ComplaineeEmail = document.getElementById('ComplaineeEmail').value;

    const complainantUID = document.getElementById('complainantUID').value;
    const complaint_number = document.getElementById('complaint_number').value;
    const Description = document.getElementById('Description').value;

    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator

    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: 'update_In-process',
            complaint_id: complaintId,
            status: status,
            remark: remark,
            role: role,
            generatedFileName: generatedFileName,
            ComplaineeEmail: ComplaineeEmail
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Complaint Update Response:", data);
        if (data.success) {
            if (status === "Escalated") {
                updateNaughtyList(ComplaineeEmail);
            }

            // Trigger both email functions in parallel
            return Promise.all([
                sendEmailToComplainant(complainantUID, complaint_number, Description, status),
                sendEmailToComplainee(ComplaineeEmail, ComplaintType, status)
            ]);
        } else {
            throw new Error(data.error); // Trigger catch block
        }
    })
    .then(() => {
        alert("Complaint updated and both parties are notified successfully!");
        location.reload();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred: " + error.message);
    })
    .finally(() => {
        loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator
    });
}

function updateNaughtyList(ComplaineeEmail) {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: 'update_naughty_list',
            ComplaineeEmail: ComplaineeEmail
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Naughty list updated successfully.');
            } else {
                console.error('Failed to update naughty list:', data.error);
            }
        })
        .catch(error => {
            console.error('Request failed:', error);
        });
}

function sendEmailToComplainant(complainantUID, complaint_number, Description, status) {
    let emailEndpoint;
    if (status === 'Resolved') {
        emailEndpoint = 'Emailer/ResolvedEmail.php';
    } else if (status === 'Escalated') {
        emailEndpoint = 'Emailer/EscalatedEmail.php';
    }
    
    return fetch(emailEndpoint, {
        method: 'POST',
        body: new URLSearchParams({
            complainantUID: complainantUID,
            complaint_number,
            Description
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Complainant Email Response:", data);
        if (data.success) {
            console.log('Complainant email sent successfully!');
        } else {
            console.error("Error:", data.error);
            throw new Error(data.message); // Throw error to be caught in Promise.all
        }
    });
}

function sendEmailToComplainee(ComplaineeEmail, ComplaintType, status) {
    let emailEndpoint;
    if (status === 'Resolved') {
        emailEndpoint = 'Emailer/ComplaineeResolvedEmail.php';
    } else if (status === 'Escalated') {
        emailEndpoint = 'Emailer/ComplaineeEscalatedEmail.php';
    }

    return fetch(emailEndpoint, {
        method: 'POST',
        body: new URLSearchParams({
            ComplaineeEmail: ComplaineeEmail,
            ComplaintType
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Complainee Email Response:", data);
        if (data.success) {
            console.log('Complainee email sent successfully!');
        } else {
            console.error("Error:", data.error);
            throw new Error(data.message); // Throw error to be caught in Promise.all
        }
    });
}


function updateComplaintCounts() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=get_complaint_counts'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update badges and hide if the count is zero
            const inProcessBadge = document.getElementById('inProcessBadge');           
            const escalatedBadge = document.getElementById('escalatedBadge');

            const updateBadge = (badge, count) => {
                badge.textContent = count || 0;
                badge.style.display = count > 0 ? 'inline-block' : 'none';
            };

            updateBadge(inProcessBadge, data.in_process);           
            updateBadge(escalatedBadge, data.escalated);
        } else {
            console.error('Failed to fetch complaint counts:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

setInterval(updateComplaintCounts, 60000); // Refresh every 60 seconds


window.onload = function () {
    fetchComplaints();
    updateComplaintCounts();
};



// FUNCTION PARA SA PICTURE MODAL PREVIEW 
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

// Pagclick ng generate letter
document.getElementById('generatePdfBtn').addEventListener('click', function (event) {
    event.preventDefault();
    const complaintData = JSON.parse(event.target.getAttribute("data-complaint-data") || "{}");
    if (!complaintData || Object.keys(complaintData).length === 0) {
        console.error("generatePDF called with undefined or null complaintData.");
        return;
    }
    generatePDF(complaintData);
});


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

    
    // Letterhead
    doc.setFontSize(12);
    doc.setFont("helvetica", "bold");
    doc.text("Homeowners Association (HOA)", 15, 70);
    doc.text("Mabuhay Homes 2000 Phase V", 15, 75);
    doc.text("Brgy. Salawag, Dasmariñas, Cavite", 15, 80);
    doc.setFont("helvetica", "normal");

    // Date and Barangay details
    doc.text(`Date: ${complaintData.dateNow}`, 15, 95);
    doc.text("To:", 15, 100);
    doc.text("Barangay Captain/Barangay Office", 15,105);
    doc.text("Brgy. Salawag", 15, 110);
    doc.text("Dasmariñas, Cavite", 15, 115);

    // Subject of the letter
    doc.setFont("helvetica", "bold");
    doc.text("Subject: Endorsement of Complaint for Resolution", 15, 120);
    doc.setFont("helvetica", "normal");

    doc.setFont("helvetica", "bold");
    doc.text("Dear Barangay Captain,", 15, 135);
    doc.setFont("helvetica", "normal");
    
    // Body of the letter
  const bodyText = `
We, the Homeowners Association (HOA), would like to formally endorse the following complaint for your office’s action and resolution. Due to the nature and complexity of the issue, the HOA is unable to address it effectively and believes it falls under the Barangay's jurisdiction. 
We trust that your office will handle the matter with diligence and fairness.
    `;
    doc.text(bodyText, 15, 138, { maxWidth: 180, align: "justify" });

    // Complaint details
    doc.setFont("helvetica", "bold");
    doc.text("Details of the Complaint:", 15, 170);
    doc.setFont("helvetica", "normal");
    doc.text(`Complainant: ${complaintData.complainantName}`, 15, 175);
    doc.text(`Address: ${complaintData.complainantAddress}`, 15, 180);

    // Only include Complainee information if not empty
    if (complaintData.complaineeName || complaintData.complaineeAddress) {
        doc.text(`Complainee: ${complaintData.complaineeName}`, 15, 185);
        doc.text(`Address: ${complaintData.complaineeAddress}`, 15, 190);
    }

    doc.text(`Date Submitted: ${complaintData.dateSubmit}`, 15, 195);
    doc.text(`Complaint Type: ${complaintData.complaintType}`, 15, 200);
    doc.text("Description:", 15, 205);
    doc.text(complaintData.complaintDescription, 15, 210, { maxWidth: 180, align: "justify" });

    // Closing remarks
    const closingText = `
We hope for your immediate attention to this matter. Should you require additional information or documentation, please do not hesitate to contact the HOA office.Thank you for your continued 
    `;

    doc.text("service and support to our community.", 15, 245);

    doc.text(closingText, 15, 230, { maxWidth: 180, align: "justify" });

    // Signature
    doc.text("Sincerely,", 15, 260);
    doc.setFont("helvetica", "bold");
    doc.text("The Homeowners Association (HOA)", 15, 265);

    // Save the PDF
    // Save the PDF
const fileName = `Turn-Over-Letter-${complaintData.complaintNumber}.pdf`; // Dynamic file name based on the complaint number
const pdfData = doc.output('arraybuffer'); // Get the PDF as a byte array
sendToServer(pdfData, fileName); // Send to PHP for saving

 // Create PDF card and display it
 createPdfCard(fileName); // Function to create the card in the UI

 // Update the hidden input field with the generated file name
 document.getElementById('generatedFileName').value = fileName;
}

// Function to send the generated PDF to the server
function sendToServer(pdfData, fileName) {
    const formData = new FormData();
    formData.append('pdfFile', new Blob([pdfData], { type: 'application/pdf' }), fileName);
    formData.append('action', 'save_pdf'); // Action parameter to specify the save operation

    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Get the raw response text first
    .then(rawResponse => {
        console.log('Raw Response:', rawResponse);  // Log the raw response to check for any extra characters
        try {
            const data = JSON.parse(rawResponse);  // Parse the raw response as JSON
            if (data.success) {
                console.log('Success:', data.message); // Handle success
            } else {
                console.error('Error:', data.message); // Handle error
            }
        } catch (error) {
            console.error('Error parsing JSON:', error); // Handle JSON parsing error
        }
    })
    .catch(error => {
        console.error('Request failed', error); // Handle fetch error
    });
}

function createPdfCard(fileName) {
    const pdfContainer = document.getElementById('pdfContainerNew');
    pdfContainer.style.display = 'flex'; // Make the container visible

    // Clear existing content and add the new card
    const cardHTML = `
        <div class="pdf-card-new">
            <img src="Pictures/pdf.png" alt="PDF Icon">
            <span class="pdf-file-name">${fileName}</span>
        </div>
    `;

    pdfContainer.innerHTML = cardHTML; // Add the new PDF card to the container
}