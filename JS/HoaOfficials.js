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


// FUNCTION PARA SA PAG SHOW NG EDITING POSITION
// const btnEd = document.getElementById('HoaEditing');

// btnEd.addEventListener('click', function() {
//     modalEditing.style.display = 'flex';  // Show modal
// });

// const modalEditing = document.querySelector('.ModalEditingPos');
// const closeModalEdit = document.querySelector('.EkisHo');

// // Close the modal when the "X" button is clicked
// closeModalEdit.addEventListener('click', function() {
//     modalEditing.style.display = 'none';  // Hide modal
// });

// // Close the modal when clicking outside of the modal content
// window.addEventListener('click', function(event) {
//     if (event.target === modalEditing) {
//         modalEditing.style.display = 'none';  // Hide modal if clicked outside
//     }
// });


// FUNCTION SA PAG PILI NG PICTURE
document.getElementById("PictureWrapper").addEventListener("click", function() {
    document.getElementById("Picturee").click();  // Trigger file input click
});

document.getElementById("Picturee").addEventListener("change", function(event) {
    const file = event.target.files[0];  // Get the selected file
    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            // Create an image element
            const img = document.createElement("img");
            img.src = e.target.result;
            img.classList.add("imgDisplay");  // Add class to style the image

            // Clear the container and append the new image
            const imgContainer = document.getElementById("imgContainerr");
            imgContainer.innerHTML = '';  // Clear previous images (if any)
            imgContainer.appendChild(img);  // Add the new image
        };

        reader.readAsDataURL(file);  // Read the file as a data URL
    }
});


// Pastilang backend na 

document.addEventListener("DOMContentLoaded", fetchWinners);

function fetchWinners() {
    const action = "getWinners";
    fetch('PHPBackend/HoaOfficial.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action })
    })
        .then(response => {
            if (!response.ok) throw new Error("Failed to fetch data");
            return response.json();
        })
        .then(data => {
            if (data.success) {
                generateTable(data.data);
            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
}

function generateTable(winners) {
    const tableBody = document.querySelector('.HoaTbl tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    if (winners.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `<td colspan="4" style="text-align: center; color: black;">No Winners Found</td>`;
        tableBody.appendChild(row);
    } else {
        winners.forEach(winner => {
            const position = winner.position || "TBA"; // Default to TBA if position is empty
            const imgSrc = winner.img ? `Pictures/${winner.img}` : 'Pictures/default.png';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="${imgSrc}" alt="Candidate Image" style="width: 50px; height: 50px;"></td>
                <td>${position}</td>
                <td>${winner.candidate_name}</td>
                <td><button class="HoaEditing" data-id="${winner.unique_id}" onclick="handleAction(this)">Edit</button></td>
            `;
            tableBody.appendChild(row);
        });
    }
}


const modalEditing = document.querySelector('.ModalEditingPos');
const closeModalEdit = document.querySelector('.EkisHo');

// Open modal and fetch data
function handleAction(button) {
    const winnerUID = button.getAttribute('data-id');
    console.log("Edit action triggered for unique_id:", winnerUID);

    // Fetch official details and populate modal
    fetchNewOfficials(winnerUID);

    // Show the modal
    modalEditing.style.display = 'flex';
}

// Close the modal when the "X" button is clicked
closeModalEdit.addEventListener('click', function () {
    modalEditing.style.display = 'none';
});

// Close the modal when clicking outside the modal content
window.addEventListener('click', function (event) {
    if (event.target === modalEditing) {
        modalEditing.style.display = 'none';
    }
});


function fetchNewOfficials(winnerUID) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/HoaOfficial.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({ action: 'fetchNewOfficials', winnerUID }));

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log("Data fetched successfully:", response.data);

                    // Use response.data instead of data
                    document.getElementById('HoaPosition').value = response.data.position || "TBA";
                    document.getElementById('HoaName').value = response.data.candidate_name;
                    document.getElementById('HoaUID').value = response.data.unique_id;

                    const imgContainer = document.getElementById('imgContainerr');
                    imgContainer.innerHTML = `<img src="Pictures/${response.data.img}" alt="Candidate Image" style="width: 100%; height: auto;">`;

                } else {
                    console.error("Error fetching details:", response.error);
                }
            } catch (e) {
                console.error("Error parsing response:", e.message);
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    };
}

document.getElementById('submit').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent form submission

    const imgInput = document.getElementById('Picturee');
    const HoaPosition = document.getElementById('HoaPosition').value;
    const HoaName = document.getElementById('HoaName').value;
    const HoaUID = document.getElementById('HoaUID').value;
    const existingImgSrc = document.querySelector('#imgContainerr img')?.getAttribute('src');

    const formData = new FormData();
    formData.append("action", "updateOfficial");
    formData.append("position", HoaPosition);
    formData.append("name", HoaName);
    formData.append("winnerUID", HoaUID);

    if (imgInput && imgInput.files && imgInput.files[0]) {
        formData.append("img", imgInput.files[0]); // New image file
    } else if (existingImgSrc) {
        const existingImgName = existingImgSrc.split('/').pop(); // Extract image name
        formData.append("existingImg", existingImgName); // Send the existing image name
    } else {
        console.error('No file selected and no existing image found.');
        return;
    }

    // Log the form data
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    // Send the data
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/HoaOfficial.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                console.log("Board of Director updated successfully.");
                // Refresh the table to reflect updates
                location.reload();
            } else {
                console.error("Error updating:", response.error);
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    };
    xhr.send(formData);
});


document.querySelector('.DelEditing').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent form submission
    
    // Get the HoaUID from the input field
    const HoaUID = document.getElementById('HoaUID').value.trim();
    
    if (!HoaUID) {
        alert('No valid UID provided');
        return;
    }
    
    // Send AJAX request to delete the winner
    $.ajax({
        type: 'POST',
        url: 'PHPBackend/HoaOfficial.php',
        data: {
            action: 'deleteWinner',  // Action to indicate delete operation
            HoaUID: HoaUID          // Pass the HoaUID to identify the winner
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Deleted successfully!');
                // Optionally, you could hide or remove the row from the table
                location.reload(); // Reload the page to reflect changes (or update the table dynamically)
            } else {
                alert('Error: ' + response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            alert('There was an error processing the request.');
        }
    });
});






