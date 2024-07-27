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

//FUNCTION SA SUB-SIDEBAR 
const buttonEme2 = document.querySelector('.buttonEme2');
const eme2 = buttonEme2.querySelector('.eme2');
const complaintsSubMenu = document.getElementById('complaintsSubMenu');

function toggleSubMenu() {
    complaintsSubMenu.classList.toggle('submenu-visible');
    eme2.classList.toggle('eme2-rotate');
}

buttonEme2.addEventListener('click', function(event) {
    event.preventDefault();
    toggleSubMenu();
});

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.checkboxx');
    const countInput = document.querySelector('.text');

    let currentCount = 0;

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                if (currentCount < 9) {
                    currentCount++;
                } else {
                    this.checked = false; // Prevent checking if max count is reached
                    return;
                }
            } else {
                currentCount--;
            }

            countInput.value = currentCount;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const generateButton = document.querySelector(".buttonSubmitBoto");
    const summary_modal = document.getElementById("UsersSummaryModal");
    const closeBtn = summary_modal.querySelector(".UsersCloseSummary"); // Fix: select close button correctly

    generateButton.addEventListener("click", function () {
        summary_modal.style.display = "block"; // Show the modal
    });

    closeBtn.addEventListener("click", function () {
        summary_modal.style.display = "none"; // Hide the modal
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (event.target === summary_modal) {
            summary_modal.style.display = "none";
        }
    });
});


//PANGALAWANG MGA DIVS NA PAG EEDITAN //
function toggleDropOpsPos() {
    const PositionDropDown = document.querySelector(".OptionDropDown");
    PositionDropDown .classList.toggle("open");

    // Rotate the emeSet element
    const emeDropPos = document.querySelector('.emeDropPos');
    emeDropPos.classList.toggle('rotateOption');
}


document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('summaryModalTwo');
    var btn = document.querySelector('.buttonSubmitBoto2');
    var span = document.querySelector('.closeSummaryTwo');

    // Show the modal
    btn.onclick = function() {
        modal.style.display = 'block';
    }

    // Hide the modal
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Hide the modal if the user clicks outside of it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
});

    