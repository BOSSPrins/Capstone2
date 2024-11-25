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


//FUNCTION SA PAG PILI NG PICTURES 
const uploadButton = document.querySelector(".UploadPics");
const inputFile = document.querySelector(".inputFileCert");

uploadButton.addEventListener("click", function() {
    inputFile.click(); // Trigger file input click
});

inputFile.addEventListener("change", function() {
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        const imageUrl = event.target.result;
        const img = new Image();
        img.src = imageUrl;

        img.onload = function() {
            const imageContainer = document.getElementById("imageContainer");

            // Clear existing content
            imageContainer.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img.style.maxWidth = "100%";
            img.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer.appendChild(img);
        };
    };

    reader.readAsDataURL(file);
});

//FUNCTION SA PANGALAWANG PICTURE
const uploadButton2 = document.querySelector(".UploadPics2");
const inputFile2 = document.querySelector(".inputFileCert2");

uploadButton2.addEventListener("click", function() {
    inputFile2.click(); // Trigger file input click
});

inputFile2.addEventListener("change", function() {
    const file2 = this.files[0];
    const reader2 = new FileReader();

    reader2.onload = function(event) {
        const imageUrl2 = event.target.result;
        const img2 = new Image();
        img2.src = imageUrl2;

        img2.onload = function() {
            const imageContainer2 = document.getElementById("imageContainer2");

            // Clear existing content
            imageContainer2.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img2.style.maxWidth = "100%";
            img2.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer2.appendChild(img2);
        };
    };

    reader2.readAsDataURL(file2);
});

//FUNCTION SA PANGATLONG PICTURE
const uploadButton3 = document.querySelector(".UploadPics3");
const inputFile3 = document.querySelector(".inputFileCert3");

uploadButton3.addEventListener("click", function() {
    inputFile3.click(); // Trigger file input click
});

inputFile3.addEventListener("change", function() {
    const file3 = this.files[0];
    const reader3 = new FileReader();

    reader3.onload = function(event) {
        const imageUrl3 = event.target.result;
        const img3 = new Image();
        img3.src = imageUrl3;

        img3.onload = function() {
            const imageContainer3 = document.getElementById("imageContainer3");

            // Clear existing content
            imageContainer3.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img3.style.maxWidth = "100%";
            img3.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer3.appendChild(img3);
        };
    };

    reader3.readAsDataURL(file3);
});

//FUNCTION SA PANG-APAT NA PICTURE
const uploadButton4 = document.querySelector(".UploadPics4");
const inputFile4 = document.querySelector(".inputFileCert4");

uploadButton4.addEventListener("click", function() {
    inputFile4.click(); // Trigger file input click
});

inputFile4.addEventListener("change", function() {
    const file4 = this.files[0];
    const reader4 = new FileReader();

    reader4.onload = function(event) {
        const imageUrl4 = event.target.result;
        const img4 = new Image();
        img4.src = imageUrl4;

        img4.onload = function() {
            const imageContainer4 = document.getElementById("imageContainer4");

            // Clear existing content
            imageContainer4.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img4.style.maxWidth = "100%";
            img4.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer4.appendChild(img4);
        };
    };

    reader4.readAsDataURL(file4);
});

//FUNCTION SA PANG-LIMA NA PICTURE
const uploadButton5 = document.querySelector(".UploadPics5");
const inputFile5 = document.querySelector(".inputFileCert5");

uploadButton5.addEventListener("click", function() {
    inputFile5.click(); // Trigger file input click
});

inputFile5.addEventListener("change", function() {
    const file5 = this.files[0];
    const reader5 = new FileReader();

    reader5.onload = function(event) {
        const imageUrl5 = event.target.result;
        const img5 = new Image();
        img5.src = imageUrl5;

        img5.onload = function() {
            const imageContainer5 = document.getElementById("imageContainer5");

            // Clear existing content
            imageContainer5.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img5.style.maxWidth = "100%";
            img5.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer5.appendChild(img5);
        };
    };

    reader5.readAsDataURL(file5);
});

//FUNCTION SA PANG-ANIM NA PICTURE
const uploadButton6 = document.querySelector(".UploadPics6");
const inputFile6 = document.querySelector(".inputFileCert6");

uploadButton6.addEventListener("click", function() {
    inputFile6.click(); // Trigger file input click
});

inputFile6.addEventListener("change", function() {
    const file6 = this.files[0];
    const reader6 = new FileReader();

    reader6.onload = function(event) {
        const imageUrl6 = event.target.result;
        const img6 = new Image();
        img6.src = imageUrl6;

        img6.onload = function() {
            const imageContainer6 = document.getElementById("imageContainer6");

            // Clear existing content
            imageContainer6.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img6.style.maxWidth = "100%";
            img6.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer6.appendChild(img6);
        };
    };

    reader6.readAsDataURL(file6);
});

//FUNCTION SA PANG-PITO NA PICTURE
const uploadButton7 = document.querySelector(".UploadPics7");
const inputFile7 = document.querySelector(".inputFileCert7");

uploadButton7.addEventListener("click", function() {
    inputFile7.click(); // Trigger file input click
});

inputFile7.addEventListener("change", function() {
    const file7 = this.files[0];
    const reader7 = new FileReader();

    reader7.onload = function(event) {
        const imageUrl7 = event.target.result;
        const img7 = new Image();
        img7.src = imageUrl7;

        img7.onload = function() {
            const imageContainer7 = document.getElementById("imageContainer7");

            // Clear existing content
            imageContainer7.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img7.style.maxWidth = "100%";
            img7.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer7.appendChild(img7);
        };
    };

    reader7.readAsDataURL(file7);
});

