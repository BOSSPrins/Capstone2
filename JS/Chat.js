document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll('.sideside');
    const submenuLinks = document.querySelectorAll('.subMenuComp a, .subMenuDocs a');
    const complaintsDropdown = document.getElementById('complaintsDropdown');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');
    const documentsDropdown = document.getElementById('documentsDropdown');
    const documentsSubMenu = document.getElementById('documentsSubMenu');
    const buttonEme3 = document.querySelector('.buttonEme3');
    const eme3 = buttonEme3.querySelector('.eme3');

    // Variables to track submenu visibility independently
    let submenuVisibleComp = false;
    let submenuVisibleDocs = false;

    // Get the current page URL
    const activePage = window.location.pathname.split("/").pop();

    // Highlight the active sidebar link
    sidebarLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        if (linkHref === activePage) {
            link.classList.add('baractive');
        } else {
            link.classList.remove('baractive');
        }
    });

    // Highlight submenu items and open submenu if needed
    submenuLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        if (linkHref === activePage) {
            link.classList.add('baractive');
            if (link.closest('#complaintsSubMenu')) {
                complaintsSubMenu.classList.add('CompSubMenuVisible');
                eme2.classList.add('eme2-rotate');
                submenuVisibleComp = true;
            } else if (link.closest('#documentsSubMenu')) {
                documentsSubMenu.classList.add('DocsSubmenuVisible');
                eme3.classList.add('eme3-rotate');
                submenuVisibleDocs = true;
            }
        } else {
            link.classList.remove('baractive');
        }
    });

    // Toggle submenu visibility on button click (Complaints)
    buttonEme2.addEventListener('click', function (event) {
        event.preventDefault();
        // Toggle only the complaints submenu, keep the documents unaffected
        submenuVisibleComp = !submenuVisibleComp;
        if (submenuVisibleComp) {
            complaintsSubMenu.classList.add('CompSubMenuVisible');
            eme2.classList.add('eme2-rotate');
        } else {
            complaintsSubMenu.classList.remove('CompSubMenuVisible');
            eme2.classList.remove('eme2-rotate');
        }
    });

    // Toggle submenu visibility on button click (Documents)
    buttonEme3.addEventListener('click', function (event) {
        event.preventDefault();
        // Toggle only the documents submenu, keep the complaints unaffected
        submenuVisibleDocs = !submenuVisibleDocs;
        if (submenuVisibleDocs) {
            documentsSubMenu.classList.add('DocsSubmenuVisible');
            eme3.classList.add('eme3-rotate');
        } else {
            documentsSubMenu.classList.remove('DocsSubmenuVisible');
            eme3.classList.remove('eme3-rotate');
        }
    });

    // Ensure submenu doesn't close when a submenu link is clicked (Complaints)
    submenuLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent click from bubbling up to toggle

            // Highlight the clicked link
            submenuLinks.forEach(item => item.classList.remove('baractive'));
            link.classList.add('baractive');

            // Ensure submenu remains open
            if (link.closest('#complaintsSubMenu')) {
                complaintsSubMenu.classList.add('CompSubMenuVisible');
                complaintsDropdown.classList.remove('baractive');
            }
            if (link.closest('#documentsSubMenu')) {
                documentsSubMenu.classList.add('DocsSubmenuVisible');
                documentsDropdown.classList.remove('baractive');
            }
        });
    });

    // No global click listener for closing submenus
    // We will now manage closing submenus through the button click toggles.
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

  document.addEventListener('DOMContentLoaded', function () {
    const mgaKausapDiv = document.querySelector('.IntervalStats');
    let interval;

    function startInterval() {
        interval = setInterval(function () {
            console.log('Interval runninggggggggggggg');
            // Place your interval logic here
        }, 500);
    }

    function stopInterval() {
        clearInterval(interval);
    }

    mgaKausapDiv.addEventListener('mouseenter', stopInterval);
    mgaKausapDiv.addEventListener('mouseleave', startInterval);

    startInterval();  // Start the interval when the page loads
});

// Backend ni Chat
const usersList = document.querySelector(".userslisto"),
searchBar = document.querySelector(".sertslist");

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else {
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();      //start ajax creating XML object
    xhr.open("POST", "PHPBackend/Search.php", true);
    xhr.onload = ()=>{  
        if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              console.log(data);
              usersList.innerHTML = data;
            } 
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}


setInterval(()=>{

    let xhr = new XMLHttpRequest();      //start ajax creating XML object
    xhr.open("GET", "PHPBackend/Chat.php", true);
    xhr.onload = ()=>{  
        if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              console.log(data);
              if(!searchBar.classList.contains("active")){
                usersList.innerHTML = data;
              }
            } 
        }
    }
    xhr.send();
}, 500); // magarun ito nang tuloy tuloy after 500 ms

// NAKA BOLD NA YUNG TEXT NG RECEIVER PERO HINDI ITIM




