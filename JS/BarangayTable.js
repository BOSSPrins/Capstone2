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


// FUNCTION SA NAVBAR 
document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.NavTop');
    const currentPage = window.location.pathname; // Get the current page's path

    sidebarLinks.forEach(link => {
        const linkHref = link.getAttribute('href');

        // If the href matches the current page, add the 'baractive' class
        if (currentPage.includes(linkHref)) {
            link.classList.add('NavActive');
        } else {
            link.classList.remove('NavActive');
        }
    });
});

// FUNCTION SA COMPLAINT DETAILS 
function toggleBarangayCon(pageId) {
    console.log("Toggling containers. Page ID:", pageId);

    // Hide all containers
    const pages = document.querySelectorAll('.EachContainerBarang');
    pages.forEach(page => {
        page.style.display = 'none'; // Hide all containers
        console.log(`Hiding: ${page.id}`);
    });

    // Show the selected page if it exists
    if (pageId) {
        const selectedPage = document.getElementById(pageId);
        if (selectedPage) {
            selectedPage.style.display = 'flex'; // Show the target container
            console.log(`Showing: ${selectedPage.id}`);
        } else {
            console.error(`Page with ID '${pageId}' not found.`);
        }
    }

    // Update localStorage only for primary views
    if (pageId === 'TableListEsca') {
        localStorage.setItem('currentPage', pageId); // Persist only main views
    }
}

// On page load, use localStorage or default to 'TableListEsca'
window.onload = function() {
    const currentPage = localStorage.getItem('currentPage') || 'TableListEsca'; // Default fallback
    console.log("Current page on load:", currentPage);
    toggleBarangayCon(currentPage);
};




// FUNCTION PARA SA MGA TEXTAREA
// Select all textareas with the class "textAreaCompDeta"
const BarangTextareas = document.querySelectorAll(".textAreaBarangDeta");

