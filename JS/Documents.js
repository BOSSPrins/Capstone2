//FUNCTION NG SIDEBAR 
function showSidebar() {
  const sidebar = document.querySelector(".sidebarContainer");
  const mainContainer = document.querySelector(".DocumentsContainerr");
  const pagessContainer = document.querySelector(".pagess.active");
  sidebar.classList.remove("sideActive");
  mainContainer.classList.remove("DocumentsConActivee");
  pagessContainer.classList.remove("pagessActive");
}

const menuImage = document.querySelector(".menu");
menuImage.addEventListener("click", function() {
  const sidebar = document.querySelector(".sidebarContainer");
  const mainContainer = document.querySelector(".DocumentsContainerr");
  const pagessContainer = document.querySelector(".pagess.active");
  sidebar.classList.toggle("sideActive");
  mainContainer.classList.toggle("DocumentsConActivee");
  pagessContainer.classList.toggle("pagessActive");
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

function showPage(pageId) {
  // Hide all pages
  var pages = document.getElementsByClassName('pagess');
  for (var i = 0; i < pages.length; i++) {
      pages[i].classList.remove('active');
  }
  // Show the selected page
  var pageToShow = document.getElementById(pageId);
  if (pageToShow) {
      pageToShow.classList.add('active');
  }
}

function goBack() {
  // Hide all pages
  var pages = document.getElementsByClassName('pagess');
  for (var i = 0; i < pages.length; i++) {
      pages[i].classList.remove('active');
  }
} 




document.addEventListener("DOMContentLoaded", function () {
  const generateBtns = document.querySelectorAll(".GenerateBtn");
  const certificateModal = document.getElementById("certificateModal");

  generateBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
          certificateModal.style.display = "block";
      });
  });

  const closeCertificateBtn = document.querySelector(".certificateModal .CertClose");
  closeCertificateBtn.addEventListener("click", function () {
      certificateModal.style.display = "none";
  });
});

$(document).ready(function () {
            
  $('.docsModal').click(function (e) { 
      e.preventDefault();
      
   var  forms_id = $(this).closest('tr').find('.forms_id').text();
   console.log('forms_id:', forms_id);
    
      $.ajax({
        method: "POST",
        url: "PHPBackend/Verifying.php",
        data: {
            'forms_id': forms_id,
            'new_status': 'Verifying'
        },
        success: function (response) {
          
            console.log("UpdateStatus.php response:", response);
            var result = JSON.parse(response);
            if (result.status === 'success') {
                console.log("Status updated successfully to Verifying");
            } else {
                console.error("Error updating status:", result.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error in UpdateStatus.php request:", error);
            console.error("Status:", status);
            console.dir(xhr);
          }
       });
     
      $.ajax({
          method: "POST",
          url: "PHPBackend/DocsProcess.php",
          data: {
              'click_DocsModal': true,
              'forms_id':forms_id,
          },

              success: function (response) {
                console.log('AJAX response:', response);
                try {
                    var jsonResponse = (typeof response === 'string') ? JSON.parse(response) : response;
                    console.log('Parsed JSON response:', jsonResponse);
                    $.each(jsonResponse, function (key, value) {
                        $('#forms_id').val(value['forms_id']);
                        $('#fullName').val(value['first_name'] + " " + value['middle_name'] + " " + value['last_name']);
                        $('#fullAddress').val("Block " + value['block'] + " Lot " + value['lot']);
                        $('#purpose').val(value['form_name']);
                        $('#block').val(value['block']);
                        $('#lot').val(value['lot']);

                    });
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
     })  

        function handlePrint() {
          // Update the status to "Ready to Pick Up" using AJAX
          var forms_id = $('#forms_id').val();
          $.ajax({
              method: "POST",
              url: "PHPBackend/Pick_up.php",
              data: {
                  'forms_id': forms_id,
                  'new_status': 'Ready to Pick Up'
              },
              success: function(response) {
                  console.log('Status updated successfully to Ready to Pick Up');
              },
              error: function(xhr, status, error) {
                  console.error('Error updating status:', error);
              }
          });
      }

      // Add event listener for beforeprint event
      window.addEventListener('beforeprint', function(event) {
          console.log('beforeprint event triggered');
          handlePrint();
      });

      // When the confirm button is clicked
      $('.confirmBtn').click(function (e) {
        e.preventDefault();

        // Retrieve values from the modal inputs
        var fullName = $('#fullName').val();
        var block = $('#block').val();
        var lot = $('#lot').val();
        var purpose = $('#purpose').val();
        var forms_id = $('#forms_id').val();

        const monthNames = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];;
        const d = new Date();;
        const formattedDate = monthNames[d.getMonth()] + ', ' + d.getDate() + ' ' + d.getFullYear();;
        
     

        // Send the data to PrintDocs.php using AJAX
        $.ajax({
            method: "POST",
            url: "PHPBackend/PrintDocs.php",
            data: {
                'fullName': fullName,
                'block': block,
                'lot': lot,
                'purpose': purpose,
                'forms_id': forms_id,
                'dateIssued': formattedDate
            },
            success: function (response) {
                // Optionally handle the response
                console.log(response);

                // Open a new window with the generated document
                var newWindow = window.open("", "Print Document");
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error);
                console.error("Status: " + status);
                console.dir(xhr);
            }
        });

        
     
      });
});