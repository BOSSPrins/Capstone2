//FUNCTION NG SIDEBAR 
const sidebarItems = document.querySelectorAll(".sidebarContainer a");
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".mainDashContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("mainDashConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("mainDashConActivee");
});
 
// Add event listeners to sidebar items
sidebarItems.forEach(item => {
    item.addEventListener("click", function() {
        // Remove active class from all sidebar items
        sidebarItems.forEach(item => {
            item.classList.remove("active");
        });
 
        // Add active class to the clicked item
        this.classList.add("active");
    });
});
 
 
//FUNCTION NG FILTER DROPDOWN     
// Nag lagay ng function para mag-on at mag-off yung dropdown, tapos pumili.
function setupDropdown(dropdown) {
    const select = dropdown.querySelector('.selectContainer');
    const eme = dropdown.querySelector('.eme');
    const menu = dropdown.querySelector('.selectMenu');
    const options = dropdown.querySelectorAll('.selectMenu li');
    const selected = dropdown.querySelector('.selected');
    const placeholder = 'Filter'; // Placeholder text
 
    // Function para ibalik ang dropdown sa static na pangalan.
    function resetDropdown() {
        selected.innerText = placeholder;
        eme.style.transform = 'rotate(0deg)';
        options.forEach(option => option.classList.remove('selectActive'));
    }
 
    select.addEventListener('click', () => {
        select.classList.toggle('select-clicked');
        menu.classList.toggle('selectMenu-open');
        if (select.classList.contains('select-clicked')) {
            eme.style.transform = 'rotate(180deg)';
        } else {
            eme.style.transform = 'rotate(0deg)';
        }
    });
 
    options.forEach(option => {
        option.addEventListener('click', () => {
            selected.innerText = option.innerText;
            select.classList.remove('select-clicked');
            menu.classList.remove('selectMenu-open');
            options.forEach(option => {
                option.classList.remove('selectActive');
            });
            option.classList.add('selectActive');
            eme.style.transform = 'rotate(0deg)';
        });
    });
 
    // Naglagay ng addEvenListener para i-reset ang dropdown kapag nag-click sa labas o i-refresh.
    document.addEventListener('click', (event) => {
        const isClickInside = dropdown.contains(event.target);
        if (!isClickInside) {
            resetDropdown();
        }
    });
}
 
//  Kunin ang lahat ng dropdown at i-set up.
const dropDowns = document.querySelectorAll('.dropDown');
dropDowns.forEach(setupDropdown);
 
//FUNCTION FOR COMPLAIN DROPDOWN 
const eme2 = document.querySelector('.eme2');

// Function to toggle the visibility of the submenu and rotate eme2
function toggleSubMenu() {
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
    complaintsSubMenu.classList.toggle('submenu-visible');
    eme2.classList.toggle('eme2-rotate');
}

// Add click event listener to eme2
eme2.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    toggleSubMenu(); // Toggle the submenu visibility and rotate eme2
});

