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

document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.querySelector("tbody");
    const pageUl = document.querySelector(".pagination");
    const dropdownSelected = document.getElementById("dropdownSelected");
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
        
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
