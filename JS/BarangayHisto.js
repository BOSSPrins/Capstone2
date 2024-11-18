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
function toggleHistoBiew(pageId) {
    // Hide all pages
    const Pahina = document.querySelectorAll('.EachContainerBarang2');
    Pahina.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected page
    if (pageId) {
        const selectedPahina = document.getElementById(pageId);
        if (selectedPahina) {
            selectedPahina.style.display = 'flex'; // Use flex to maintain layout
     
        }   
    }
    // Store the active page in local storage under 'currentPahina'
    if (pageId === 'TableHistory') {
        localStorage.setItem('currentPahina', pageId); // Persist only main views
    }
    
}

// Check local storage on page load to determine which container to show
window.onload = function() {
    const currentPahina = localStorage.getItem('currentPahina') || 'TableHistory';
    toggleHistoBiew(currentPahina); // Default to 'TableHistory' if no page is stored
}



// FUNCTION PARA SA MGA TEXTAREA
// Select all textareas with the class "textAreaCompDeta"
const BarangTextareass = document.querySelectorAll(".textAreaBarangDeta2");

BarangTextareass.forEach(textarea => {
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


// FUNCTION PARA SA PICTURE MODAL PREVIEW 
// Example list of images that you want to display in the modal (use your actual image list here)
// const images = [
//     "image1.jpg", // Replace with actual image URLs
//     "image2.jpg",
//     "image3.jpg"
// ];

// // Modal and Image elements
// const imageModalHistory = document.querySelector('.imageModalHistory');
// const modalImageHisto = document.querySelector('.modalImageHisto');
// let currentIndexx = 0;  // Track the current image index

// // Show the modal and display the first image
// document.querySelector('.BiewPictures').addEventListener('click', function() {
//     currentIndexx = 0;  // Reset to first image
//     showModal();
// });

// // Function to display the modal and set the image
// function showModal() {
//     imageModalHistory.style.display = 'flex';  // Show the modal
//     modalImageHisto.src = images[currentIndexx];  // Set the image source
// }

// // Close the modal when clicking the close button
// document.querySelector('.closeModalHisto').addEventListener('click', function() {
//     imageModalHistory.style.display = 'none';  // Hide the modal
// });

// // Function to change the image when clicking next or previous
// function changeImage(direction) {
//     currentIndexx += direction;

//     // Loop the images: if we're at the start or end, loop around
//     if (currentIndexx < 0) {
//         currentIndexx = images.length - 1;  // Go to last image
//     } else if (currentIndexx >= images.length) {
//         currentIndexx = 0;  // Go to first image
//     }

//     modalImageHisto.src = images[currentIndexx];  // Update the image source
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

function HISTORYfetchComplaints() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'brngyHistory_get_complaints'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            HISTORYgenerateTable(data.data); // Pass complaints data to generateTable function
        } else {
            HISTORYgenerateTable([]); 
            console.log(data.error);
        }
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

function HISTORYgenerateTable(complaints) {
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
                <td style="color: green; font-weight: bold;">${complaint.status}</td>              
                <td><button class="BiewHisto" data-id="${complaint.complaint_number}" onclick="HISTORYviewDetails(this)">View Details</button></td>
            `;
            
            tableBody.appendChild(row);
        });
    }
}

function HISTORYviewDetails(button) {
    const complaintId = button.getAttribute('data-id');
    HISTORYfetchComplaintDetails(complaintId);

     // Enable the Generate PDF button after fetching details
     document.getElementById('generatePdfBtn').disabled = false;
}

const images = []; // Initialize an empty array to store images

function HISTORYfetchComplaintDetails(complaintId) {
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



                document.getElementById('ComplaineeName').value = response.data.complainee;
                document.getElementById('ComplaineeAddress').value = response.data.complaineeAddress;
                document.getElementById('ComplainantName').value = response.data.complainantName;
                document.getElementById('ComplainantAddress').value = response.data.complainantAddress;
                document.getElementById('DateSubmit').value = formatDateTimeToWords(response.data.filed_date);
                document.getElementById('ComplaintType').value = response.data.complaint;
                document.getElementById('Description').value = response.data.description;
                document.getElementById('Status').value = response.data.status;

                document.getElementById('FirstRemark').value = response.data.Remark1;
                document.getElementById('FirstRemarkBy').value = response.data.RemarkBy1;
                document.getElementById('FirstStatus').value = response.data.status1;
                document.getElementById('FirstRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate1);

                document.getElementById('SecondRemark').value = response.data.Remark2;
                document.getElementById('SecondRemarkBy').value = response.data.RemarkBy2;
                document.getElementById('SecondStatus').value = response.data.status2;
                document.getElementById('SecondRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate2);


                 // Parse the proof field as JSON
                const proofFiles = JSON.parse(response.data.proof);

                // Clear the images array and add the new images
                images.length = 0; // Clear any existing images
                proofFiles.forEach(file => images.push("Pictures/" + file));

                // Update the main displayed image
                // document.getElementById('ProofFileName').src = images[0]; // Display the first image by default

                // Store the images for modal use
                document.querySelector('.BiewPictures').dataset.proofImages = JSON.stringify(images);

                // Display the details section only after data is loaded
                toggleHistoBiew('ViewExcaltedDet2')
            } else {
                console.error('Error fetching complaint details:', response.error);
            }
        }
    };

    xhr.send("action=HISTORYfetchDetails&complaint_id=" + complaintId);
}


function HistoryBadge() {
    fetch('PHPBackend/Complaint.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=brngyHistory_get_badge'
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

setInterval(HistoryBadge, 60000);


// FUNCTION PARA SA PICTURE MODAL PREVIEW 
const modal = document.querySelector('.imageModalHistory');
const modalImage = document.querySelector('.modalImageHisto');
const prevButton = document.querySelector('.prevImage');
const nextButton = document.querySelector('.nextImage');
let currentIndex = 0;  // Track the current image index

// Show the modal and display the first image
document.querySelector('.BiewPictures').addEventListener('click', function () {
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
document.querySelector('.closeModalHisto').addEventListener('click', function() {
    modal.style.display = 'none';  // Hide the modal
});

// Function to change the image when clicking next or previous
function changeHistoImg(direction) {
    currentIndex += direction;

    // Loop the images: if we're at the start or end, loop around
    if (currentIndex < 0) {
        currentIndex = images.length - 1; // Go to last image
    } else if (currentIndex >= images.length) {
        currentIndex = 0; // Go to first image
    }

    modalImage.src = images[currentIndex]; // Update the image source
}

window.addEventListener('load', function() {
    HISTORYfetchComplaints();
    HistoryBadge();
});