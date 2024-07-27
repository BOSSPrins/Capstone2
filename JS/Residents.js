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

// //FUNCTION SA SUB-SIDEBAR 
// const buttonEme2 = document.querySelector('.buttonEme2');
// const eme2 = buttonEme2.querySelector('.eme2');
// const complaintsSubMenu = document.getElementById('complaintsSubMenu');

//     function toggleSubMenu() {
//         complaintsSubMenu.classList.toggle('submenu-visible');
//         eme2.classList.toggle('eme2-rotate');
//     }

//     buttonEme2.addEventListener('click', function(event) {
//         event.preventDefault();
//         toggleSubMenu();
//     });


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

document.addEventListener('DOMContentLoaded', function() {
    // Select the button that opens the modal
    const openModalButtons = document.querySelectorAll('.ResidentsViewBtn');
    
    // Select the close button inside the modal
    const closeModalButton = document.querySelector('.closeViewModal');
    
    // Select the modal itself
    const modal = document.querySelector('.containerNgViewModal');

    // Function to open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = 'none';
    }

    // Loop through each open modal button and attach click event listener
    openModalButtons.forEach(function(button) {
        button.addEventListener('click', openModal);
    });

    // Event listener to close the modal when the close button is clicked
    closeModalButton.addEventListener('click', closeModal);
});


$(document).ready(function () {
            
    $('.BiyuModal').click(function (e) { 
        e.preventDefault();
        
     var  user_id = $(this).closest('tr').find('.user_id').text();
       
        $.ajax({
            method: "POST",
            url: "PHPBackend/DashProcess.php",
            data: {
                'click_BiyuModal': true,
                'user_id':user_id,
            },

             success: function (response) {

                $.each(response, function (Key, value) { 

                    $('#userID').val(value['user_id']);
                    $('#Lname').val(value['last_name']);
                    $('#Fname').val(value['first_name']);
                    $('#Mname').val(value['middle_name']);
                    console.log("Before setting value to #Age:", value['sex']);
                    $('#Age').val(value['age']);
                    console.log("After setting value to #Age:", $('#Age').val());
                    console.log("Value of value['age']:", value['age']);
                    console.log("End of code execution");
                    // $('#Bplace').val(value['birthplace']);
                    $('#Sex').val(value['sex']);
                    $('#PhoneNum').val(value['phone_number']);
                    // $('#CitizShip').val(value['citizenship']);
                    $('#Blk').val(value['block']);
                    $('#Lot').val(value['lot']);
                    $('#ecName').val(value['ec_name']);
                    $('#ecRel').val(value['ec_relship']);
                    $('#ecNum').val(value['ec_phone_num']);
                    //$('#STName').val(value['street_name']);
                    $('#ecAddress').val("Blk " + value['block'] + " Lot " + value['lot']);
                    // + "  " + value['street_name'] + " St."
                });


             }
        });
    })

});
