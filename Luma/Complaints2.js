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

document.addEventListener('DOMContentLoaded', () => {
    const complaintsDropdown = document.getElementById('complaintsDropdown');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
    const eme2 = complaintsDropdown.querySelector('.eme2');

    // Toggle Submenu on Click
    complaintsDropdown.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default anchor behavior
        complaintsSubMenu.classList.toggle('submenu-visible');
        eme2.classList.toggle('eme2-rotate');
    });
});

// FUNCTION PARA SA FILTERING NG TABLE 


// FUNCTION PARA SA PAG VIEW NG MODAL AT CLOSE 
document.addEventListener('DOMContentLoaded', () => {
    // Select the modal and close button elements
    const modalComp = document.querySelector('.ModalNgComplain');
    const closeCompBtn = document.querySelector('.closeViewModal');
    
    // Select the divs to switch between
    const boxLoobReply = document.querySelector('.boxLoobReply');
    const boxLoobReply2 = document.querySelector('.boxLoobReply2');
    const boxsaLoob = document.querySelector('.boxsaLoob');

    // Show modal function
    function showModal() {
        modalComp.style.display = 'block';
        boxsaLoob.style.display = 'block';
        boxLoobReply.style.display = 'none';
        boxLoobReply2.style.display = 'none';
    }

    // Hide modal function
    function closeModal() {
        modalComp.style.display = 'none';
    }

    // Close modal on clicking the close button
    closeCompBtn.addEventListener('click', closeModal);

    // Handle switching between different views in the modal
    document.querySelector('.MessComp').addEventListener('click', () => {
        boxsaLoob.style.display = 'none';
        boxLoobReply.style.display = 'none';
        boxLoobReply2.style.display = 'block';
    });

    document.querySelector('.repsComp').addEventListener('click', () => {
        boxsaLoob.style.display = 'none';
        boxLoobReply.style.display = 'block';
        boxLoobReply2.style.display = 'none';
    });

    // Handle back button clicks
    document.querySelectorAll('.BackBtn').forEach(backBtn => {
        backBtn.addEventListener('click', () => {
            boxLoobReply.style.display = 'none';
            boxLoobReply2.style.display = 'none';
            boxsaLoob.style.display = 'block';
        });
    });

    // Fetch and populate complaints
    fetchComplaints();

    // Add dynamic event listener for View buttons
    function fetchComplaints() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PHPBackend/Complaint.php?action=fetch_complaints', true);

        xhr.onload = function () {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                
                if (response.success) {
                    var tbody = document.querySelector("table tbody");
                    tbody.innerHTML = '';

                    response.data.forEach(function (item) {
                        var tr = document.createElement("tr");

                        // Complainee Name
                        var complaineeTd = document.createElement("td");
                        complaineeTd.textContent = item.complainee;
                        tr.appendChild(complaineeTd);

                        // Address
                        var addressTd = document.createElement("td");
                        addressTd.textContent = item.address || "N/A";
                        tr.appendChild(addressTd);

                        // Complaint
                        var complaintTd = document.createElement("td");
                        complaintTd.textContent = item.complaint;
                        tr.appendChild(complaintTd);

                        // Action buttons
                        var actionTd = document.createElement("td");
                        var viewButton = document.createElement("button");
                        viewButton.textContent = "View";
                        viewButton.className = "ViewBtnCom";
                        actionTd.appendChild(viewButton);
                        tr.appendChild(actionTd);

                        // Append row to table body
                        tbody.appendChild(tr);

                        // Add click event listener to open modal
                        viewButton.addEventListener('click', showModal);
                    });
                } else {
                    alert(response.error);
                }
            }
        };

        xhr.onerror = function () {
            console.error('Error making the request.');
        };

        xhr.send();
    }
});



// Call fetchComplaints when the page loads
document.addEventListener("DOMContentLoaded", fetchComplaints);