BarangTextareas.forEach(textarea => {
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



// FUNCTION PARA SA TAKE ACTION BUTTON 
function toggleStatusFields() {
    // Get the elements for Status and Remark fields
    const generatePdfBtn = document.getElementById('generatePdfBtn');
    var statusContainer = document.getElementById('status-container');
    // var remarkContainer = document.getElementById('remark-container');

    // Toggle visibility of the Status and Remark containers
    if (statusContainer.style.display === 'none') {
        statusContainer.style.display = 'block';
        // remarkContainer.style.display = 'block';
        generatePdfBtn.disabled = false;
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
    display.textContent = status;
    document.querySelector('.dropdown-options').style.display = 'none';
}


// FUNCTION PARA SA PICTURE MODAL PREVIEW 
// // Example list of images that you want to display in the modal (use your actual image list here)
// const images = [
//     "image1.jpg", // Replace with actual image URLs
//     "image2.jpg",
//     "image3.jpg"
// ];

// // Modal and Image elements
// const modal = document.querySelector('.imageModal');
// const modalImage = document.querySelector('.modalImage');
// let currentIndex = 0;  // Track the current image index

// // Show the modal and display the first image
// document.querySelector('.BiewwPicture').addEventListener('click', function() {
//     currentIndex = 0;  // Reset to first image
//     showModal();
// });

// // Function to display the modal and set the image
// function showModal() {
//     modal.style.display = 'flex';  // Show the modal
//     modalImage.src = images[currentIndex];  // Set the image source
// }

// // Close the modal when clicking the close button
// document.querySelector('.closeModal').addEventListener('click', function() {
//     modal.style.display = 'none';  // Hide the modal
// });

// // Function to change the image when clicking next or previous
// function changeImage(direction) {
//     currentIndex += direction;

//     // Loop the images: if we're at the start or end, loop around
//     if (currentIndex < 0) {
//         currentIndex = images.length - 1;  // Go to last image
//     } else if (currentIndex >= images.length) {
//         currentIndex = 0;  // Go to first image
//     }

//     modalImage.src = images[currentIndex];  // Update the image source
// }


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

function BRNGYfetchComplaints() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'brngy_get_complaints'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            BRNGYgenerateTable(data.data); // Pass complaints data to generateTable function
        } else {
            BRNGYgenerateTable([]); 
            console.log(data.error);
        }
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

function BRNGYgenerateTable(complaints) {
    const tableBody = document.querySelector('.TableBarangDet tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    if (complaints.length === 0) {
        // Create a row for the "No pending complaints" message
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="5" style="text-align: center; color: black;">No Escalated Complaints</td>`;
        tableBody.appendChild(row);
    } else {
        complaints.forEach(complaint => {
            const row = document.createElement('tr');
            const formattedDateTime = formatDateTimeToWords(complaint.filed_date);
            
            row.innerHTML = `
                <td>${complaint.complaint_number}</td>
                <td>${complaint.complaint}</td>
                <td>${formattedDateTime}</td>
                <td style="color: red; font-weight: bold;">${complaint.status}</td>              
                <td><button class="BiewEscaBarang" data-id="${complaint.complaint_number}" onclick="BRNGYviewDetails(this)">View Details</button></td>
            `;
            
            tableBody.appendChild(row);
        });
    }
}

function BRNGYviewDetails(button) {
    const complaintId = button.getAttribute('data-id');
    document.getElementById('ComplaintID').value = complaintId; // May ganto talaga kapag i update ang complaint
    BRNGYfetchComplaintDetails(complaintId);

     // Enable the Generate PDF button after fetching details
     document.getElementById('generatePdfBtn').disabled = false;
}

const images = []; // Initialize an empty array to store images

function BRNGYfetchComplaintDetails(complaintId) {
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

                document.getElementById('FirstRemark').value = response.data.Remark1;
                document.getElementById('FirstRemarkBy').value = response.data.RemarkBy1;
                document.getElementById('FirstStatus').value = response.data.status1;
                document.getElementById('FirstRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate1);


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
                const hoaReportFiles = response.data.hoa_report_files || '';

                const hoaReportSection = document.getElementById('HoaReport');
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

                    // Clear existing links for the HOA Report PDFs
                    const hoaLinksContainer = document.getElementById('HoaReport');
                    hoaLinksContainer.innerHTML = '';

                    // Display the HOA Report PDFs if available
                    if (hoaReportFiles) {
                        hoaReportSection.style.display = 'block';
                        
                            const card = document.createElement('div');
                            card.classList.add('hoa-pdf-card');

                            const pdfIcon = document.createElement('img');
                            pdfIcon.src = 'Pictures/pdf.png';  // Use the actual path to your PDF icon
                            card.appendChild(pdfIcon);

                            const fileName = document.createElement('div');
                            fileName.classList.add('hoa-file-name');
                            fileName.innerText = hoaReportFiles;
                            card.appendChild(fileName);

                            card.onclick = function () {
                                window.open("view_pdf.php?file=PDF_Reports/" + hoaReportFiles, "_blank");
                            };

                            hoaLinksContainer.appendChild(card);
                        
                    } else {
                        hoaReportSection.style.display = 'none';
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
                toggleBarangayCon('ViewExcaltedDet');
            } else {
                console.error('Error fetching complaint details:', response.error);
            }
        }
    };

    xhr.send("action=BRNGYfetchDetails&complaint_id=" + complaintId);
}

// Sa take action
function BRNGYsubmitComplaintUpdate() {

    const complainantUID = document.getElementById('complainantUID').value;
    const complaint_number = document.getElementById('complaint_number').value;
    const Description = document.getElementById('Description').value;
    const ComplaintType = document.getElementById('ComplaintType').value;
    const ComplaineeEmail = document.getElementById('ComplaineeEmail').value;
    
    const complaintId = document.getElementById('ComplaintID').value;
    const status = document.getElementById('RemarkStatus').value;
    const remark = document.getElementById('NewRemark').value;
    const role = document.getElementById('RemarkRole').value;
    const generatedFileName = document.getElementById('generatedFileName').value;

    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.setProperty('display', 'flex', 'important'); // Show loading indicator

    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: 'update_barangay',
            complaint_id: complaintId,
            status: status,
            remark: remark,
            role: role,
            generatedFileName: generatedFileName
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            return Promise.all([
                sendEmailToComplainant(complainantUID, complaint_number, Description),
                sendEmailToComplainee(ComplaineeEmail, ComplaintType)
            ]);
        } else {
            console.error('Error updating complaint:', data.error);
            throw new Error('Complaint update failed');
        }
    })
    .then(() => {
        alert('Complaint updated successfully and both parties notified!');
        location.reload();
    })
    .catch(error => {
        console.error('Request failed:', error);
        alert('An error occurred: ' + error.message);
    })
    .finally(() => {
        loadingIndicator.style.setProperty('display', 'none', 'important'); // Hide loading indicator when done
    });
}


function sendEmailToComplainant(complainantUID, complaint_number, Description) {
    return fetch('Emailer/BrngyEmail.php', { // Return the promise
        method: 'POST',
        body: new URLSearchParams({
            complainantUID: complainantUID,
            complaint_number,
            Description
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Parsed response:", data);
        if (data.success) {
            console.log("Email sent successfully to complainant.");
        } else {
            console.error("Error:", data.error);
            throw new Error('Email to complainant failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error("AJAX error:", error);
        throw error; // Ensure error propagates to Promise.all
    });
}

function sendEmailToComplainee(ComplaineeEmail, ComplaintType) {
    return fetch('Emailer/ComplaineeBrngyEmail.php', { // Return the promise
        method: 'POST',
        body: new URLSearchParams({
            ComplaineeEmail: ComplaineeEmail,
            ComplaintType
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Parsed response:", data);
        if (data.success) {
            console.log("Email sent successfully to complainee.");
        } else {
            console.error("Error:", data.error);
            throw new Error('Email to complainee failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error("AJAX error:", error);
        throw error; // Ensure error propagates to Promise.all
    });
}



function BRNGYHistoryBadge() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=brngy_get_badge' 
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update badges and hide if the count is zero  
            const escalatedBadge = document.getElementById('escalatedBadge');

            const updateBadge = (badge, count) => {
                badge.textContent = count || 0;
                badge.style.display = count > 0 ? 'inline-block' : 'none';
            };
        
            updateBadge(escalatedBadge, data.escalated);
        } else {
            console.error('Failed to fetch complaint counts:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

setInterval(BRNGYHistoryBadge, 60000);


window.addEventListener('load', function() {
    BRNGYfetchComplaints();
    BRNGYHistoryBadge();
});


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


// Function para sa pag generate ng pdf
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

doc.setFontSize(12);
doc.setFont("helvetica", "bold");
doc.text("Barangay Office", 15, 75);
doc.text("Brgy. Salawag, Dasmariñas, Cavite", 15, 80);


// Date and Barangay details
doc.text(`Date: ${complaintData.dateNow}`, 15, 95);
doc.setFont("helvetica", "normal");
doc.text("To:", 15, 100);
doc.text("Homeowners Association (HOA)", 15,105);
doc.text("Mabuhay Homes 2000 Phase V", 15, 110);
doc.text("Brgy. Salawag Dasmariñas, Cavite", 15, 115);

doc.setFont("helvetica", "bold");
doc.text("To the Homeowners' Association,", 15, 133);
doc.setFont("helvetica", "normal");

const content = `
This is to formally notify you that the complaint submitted to our Barangay, dated ${complaintData.dateSubmit}, regarding ${complaintData.complaintType} of ${complaintData.complainantName} in ${complaintData.complainantAddress} has been reviewed and resolved.

The necessary actions have been taken to address the matter, and we confirm that no further intervention is required at this time. 

We appreciate the attention and cooperation of the Homeowners' Association in ensuring that community concerns are promptly addressed 
and resolved. Your support in maintaining peace and order within our barangay is highly valued.

Should you need further clarification or documentation, please feel free to contact our office.

Thank you for your cooperation and understanding.

Sincerely,
    `;
doc.setFont("helvetica", "bold");
doc.text("Dennis Q. De La Peña", 15, 220);
doc.text("Secretary of Barangay Salawag", 15, 225);
doc.setFont("helvetica", "normal");

// Split content into lines
const lines = doc.splitTextToSize(content, 180); // Adjust width as needed
doc.text(lines, 15, 135);

    

const fileName = `Settled-Letter-${complaintData.complaintNumber}.pdf`; // Dynamic file name based on the complaint number
const pdfData = doc.output('arraybuffer'); 
sendToServer(pdfData, fileName); 
// doc.save(fileName);
createPdfCard(fileName);
 // Update the input field with the generated file name
 document.getElementById('generatedFileName').value = fileName;
}

// Function to send the generated PDF to the server
function sendToServer(pdfData, fileName) {
    const formData = new FormData();
    formData.append('pdfFile', new Blob([pdfData], { type: 'application/pdf' }), fileName);
    formData.append('action', 'brngy_save_pdf'); // Action parameter to specify the save operation

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

