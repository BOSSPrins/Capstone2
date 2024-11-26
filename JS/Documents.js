// FUNCTION PARA SA PROFILE MODAL 
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

// FUNCTION PARA SA DOCUMENTS DETAILS       
// function toggleRequest(pageId) {
//     // Hide all pages
//     const pahina = document.querySelectorAll('.DocsTablessContainer'); // Changed variable name to pahina
//     pahina.forEach(page => {
//         page.style.display = 'none'; // Hide all containers
//     });

//     // Show the selected page
//     const selectedPage = document.getElementById(pageId);
//     if (selectedPage) {
//         selectedPage.style.display = 'flex'; // Use flex to maintain the layout
//     }

//     // Store the active page in local storage
//     localStorage.setItem('aktibContainer', pageId);
// }

// // Check local storage on page load to determine which container to show
// window.onload = function() {
//     const activeContainer = localStorage.getItem('aktibContainer');
//     toggleRequest(activeContainer || 'DocsTableCon'); // Default to 'DocsTableCon' if no active container is found
// }

function toggleRequest(pageId) {
    // Hide all pages
    const pahina = document.querySelectorAll('.DocsTablessContainer'); // Changed variable name to pahina
    pahina.forEach(page => {
        page.style.display = 'none'; // Hide all containers
    });

    // Show the selected page
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'flex'; // Use flex to maintain the layout
    }
}

// Set the default container to 'DocsTableCon' on page load
toggleRequest('DocsTableCon');



// document.addEventListener("DOMContentLoaded", function () {
//   const generateBtns = document.querySelectorAll(".GenerateBtn");
//   const certificateModal = document.getElementById("certificateModal");

//   generateBtns.forEach(function (btn) {
//       btn.addEventListener("click", function () {
//           certificateModal.style.display = "block";
//       });
//   });

//   const closeCertificateBtn = document.querySelector(".certificateModal .CertClose");
//   closeCertificateBtn.addEventListener("click", function () {
//       certificateModal.style.display = "none";
//   });
// });

// $(document).ready(function () {
            
//   $('.docsModal').click(function (e) { 
//       e.preventDefault();
      
//    var  forms_id = $(this).closest('tr').find('.forms_id').text();
//    console.log('forms_id:', forms_id);
    
//       $.ajax({
//         method: "POST",
//         url: "PHPBackend/Verifying.php",
//         data: {
//             'forms_id': forms_id,
//             'new_status': 'Verifying'
//         },
//         success: function (response) {
          
//             console.log("UpdateStatus.php response:", response);
//             var result = JSON.parse(response);
//             if (result.status === 'success') {
//                 console.log("Status updated successfully to Verifying");
//             } else {
//                 console.error("Error updating status:", result.message);
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("Error in UpdateStatus.php request:", error);
//             console.error("Status:", status);
//             console.dir(xhr);
//           }
//        });
     
//       $.ajax({
//           method: "POST",
//           url: "PHPBackend/DocsProcess.php",
//           data: {
//               'click_DocsModal': true,
//               'forms_id':forms_id,
//           },

//               success: function (response) {
//                 console.log('AJAX response:', response);
//                 try {
//                     var jsonResponse = (typeof response === 'string') ? JSON.parse(response) : response;
//                     console.log('Parsed JSON response:', jsonResponse);
//                     $.each(jsonResponse, function (key, value) {
//                         $('#forms_id').val(value['forms_id']);
//                         $('#fullName').val(value['first_name'] + " " + value['middle_name'] + " " + value['last_name']);
//                         $('#fullAddress').val("Block " + value['block'] + " Lot " + value['lot']);
//                         $('#purpose').val(value['form_name']);
//                         $('#block').val(value['block']);
//                         $('#lot').val(value['lot']);
//                         $('#id_unique').val(value['unique_id']);

//                     });
//                 } catch (e) {
//                     console.error('Error parsing JSON:', e);
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error('AJAX error:', status, error);
//             }
//         });
//      })  

//         function handlePrint() {
//           // Update the status to "Ready to Pick Up" using AJAX
//           var forms_id = $('#forms_id').val();
//           $.ajax({
//               method: "POST",
//               url: "PHPBackend/Pick_up.php",
//               data: {
//                   'forms_id': forms_id,
//                   'new_status': 'Ready to Pick Up'
//               },
//               success: function(response) {
//                   console.log('Status updated successfully to Ready to Pick Up');
//               },
//               error: function(xhr, status, error) {
//                   console.error('Error updating status:', error);
//               }
//           });
//       }

//       // Add event listener for beforeprint event
//       window.addEventListener('beforeprint', function(event) {
//           console.log('beforeprint event triggered');
//           handlePrint();
//       });

//       // When the confirm button is clicked
//       $('.confirmBtn').click(function (e) {
//         e.preventDefault();

//         // Retrieve values from the modal inputs
//         var fullName = $('#fullName').val();
//         var block = $('#block').val();
//         var lot = $('#lot').val();
//         var purpose = $('#purpose').val();
//         var forms_id = $('#forms_id').val();

//         const monthNames = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];;
//         const d = new Date();;
//         const formattedDate = monthNames[d.getMonth()] + ', ' + d.getDate() + ' ' + d.getFullYear();;
        
//         // Send the data to PrintDocs.php using AJAX
//             $.ajax({
//                 method: "POST",
//                 url: "PHPBackend/PrintDocs.php",
//                 data: {
//                     'fullName': fullName,
//                     'block': block,
//                     'lot': lot,
//                     'purpose': purpose,
//                     'forms_id': forms_id,
//                     'dateIssued': formattedDate
//                 },
//                 success: function (response) {
//                     // Optionally handle the response
//                     console.log(response);

//                     // Open a new window with the generated document
//                     var newWindow = window.open("", "Print Document");
//                     newWindow.document.write(response);
//                     newWindow.document.close();
//                     newWindow.print();
//                 },
//                 error: function (xhr, status, error) {
//                     console.error("Error: " + error);
//                     console.error("Status: " + status);
//                     console.dir(xhr);
//                 }
//             });   
//       });


//        // Email pagreject 
//     $(document).on("click", ".denyModal", function(){
//         var unique_id = $('#id_unique').val();
        
//         $('.reject_userID').val(unique_id);
//         console.log("Unique ID:", unique_id);   
//     });


// });