//FUNCTION NG SIDEBAR 
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".MonthlyDuessContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("MonthlyDuessConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("MonthlyDuessConActivee");
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

//FUNCTION SA MODAL 
const profModal = document.getElementById("profileModal"); //Pang kuha ng Modal 
const profModalBtn = document.getElementById("myProfileBtn"); //Pang bukas ng modal sa profile pag pinindot
const spanEkis = document.getElementsByClassName("closeProf")[0]; //Pang close ng modal 

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
    // Hide all pages
    const pages = document.getElementsByClassName("page");
    for (var i = 0; i < pages.length; i++) {
        pages[i].classList.remove("activeProfModal");
    }
    // Show the selected page
    document.getElementById(pageName).classList.add("activeProfModal");
}


//FUNCTION FOR VIEW MODAL PAYMENTS 
document.addEventListener("DOMContentLoaded", function() {
    const montViewBtn = document.querySelector(".MontViewBtn");
    const modalForPayments = document.querySelector(".ModalForPayments");
    const closeMonth = document.querySelector(".closeMonth");

    const TbPaid = document.querySelector(".TbPaid");
    const ModalForConfirming = document.querySelector(".ModalForConfirming");
    const closeMonthTwo = document.querySelector(".closeMonthTwo");

    // Show modal on button click
    montViewBtn.addEventListener("click", function() {
        modalForPayments.style.display = "block";
    });

    TbPaid.addEventListener("click", function() {
        ModalForConfirming.style.display = "block";
    });

    // Hide modal on close button click
    closeMonth.addEventListener("click", function() {
        modalForPayments.style.display = "none";
    });

    closeMonthTwo.addEventListener("click", function() {
        ModalForConfirming.style.display = "none";
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const MDueInput = document.getElementById("MDue");
    const WBillInput = document.getElementById("WBill");
    const totalAmountInput = document.getElementById("totalAmount");

    // Function to calculate and update total amount
    const updateTotalAmount = () => {
        console.log("Updating total amount...");
        
        // Get values from input fields and convert them to numbers
        const MDue = parseFloat(MDueInput.value) || 0;
        const WBill = parseFloat(WBillInput.value) || 0;

        console.log("Monthly Due Amount:", MDue);
        console.log("Water Bill Amount:", WBill);
        
        // Calculate total amount
        const totalAmount = MDue + WBill;

        console.log("Total Amount:", totalAmount);
        
        // Update the value of the total amount input field
        totalAmountInput.value = totalAmount.toFixed(2); // Display total amount with 2 decimal places
    };

    // Call the updateTotalAmount function when the values in the input fields change
    MDueInput.addEventListener("input", updateTotalAmount);
    WBillInput.addEventListener("input", updateTotalAmount);

    console.log("Script loaded successfully.");
    updateTotalAmount();
});


document.addEventListener("DOMContentLoaded", () => {
const form = document.querySelector(".adminBayad"),
SendBtn = form.querySelector(".SendBtn");

form.onsubmit = (e) => {
    // Prevent the form from submitting normally
    e.preventDefault();
};
    
if (SendBtn) {
    SendBtn.onclick = () => {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "PHPBackend/AdminPayments.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            console.log(data);

            if (data === "success") {
              alert("Nice");

            } else {
            //   errorText.textContent = data;
            //   errorText.style.display = "block";
              console.log(data);
            }
          }
        }
      };

      let formData = new FormData(form);
      xhr.send(formData);
    };
  }


});
