//FUNCTION NG SIDEBAR 
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".AccountsssContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("AccountsssConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("AccountsssConActivee");
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

// //FUNCTION SA PAGPAPALABAS NG MODAL SA EDIT BUTTON
// const editButton = document.querySelector('.byuModal');
// const editModal = document.querySelector('.containerNgEditModal');
// const closeModalButton = document.querySelector('.klowsModal');

// function showEditModal() {
//     editModal.style.display = 'block';
// }

// function hideEditModal() {
//     editModal.style.display = 'none';
// }

// editButton.addEventListener('click', showEditModal);
// closeModalButton.addEventListener('click', hideEditModal);

// hangganan

document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('Accs_Edit_Modal'); // Corrected selector
    const closeModalButton = document.getElementById('Accs_Close_Modal');

    function showEditModal() {
        if (editModal) {
            editModal.style.display = 'flex'; // Change to 'flex' to align with the CSS display setting
            console.log("Modal opened");
        } else {
            console.error("Modal element not found");
        }
    }

    function hideEditModal() {
        if (editModal) {
            editModal.style.display = 'none';
        } else {
            console.error("Modal element not found");
        }
    }

    hideEditModal();
    // Attach event listeners to all buttons with class 'dashModal'
    const editButtons = document.querySelectorAll('.AccsModal');
    editButtons.forEach(button => {
        button.addEventListener('click', showEditModal);
    });

    if (closeModalButton) {
        closeModalButton.addEventListener('click', hideEditModal);
        console.log("Modal Closed");
    } else {
        console.error("Close button not found");
    }
});

// FUNCTION NG MODAL NG CONFIRM 
const delModal = document.getElementById("confirmModal");

function openConfirmModal() {
    delModal.style.display = "block";
}

function closeModal() {
    delModal.style.display = "none";
}


$(document).ready(function () {
            
  $('.BiyuModal').click(function (e) { 
      e.preventDefault();
      
   var  user_id = $(this).closest('tr').find('.user_id').text();
     
      $.ajax({
          method: "POST",
          url: "PHPBackend/AccProcess.php",
          data: {
              'click_BiyuModal': true,
              'user_id':user_id,
          },

           success: function (response) {

              $.each(response, function (Key, value) { 

                  $('#userID').val(value['user_id']);
                  $('#conf_userID').val(value['user_id']);
                  $('#Lname').val(value['last_name']);
                  $('#Fname').val(value['first_name']);
                  $('#Mname').val(value['middle_name']);
                  // $('#Bday').val(value['birthday']);
                  // $('#Bplace').val(value['birthplace']);
                  $('#Sex').val(value['sex']);
                  $('#Age').val(value['age']);
                  $('#ContNum').val(value['phone_number']);
                  // $('#CitizShip').val(value['citizenship']);
                  $('#Blk').val(value['block']);
                  $('#Lot').val(value['lot']);
                  // $('#ecName').val(value['ec_name']);
                  // $('#ecRel').val(value['ec_relship']);
                  // $('#ecNum').val(value['ec_phone_num']);
                  //$('#STName').val(value['street_name']);
                  $('#ecAddress').val("Blk " + value['block'] + " Lot " + value['lot']);
                  // + "  " + value['street_name'] + " St."
              });


           }
      });
  })

    // Button ng delete sa table
    $(document).on("click", ".confBOTON", function(){
        var user_id = $(this).closest('tr').find('.user_id').text();
        $('.confirm_userID').val(user_id);               
    });

    window.closeModal = function() {
        $('#confirmModal').hide();
    };

    $('.ConfirmSaModal').click(function (e) { 
        e.preventDefault();
        var confirm_userID = $('.confirm_userID').val();
        console.log('confirm_userID:', confirm_userID);
        
        $.ajax({
            type: "POST",
            url: "PHPBackend/ConfirmProcess.php",
            data: {
                'Confirm_conf': true,
                'confirm_userID': confirm_userID,
            },
            success: function (response) {
                try {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success) {
                        console.log('User confirmed successfully');

                        $("tr:has(td.user_id:contains('" + confirm_userID + "'))").remove(); 
                        closeModal();
                        location.reload();
                    } else {
                        console.error('Failed to remove record:', jsonData.error);
                    }
                } catch (error) {
                    console.error('Error parsing remove response:', error);
                }
                
            },
            error: function(xhr, status, error) {
                console.error('Delete AJAX error:', error);
            }
        });
    });
});