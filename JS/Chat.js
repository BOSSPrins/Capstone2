//FUNCTION NG SIDEBAR 
const sidebarItems = document.querySelectorAll(".sidebarContainer a");
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".mainChatContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("mainChathConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("mainChathConActivee");
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


//FUNCTION FOR CHATBOX DROPDOWN 
document.querySelectorAll('.ItemDrop-btn').forEach(function(item) {
    item.addEventListener('click', function(e) {
        e.preventDefault()
        if(this.parentElement.classList.contains('active')) {
            this.parentElement.classList.remove('active')
        } else {
            document.querySelectorAll('.ItesmDropDown').forEach(function(i) {
                i.classList.remove('active')
            })
            this.parentElement.classList.add('active')
        }
    })
})

document.addEventListener("DOMContentLoaded", function() {
    const messageDisplay = document.getElementById("message-display");
    const messageInput = document.getElementById("message-input");
  
    messageInput.addEventListener("input", function() {
      adjustTextareaHeight();
    });
  
    function adjustTextareaHeight() {
      // Reset the height to auto to calculate the content height
      messageInput.style.height = "auto";
      // Set the height to the scrollHeight of the content
      messageInput.style.height = messageInput.scrollHeight + "px";
    }
  });





