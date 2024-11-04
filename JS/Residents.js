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


// ETO YUNG LUMANG FUNCTION NG VIEW BUTTON SA TABLE
// document.addEventListener('DOMContentLoaded', function() {
//     const modal = document.getElementById('ViewModalResidents');
//     const viewButtons = document.querySelectorAll('.ResidentsViewBtn');
//     const closeModalButton = document.querySelector('.closeViewModal');

//     viewButtons.forEach(function(button) {
//         button.addEventListener('click', function() {
//             console.log('Button clicked, opening modal'); // Debugging log
//             modal.style.display = 'block'; // Show the modal
//         });
//     });

//     // Close the modal when the 'X' is clicked
//     if (closeModalButton) {
//         closeModalButton.addEventListener('click', function() {
//             modal.style.display = 'none';
//         });
//     }

//     // Close modal when clicking outside the modal content
//     window.addEventListener('click', function(event) {
//         if (event.target === modal) {
//             modal.style.display = 'none';
//         }
//     });
// });


document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.querySelector("tbody");
    const pageUl = document.querySelector(".pagination");
    const dropdownSelected = document.getElementById("dropdownSelected");
    
    let tr = Array.from(tbody.querySelectorAll("tr"));
    let emptyBox = [...tr];
    let index = 1;
    let itemPerPage = 15;

    // Handle dropdown
    dropdownSelected.addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent event from bubbling up
        this.parentElement.classList.toggle("open");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        if (!dropdownSelected.parentElement.contains(event.target)) {
            dropdownSelected.parentElement.classList.remove("open");
        }
    });

    document.querySelectorAll(".option").forEach(option => {
        option.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevent closing on option click
            const value = this.dataset.value;
            const selected = this.closest(".dropdown").querySelector(".selected");
            selected.textContent = this.textContent;
            itemPerPage = parseInt(value);
            index = 1; // Reset to the first page when the items per page changes
            displayPage(itemPerPage);
            pageGenerator(itemPerPage);
            activatePageLinks(itemPerPage);
            dropdownSelected.parentElement.classList.remove("open"); // Close dropdown after selection
        });
    });

    // Handle sorting
    function sortTable(n, evt) {
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

    // Load table data on page load
    function loadTableData() {
        $.ajax({
            method: "POST",
            url: "PHPBackend/DashProcess.php",
            data: {
                'action': 'search_residents',
                'search_query': '',
                'filter_option': ''
            },
            success: function (response) {
                $('#residentTableBody').html(response);
                emptyBox = Array.from(tbody.querySelectorAll("tr")); // Update emptyBox after loading new data
                displayPage(itemPerPage);
                pageGenerator(itemPerPage);
                activatePageLinks(itemPerPage);
            }
        });
    }

    loadTableData();  // Trigger the load when the page first loads

    // Filter and search as you type
    $('#search, input[name="filter_option"]').on('keyup change', function() {
        var searchQuery = $('#search').val().trim();
        var filterOption = $('input[name="filter_option"]:checked').val();
        
        $.ajax({
            method: "POST",
            url: "PHPBackend/DashProcess.php",
            data: {
                'action': 'search_residents',
                'search_query': searchQuery,
                'filter_option': filterOption
            },
            success: function (response) {
                $('#residentTableBody').html(response);
                emptyBox = Array.from(tbody.querySelectorAll("tr")); // Update emptyBox after new results
                displayPage(itemPerPage);
                pageGenerator(itemPerPage);
                activatePageLinks(itemPerPage);
            }
        });
    });

    // BiyuModal click event handling
    $(document).on('click', '.BiyuModal', function (e) { 
        e.preventDefault();
        var user_id = $(this).closest('tr').find('.user_id').text();
        
        $.ajax({
            method: "POST",
            url: "PHPBackend/DashProcess.php",
            data: {
                'action': 'fetch_user_data',
                'user_id': user_id
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $('#userID').val(value['user_id']);
                    $('#Lname').val(value['last_name']);
                    $('#Fname').val(value['first_name']);
                    $('#Mname').val(value['middle_name']);
                    $('#Suffix').val(value['suffix']);
                    $('#Age').val(value['age']);
                    $('#Bday').val(value['birthday']);
                    $('#Sex').val(value['sex']);
                    $('#PhoneNum').val(value['phone_number']);
                    $('#Blk').val(value['block']);
                    $('#Lot').val(value['lot']);
                    $('#STName').val(value['street_name']);
                    $('#ecName').val(value['ec_name']);
                    $('#ecRel').val(value['ec_relship']);
                    $('#ecNum').val(value['ec_phone_num']);
                    $('#ecAddress').val("Blk " + value['block'] + " Lot " + value['lot']);
                });

                $('.containerNgViewModal').fadeIn(300); // Show the modal with fade-in effect
            }
        });
    });

    // Hide the modal when clicking the close button or outside the modal
    $('.closeViewModal').on('click', function() {
        $('.containerNgViewModal').fadeOut(300); // Fade out effect
    });

    $(window).on('click', function(event) {
        if (event.target.className === 'containerNgViewModal') {
            $('.containerNgViewModal').fadeOut(300); // Fade out when clicking outside the modal
        }
    });
});
