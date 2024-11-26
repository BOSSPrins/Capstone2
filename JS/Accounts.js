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
        // Select the button that opens the modal
        const openViewModalAccounts = document.querySelectorAll('.AccViewBtn');
        
        // Select the close button inside the modal
        const closeViewModalAccounts = document.querySelector('.closeViewModal');
        
        // Select the modal itself
        const ViewModalNgAccounts = document.querySelector('.containerNgViewModalAcc');
    
        // Function to open the modal
        function openModalCss() {
            ViewModalNgAccounts .style.display = 'block';
        }
    
        // Function to close the modal
        function closeModalAcc() {
            ViewModalNgAccounts .style.display = 'none';
        }
    
        // Loop through each open modal button and attach click event listener
        openViewModalAccounts.forEach(function(button) {
            button.addEventListener('click', openModalCss);
        });
    
        // Event listener to close the modal when the close button is clicked
        closeViewModalAccounts.addEventListener('click', closeModalAcc);
    });




    function sendConfirmationEmail(userId) {
        // Get the user_id from the data-news-id attribute
        // var userId = button.getAttribute('data-news-id');
        console.log("Sending email to user with ID:", userId);
        
        // Log the user_id to the console for debugging purposes
        console.log("User ID:", userId);
        
        // Check if userId is empty
        if (!userId) {
            alert("User ID is not set.");
            return;
        }
        
        // Example: Make an AJAX call to send the user_id to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "Emailer/ConfirmEmail.php", true); // Ensure this path is correct
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the response from the server
                    console.log(xhr.responseText);
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            alert("Error: " + response.error);
                        } else {
                            alert("Confirmation Email sent successfully.");
                            location.reload();
                        }
                    } catch (e) {
                        alert("Failed to parse JSON response: " + xhr.responseText);
                    }
                } else {
                    alert("Failed to communicate with the server. Status: " + xhr.status);
                }
            }
        };
        console.log("Sending user_id:", userId);
        xhr.send("user_id=" + encodeURIComponent(userId));
    }


    // FUNCTION NG MODAL NG CONFIRM 
    const confModal = document.getElementById("confirmModal");

    function openConfirmModal() {
        confModal.style.display = "block";
    }

    function closeModal() {
        confModal.style.display = "none";
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

                        $('#userID').val(value['unique_id']); // ginawa kong unique_id kasi di tugma si user_id sa database ng tblacc at tblresident
                        $('#conf_userID').val(value['user_id']);
                        $('#Lname').val(value['last_name']);
                        $('#Fname').val(value['first_name']);

                        // pang display ng N/A kapag walang laman talaga
                        var middleName = value['middle_name'] ? value['middle_name'] : 'N/A';
                        $('#Mname').val(middleName);

                        var suffix = value['suffix'] ? value['suffix'] : 'N/A';
                        $('#Suffix').val(suffix);

                        //pang lagay ng formated na bertdey (May 21, 2003)
                        var dob = new Date(value['birthday']);
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var formattedDOB = dob.toLocaleDateString('en-US', options);
                        $('#dob').val(formattedDOB);

                        // $('#dob').val(value['birthday']);
                        // $('#Bplace').val(value['birthplace']);
                        $('#Gender').val(value['sex']);
                        $('#Age').val(value['age']);
                        $('#PhoneNum').val(value['phone_number']);
                        // $('#CitizShip').val(value['citizenship']);
                        $('#Blk').val(value['block']);
                        $('#Lot').val(value['lot']);
                        // $('#ecName').val(value['ec_name']);
                        // $('#ecRel').val(value['ec_relship']);
                        // $('#ecNum').val(value['ec_phone_num']);

                        var street = value['street_name'] ? value['street_name'] : 'N/A';
                        $('#STName').val(street);
                        
                        // $('#STName').val(value['street_name']);
                        $('#ecAddress').val("Blk " + value['block'] + " Lot " + value['lot']);
                        // + "  " + value['street_name'] + " St."

                        $('.footerNgViewModal .DecBtn').data('news-id', value['user_id']);
                        $('.footerNgViewModal .AcceptBtn').data('news-id', value['user_id']);
                    });


                }
            });
        })

        // // Button ng confirm sa table
        // $(document).on("click", ".confBOTON", function(){
        //     var user_id = $(this).closest('tr').find('.user_id').text();
        //     $('.confirm_userID').val(user_id);               
        // });

        window.closeModal = function() {
            $('#confirmModal').hide();
        };

        $('.ConfBtn').click(function (e) { 
            e.preventDefault();
            var confirm_userID = $('#userID').val(); 
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
                            console.log('User confirmed successfully po');
                            console.log('User confirmed successfully');
                                sendConfirmationEmail(confirm_userID);
                                $("tr:has(td.user_id:contains('" + confirm_userID + "'))").remove(); 
                                closeModal();
                    
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



        // email ng reejct
        $(document).on("click", ".DecBtn", function (e) {
            e.preventDefault();
        
            var reject_userID = $('#userID').val();
            console.log('reject_userID:', reject_userID);
        
            // Send the rejection email first
            sendRejectingEmail(reject_userID, function (emailSuccess) {
                if (emailSuccess) {
                    // Proceed with deleting the user after the email is sent
                    $.ajax({
                        type: "POST",
                        url: "PHPBackend/RejectProcess.php",
                        data: {
                            'reject_user': true,
                            'reject_userID': reject_userID
                        },
                        success: function (response) {
                            try {
                                var jsonData = JSON.parse(response);
                                if (jsonData.success) {
                                    console.log('User rejected successfully');
                                    // Remove the table row containing the rejected user ID
                                    $("tr:has(td.user_id:contains('" + reject_userID + "'))").remove();
                                } else {
                                    console.error('Failed to remove record:', jsonData.error);
                                }
                            } catch (error) {
                                console.error('Error parsing remove response:', error);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Delete AJAX error:', error);
                        }
                    });
                } else {
                    alert("Failed to send rejection email. User deletion aborted.");
                }
            });
        });
        
        // Adjusted sendRejectingEmail function
        function sendRejectingEmail(userId, callback) {
            console.log("Sending email to user with ID:", userId);
        
            if (!userId) {
                alert("User ID is not set.");
                callback(false);
                return;
            }
        
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Emailer/RejectEmail.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.error) {
                                alert("Error: " + response.error);
                                callback(false);
                            } else {
                                alert("Rejection Email sent successfully.");
                                callback(true);
                            }
                        } catch (e) {
                            alert("Failed to parse JSON response: " + xhr.responseText);
                            callback(false);
                        }
                    } else {
                        alert("Failed to communicate with the server. Status: " + xhr.status);
                        callback(false);
                    }
                }
            };
            xhr.send("user_id=" + encodeURIComponent(userId));
        }
        
    });
