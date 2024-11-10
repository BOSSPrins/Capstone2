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
    var remarkContainer = document.getElementById('remark-container');

    // Toggle visibility of the Status and Remark containers
    if (statusContainer.style.display === 'none') {
        statusContainer.style.display = 'block';
        remarkContainer.style.display = 'block';
    } else {
        statusContainer.style.display = 'none';
        remarkContainer.style.display = 'none';
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
            console.error('No complaints found or error in fetching data.');
        }
    })
    .catch(error => {
        console.error('Error fetching complaints:', error);
    });
}

function generateTable(complaints) {
    const tableBody = document.querySelector('.TableComPend tbody');
    tableBody.innerHTML = ''; // Clear any existing rows

    complaints.forEach(complaint => {
        const row = document.createElement('tr');

        const formattedDateTime = formatDateTimeToWords(complaint.filed_date);
        
        row.innerHTML = `
            <td>${formattedDateTime}</td>
            <td style="color: #FFB300; font-weight: bold;">${complaint.status}</td>
            <td>${complaint.complaint}</td>
            <td>${complaint.complaineeAddress}</td>
            <td><button class="BiewPendBtn" data-id="${complaint.complaint_id}" onclick="viewDetails(this)">View Details</button></td>
        `;
        
        tableBody.appendChild(row);
    });
}


function viewDetails(button) {
    const complaintId = button.getAttribute('data-id');
    document.getElementById('ComplaintID').value = complaintId;
    fetchComplaintDetails(complaintId);
}

function fetchComplaintDetails(complaintId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "PHPBackend/Complaint.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                // Populate the fields with the fetched data
                document.getElementById('ComplaineeName').value = response.data.complainee;
                document.getElementById('ComplaineeAddress').value = response.data.complaineeAddress;
                
                document.getElementById('ComplainantName').value = response.data.complainantName;
                document.getElementById('ComplainantAddress').value = response.data.complainantAddress;
                document.getElementById('DateSubmit').value = formatDateTimeToWords(response.data.filed_date)
                document.getElementById('ComplaintType').value = response.data.complaint;
                document.getElementById('Description').value = response.data.description;
                document.getElementById('Status').value = response.data.status;

                document.getElementById('FirstRemark').value = response.data.Remark1;
                document.getElementById('FirstRemarkBy').value = response.data.RemarkBy1;
                document.getElementById('FirstStatus').value = response.data.status1;
                document.getElementById('FirstRemarkDate').value = formatDateTimeToWords(response.data.RemarkDate1);
                
                document.getElementById('ProofFileName').src = "Pictures/" + response.data.proof;

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
            role: role
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Complaint updated successfully!');
            // Optionally refresh or update the page content here
        } else {
            console.error('Error updating complaint:', data.error);
        }
    })
    .catch(error => {
        console.error('Request failed:', error);
    });
}


window.onload = function () {
    fetchComplaints();
};