//FUNCTION SA PANG-WALO NA PICTURE
const uploadButton8 = document.querySelector(".UploadPics8");
const inputFile8 = document.querySelector(".inputFileCert8");

uploadButton8.addEventListener("click", function() {
    inputFile8.click(); // Trigger file input click
});

inputFile8.addEventListener("change", function() {
    const file8 = this.files[0];
    const reader8 = new FileReader();

    reader8.onload = function(event) {
        const imageUrl8 = event.target.result;
        const img8 = new Image();
        img8.src = imageUrl8;

        img8.onload = function() {
            const imageContainer8 = document.getElementById("imageContainer8");

            // Clear existing content
            imageContainer8.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img8.style.maxWidth = "100%";
            img8.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer8.appendChild(img8);
        };
    };

    reader8.readAsDataURL(file8);
});

//FUNCTION SA PANG-SIYAM NA PICTURE
const uploadButton9 = document.querySelector(".UploadPics9");
const inputFile9 = document.querySelector(".inputFileCert9");

uploadButton9.addEventListener("click", function() {
    inputFile9.click(); // Trigger file input click
});

inputFile9.addEventListener("change", function() {
    const file9 = this.files[0];
    const reader9 = new FileReader();

    reader9.onload = function(event) {
        const imageUrl9 = event.target.result;
        const img9 = new Image();
        img9.src = imageUrl9;

        img9.onload = function() {
            const imageContainer9 = document.getElementById("imageContainer9");

            // Clear existing content
            imageContainer9.innerHTML = "";

            // Set max-width and max-height to ensure the image fits within the container
            img9.style.maxWidth = "100%";
            img9.style.maxHeight = "100%";

            // Append the image to the container
            imageContainer9.appendChild(img9);
        };
    };

    reader9.readAsDataURL(file9);
});

$(document).ready(function() {
    const modal = $("#successModal"); // Using jQuery to select the modal
    const okButton = $(".okButn.OkSaModal"); // Using jQuery to select the OK button

    // Function to open the success modal with fadeIn effect
    window.openSuccessModal = function() {
        console.log("Opening success modal");
        modal.fadeIn(); // Fade in the modal
    };

    // Event listener for the "OK" button to refresh the page
    okButton.on("click", function() {
        modal.fadeOut(function() {
            location.reload(); // Refresh the page after the modal has faded out
        });
    });
});




// AJAX NUNG MGA OFFICIALS
$(document).ready(function () {
    // Function to fetch and display user data based on role
    function displayUserData(roleLabel) {
        console.log('Fetching data for role:', roleLabel);
        $.ajax({
            method: "POST",
            url: "PHPBackend/Officials.php",
            data: { 'role': roleLabel },
            dataType: "json",
            success: function (response) {
                console.log('Response received:', response);

                // Ensure response is not null or undefined
                if (!response || !response.name || !response.image_url) {
                    console.error("Invalid response format:", response);
                    return;
                }

                // Iterate over each .everyConOfficial container
                $('.everyConOfficial').each(function () {
                    var container = $(this);
                    var roleValue = container.find('.LabelUpo').attr('value');

                    // Check if the role value of the container matches the role label
                    if (roleValue === roleLabel) {
                        // Update input field with user's name
                        container.find('.inputNgUUpo').val(response.name);

                        // Retrieve image URL from the response
                        var imageUrl = response.image_url.trim();
                        console.log('Image URL:', imageUrl); // Check if the image URL is being retrieved correctly

                        if (imageUrl) {
                            // Construct the image URL by concatenating the directory path and image name
                            var fullImageUrl = "Pictures/" + imageUrl;
                            // Update the image container with the image
                            container.find('.officialLaman').html('<img src="' + fullImageUrl + '">');
                        } else {
                            console.error("Image URL is undefined");
                        }
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Function to handle the form submission for updating user data
    function updateUserData(roleLabel, name, imageUrl) {
        var formData = new FormData();
        formData.append('role', roleLabel);
        formData.append('name', name);
        
        // Check if an image file is provided and append it to the form data
        if (imageUrl) {
            formData.append('image_url', imageUrl);
        }

        console.log('Updating data for role:', roleLabel);
        $.ajax({
            method: "POST",
            url: "PHPBackend/UpdateOfficials.php",
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
            contentType: false, // Set the content type to false as jQuery will tell the server its a query string request
            success: function (response) {
                console.log('Update response received:', response);
                // Optionally, you can refresh the displayed data here
                displayUserData(roleLabel);
                openSuccessModal();
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Example usage: Call the function to display user data for specific roles
    var roles = ['President', 'VicePresident', 'Secretary', 'Treasurer', 'Auditor', 'PeaceInOrder', 'Director1', 'Director2', 'Director3'];
    roles.forEach(function(role) {
        displayUserData(role);
    });

    // Event listener for the save buttons
    $('.SaveBtn').on('click', function () {
        var container = $(this).closest('.everyConOfficial');
        var roleLabel = container.find('.LabelUpo').attr('value');
        var name = container.find('.inputNgUUpo').val();
        var fileInput = container.find('input[type="file"]')[0]; // Get the file input element
        var imageUrl = fileInput.files[0]; // Get the selected file

        updateUserData(roleLabel, name, imageUrl);
    });
});