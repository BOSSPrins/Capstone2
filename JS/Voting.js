document.addEventListener("DOMContentLoaded", function() {
    const buttonEme2 = document.querySelector('.buttonEme2');
    const eme2 = buttonEme2.querySelector('.eme2');
    const complaintsSubMenu = document.getElementById('complaintsSubMenu');

    // Dropdown & Rotation Functionality
    function toggleSubMenu() {
        complaintsSubMenu.classList.toggle('submenu-visible');
        eme2.classList.toggle('eme2-rotate');
    }

    buttonEme2.addEventListener('click', function(event) {
        event.preventDefault();
        toggleSubMenu();
    });
});

// DESIGN PARA SA PROFILE MODAL
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




//FUNCTION SA NAVBAR PAYMENTS AND HISTORY 
function togglePage(pageId) {
    // Hide all pages
    const pages = document.querySelectorAll('.page-content');
    pages.forEach(page => {
        page.style.display = 'none';
    });

    // Display the selected page
    const selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'block';
    }

    // Remove active state from all buttons
    const buttons = document.querySelectorAll('.page-btn');
    buttons.forEach(button => {
        button.classList.remove('Paginationnactive');
    });

    // Add active state to the clicked button
    const clickedButton = document.getElementById(pageId + 'Btn');
    if (clickedButton) {
        clickedButton.classList.add('Paginationnactive');
    }
}

const toggleContent = (contentId) => {
    // Hide all content sections
    const contents = document.querySelectorAll(".EachContentsMonth");
    contents.forEach((content) => {
        content.style.display = "none";
    });

    // Display the selected content or default content if contentId is not provided
    let selectedContent = document.getElementById(contentId);
    if (!selectedContent) {
        // If contentId is not provided or does not exist, retrieve from localStorage
        const storedContentId = localStorage.getItem('selectedContentId');
        selectedContent = document.getElementById(storedContentId);
    }

    if (selectedContent) {
        selectedContent.style.display = "block";
        // Store the selected content ID in localStorage
        localStorage.setItem('selectedContentId', selectedContent.id);
    }
}

// Function to run when the page loads
const onPageLoad = () => {
    // Retrieve the last selected content ID from localStorage
    const storedContentId = localStorage.getItem('selectedContentId');
    if (storedContentId) {
        toggleContent(storedContentId); // Display the last selected content
    } else {
        toggleContent('Payments'); // Display 'Payments' content by default if no stored ID
    }
}

// Call onPageLoad when the page finishes loading
window.addEventListener('load', onPageLoad);


//FUNCTION PARA SA DROPDOWN SET TIMER 
function toggleSetTimer() {
    const dropdownContent = document.getElementById("SetTimerDropDownn");
    dropdownContent.classList.toggle("show");

    // Rotate the emeSet element
    const emeSet = document.querySelector('.emeSet');
    emeSet.classList.toggle('rotateSet');
}

// Event listener to handle clicks
document.addEventListener('click', function(event) {
    const dropdownButton = document.querySelector('.dropSetTimer');
    const dropdownContent = document.getElementById("SetTimerDropDownn");

    // Check if the click is outside of the dropSetTimer button and the dropdown itself
    if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
        dropdownContent.classList.remove('show');
        const emeSet = document.querySelector('.emeSet');
        emeSet.classList.remove('rotateSet');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const generateButton = document.querySelector(".BtnGeneratee");
    const modal = document.getElementById("summaryModal");
    const closeBtn = modal.querySelector(".closeSummary");

    generateButton.addEventListener("click", function () {
        modal.style.display = "block"; // Show the modal
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none"; // Hide the modal
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});



// PANGALAWANG FUNCTION PARA SA DROPDOWN SET TIMER 
function toggleSetTimerTwo() {
    const dropdownContent = document.getElementById("SetTimerDropDownnTwo");
    dropdownContent.classList.toggle("showTwo");

    // Rotate the emeSet element
    const emeSetTwo = document.querySelector('.emeSetTwo');
    emeSetTwo.classList.toggle('rotateSetTwo');
}

// Event listener to handle clicks
document.addEventListener('click', function(eventTwo) {
    const dropdownButtonTwo = document.querySelector('.dropSetTimerTwo');
    const dropdownContentTwo = document.getElementById("SetTimerDropDownnTwo");

    // Check if the click is outside of the dropSetTimer button and the dropdown itself
    if (!dropdownButtonTwo.contains(eventTwo.target) && !dropdownContentTwo.contains(eventTwo.target)) {
        dropdownContentTwo.classList.remove('showTwo');
        const emeSetTwo = document.querySelector('.emeSetTwo');
        emeSetTwo.classList.remove('rotateSetTwo');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const generateButtonTwo = document.querySelector(".BtnGenerateeTwo");
    const modalTwo = document.getElementById("summaryModalTwo");
    const closeBtnTwo = modalTwo.querySelector(".closeSummaryTwo");

    generateButtonTwo.addEventListener("click", function () {
        modalTwo.style.display = "block"; // Show the modal
    });

    closeBtnTwo.addEventListener("click", function () {
        modalTwo.style.display = "none"; // Hide the modal
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (event.target === modalTwo) {
            modalTwo.style.display = "none";
        }
    });
});



// PANGALAWANG PAGINATION //
// function togglePageTwoo(pageId2) {
//     // Hide all pages
//     const pages2 = document.querySelectorAll('.page-Content2');
//     pages2.forEach(page => {
//         page.style.display = 'none';
//     });

//     // Display the selected page
//     const selectedPage2 = document.getElementById(pageId2);
//     if (selectedPage2) {
//         selectedPage2.style.display = 'block';
//     }

//     // Remove active state from all buttons
//     const buttons2 = document.querySelectorAll('.page-btn2');
//     buttons2.forEach(button => {
//         button.classList.remove('Paginationnactive2');
//     });

//     // Add active state to the clicked button
//     const clickedButton2 = document.getElementById(pageId2 + 'Btn');
//     if (clickedButton2) {
//         clickedButton2.classList.add('Paginationnactive2');
//     }
// }




//FUNCTION SA PAG PILI NG PICTURES 


const uploadButton = document.querySelector(".UploadPics");
const inputFile = document.querySelector(".inputFileCert");

uploadButton.addEventListener("click", function() {
    inputFile.click(); // Trigger file input click
});

inputFile.addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function(event) {
            const imageUrl = event.target.result;
            const img = new Image();
            img.src = imageUrl;

            img.onload = function() {
                const imageContainer = document.getElementById("CandiImageContainer");

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
    }
});

// 2ND 
const uploadButton2 = document.querySelector(".UploadPics2");
const inputFile2 = document.querySelector(".inputFileCert2");

uploadButton2.addEventListener("click", function() {
    inputFile2.click(); // Trigger file input click
});

inputFile2.addEventListener("change", function() {
    const file2 = this.files[0];
    if (file2) {
        const reader2 = new FileReader();

        reader2.onload = function(event) {
            const imageUrl2 = event.target.result;
            const img2 = new Image();
            img2.src = imageUrl2;

            img2.onload = function() {
                const imageContainer2 = document.getElementById("CandiImageContainer2");

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
    }
});

//3RD
const uploadButton3 = document.querySelector(".UploadPics3");
const inputFile3 = document.querySelector(".inputFileCert3");

uploadButton3.addEventListener("click", function() {
    inputFile3.click(); // Trigger file input click
});

inputFile3.addEventListener("change", function() {
    const file3 = this.files[0];
    if (file3) {
        const reader3 = new FileReader();

        reader3.onload = function(event) {
            const imageUrl3 = event.target.result;
            const img3 = new Image();
            img3.src = imageUrl3;

            img3.onload = function() {
                const imageContainer3 = document.getElementById("CandiImageContainer3");

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
    }
});


//4TH
const uploadButton4 = document.querySelector(".UploadPics4");
const inputFile4 = document.querySelector(".inputFileCert4");

uploadButton4.addEventListener("click", function() {
    inputFile4.click(); // Trigger file input click
});

inputFile4.addEventListener("change", function() {
    const file4 = this.files[0];
    if (file4) {
        const reader4 = new FileReader();

        reader4.onload = function(event) {
            const imageUrl4 = event.target.result;
            const img4 = new Image();
            img4.src = imageUrl4;

            img4.onload = function() {
                const imageContainer4 = document.getElementById("CandiImageContainer4");

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
    }
});

//5TH
const uploadButton5 = document.querySelector(".UploadPics5");
const inputFile5 = document.querySelector(".inputFileCert5");

uploadButton5.addEventListener("click", function() {
    inputFile5.click(); // Trigger file input click
});

inputFile5.addEventListener("change", function() {
    const file5 = this.files[0];
    if (file5) {
        const reader5 = new FileReader();

        reader5.onload = function(event) {
            const imageUrl5 = event.target.result;
            const img5 = new Image();
            img5.src = imageUrl5;

            img5.onload = function() {
                const imageContainer5 = document.getElementById("CandiImageContainer5");

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
    }
});

//6TH
const uploadButton6 = document.querySelector(".UploadPics6");
const inputFile6 = document.querySelector(".inputFileCert6");

uploadButton6.addEventListener("click", function() {
    inputFile6.click(); // Trigger file input click
});

inputFile6.addEventListener("change", function() {
    const file6 = this.files[0];
    if (file6) {
        const reader6 = new FileReader();

        reader6.onload = function(event) {
            const imageUrl6 = event.target.result;
            const img6 = new Image();
            img6.src = imageUrl6;

            img6.onload = function() {
                const imageContainer6 = document.getElementById("CandiImageContainer6");

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
    }
});

//7TH
const uploadButton7 = document.querySelector(".UploadPics7");
const inputFile7 = document.querySelector(".inputFileCert7");

uploadButton7.addEventListener("click", function() {
    inputFile7.click(); // Trigger file input click
});

inputFile7.addEventListener("change", function() {
    const file7 = this.files[0];
    if (file7) {
        const reader7 = new FileReader();

        reader7.onload = function(event) {
            const imageUrl7 = event.target.result;
            const img7 = new Image();
            img7.src = imageUrl7;

            img7.onload = function() {
                const imageContainer7 = document.getElementById("CandiImageContainer7");

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
    }
});


//8TH
const uploadButton8 = document.querySelector(".UploadPics8");
const inputFile8 = document.querySelector(".inputFileCert8");

uploadButton8.addEventListener("click", function() {
    inputFile8.click(); // Trigger file input click
});

inputFile8.addEventListener("change", function() {
    const file8 = this.files[0];
    if (file8) {
        const reader8 = new FileReader();

        reader8.onload = function(event) {
            const imageUrl8 = event.target.result;
            const img8 = new Image();
            img8.src = imageUrl8;

            img8.onload = function() {
                const imageContainer8 = document.getElementById("CandiImageContainer8");

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
    }
});

//9TH
const uploadButton9 = document.querySelector(".UploadPics9");
const inputFile9 = document.querySelector(".inputFileCert9");

uploadButton9.addEventListener("click", function() {
    inputFile9.click(); // Trigger file input click
});

inputFile9.addEventListener("change", function() {
    const file9 = this.files[0];
    if (file9) {
        const reader9 = new FileReader();

        reader9.onload = function(event) {
            const imageUrl9 = event.target.result;
            const img9 = new Image();
            img9.src = imageUrl9;

            img9.onload = function() {
                const imageContainer9 = document.getElementById("CandiImageContainer9");

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
    }
});


// //PANGALAWANG MGA DIVS NA PAG EEDITAN //
// function toggleDropOpsPos() {
//     const PositionDropDown = document.querySelector(".OptionDropDown");
//     PositionDropDown .classList.toggle("open");

//     // Rotate the emeSet element
//     const emeDropPos = document.querySelector('.emeDropPos');
//     emeDropPos.classList.toggle('rotateOption');
// }




function fetchResidentID() {
    // Get the full name from the input
    var fullName = document.getElementById("candi_Name").value.trim();
    
    // If the input is empty, clear the unique ID and error message
    if (!fullName) {
        document.getElementById("candi_ID").value = "";
        document.getElementById("iror").innerText = "";
        document.getElementById("iror").style.display = "none";
        return;
    }

    // Split the full name into parts (assuming format: Firstname Middlename Lastname)
    var nameParts = fullName.split(" ");
    
    // Check if name parts are valid
    if (nameParts.length < 3) {
        document.getElementById("iror").innerText = "Incomplete name";
        document.getElementById("iror").style.display = "block";
        console.log("Incomplete name");
        return;
    }

    var firstName = nameParts[0];
    var middleName = nameParts[1];
    var lastName = nameParts.slice(2).join(" ");

    console.log("First Name:", firstName);
    console.log("Middle Name:", middleName);
    console.log("Last Name:", lastName);

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "PHPBackend/VotingProcess.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the callback for when the request completes
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            var response = JSON.parse(xhr.responseText);
            console.log("Response Data:", response);
            if (response.success) {
                document.getElementById("candi_ID").value = response.unique_id;
                document.getElementById("iror").innerText = "";
                document.getElementById("iror").style.display = "none";
            } else {
                document.getElementById("iror").innerText = "Not found";
                document.getElementById("iror").style.display = "block";
                document.getElementById("candi_ID").value = "";
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    };

    // Define the data to send
    var data = "firstname=" + encodeURIComponent(firstName) +
               "&middlename=" + encodeURIComponent(middleName) +
               "&lastname=" + encodeURIComponent(lastName);

    // Send the request
    xhr.send(data);
}


// Fetch and render candidates on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchCandidates();
});

function fetchCandidates() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "PHPBackend/VotingProcess.php", true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                console.log("xhr.responseText:", xhr.responseText);
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    response.candidates.forEach(function(candidate) {
                        addCandidateToGeneratedDiv(candidate);
                    });
                } else {
                    console.error("Error fetching candidates:", response.error);
                }
            } catch (e) {
                console.error("Failed to parse JSON response:", e);
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    };
    xhr.send();
}

function addCandidateToGeneratedDiv(candidate) {
    console.log("Adding candidate to generated div:", candidate);
    
    const container = document.querySelector('.containerDivss');
    if (!container) {
        console.error("Container not found");
        return;
    }
    
    // Gawaan ng buong div 
    const newCandidateCon = document.createElement('div');
    newCandidateCon.classList.add('CandidatesCon');

    // At yung div ng pic
    const imageContainer = document.createElement('div');
    imageContainer.classList.add('CandiImageContainer');

    // Lagayan ng pic
    const img = document.createElement('img');
    img.src = `Pictures/${candidate.img}`; 
    img.alt = candidate.candidate_name;
    img.style.maxWidth = "100%";
    img.style.maxHeight = "100%"; 
    imageContainer.appendChild(img);

    // Eto naman sa pangalan ng candi
    const nameElement = document.createElement('p');
    nameElement.textContent = candidate.candidate_name;
    nameElement.classList.add('NameCandiInput');

    // Yung X sa gilid
    const closeButton = document.createElement('button');
    closeButton.classList.add('CloseButton');
    closeButton.textContent = 'X';

    closeButton.addEventListener('click', function() {
        container.removeChild(newCandidateCon);
    });

    newCandidateCon.appendChild(imageContainer);
    newCandidateCon.appendChild(nameElement);
    newCandidateCon.appendChild(closeButton);

    container.appendChild(newCandidateCon);
    console.log("New candidate div added to container.");
}

document.getElementById("candidateForm").onsubmit = submitForm;

function submitForm(event) {
    event.preventDefault();
    
    var form = document.getElementById("candidateForm");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "PHPBackend/VotingProcess.php", true);

    xhr.onload = function() {
        var irorDiv = document.getElementById("iror");
        var saksesDiv = document.getElementById("sakses");
        console.log("xhr.status:", xhr.status);
        if (xhr.status >= 200 && xhr.status < 300) {
        try {
            console.log("xhr.responseText:", xhr.responseText);
            var response = JSON.parse(xhr.responseText);  
            console.log("Parsed response:", response);
            
                if (response.success) {
                    saksesDiv.innerText = "Candidate added successfully!";
                    saksesDiv.style.display = "block";

                    // Add new candidate div
                    addCandidateToGeneratedDiv(response.candidate);

                    // Hide the success message after 5 seconds
                    setTimeout(function() {
                        saksesDiv.style.display = "none";
                        document.getElementById("candi_Name").value = ''; // Clear the name input
                        document.getElementById("previewImage").style.display = 'none'; // Hide the image preview
                        document.getElementById("candi_ID").style.display = 'none';
                    }, 5000);
               
                } else {
                    irorDiv.innerText = response.error || "Error adding candidate.";
                    irorDiv.style.display = "block";

                    // Hide the error message after 5 seconds
                    setTimeout(function() {
                        irorDiv.style.display = "none";
                    }, 5000);
                }
            } catch (e) {
                console.error("Failed to parse JSON response:", e);          
                irorDiv.innerText = "Server error.";
                irorDiv.style.display = "block";

                // Hide the error message after 5 seconds
                setTimeout(function() {
                    irorDiv.style.display = "none";
                }, 5000);
            }
        } else {
            console.error("Request failed with status:", xhr.status);
            irorDiv.innerText = "Invalid response format.";
            irorDiv.style.display = "block";

            // Hide the error message after 5 seconds
            setTimeout(function() {
                irorDiv.style.display = "none";
            }, 5000);
        }
    };

    xhr.send(formData);
}

// lumang pang generate ng div
// document.addEventListener('DOMContentLoaded', function() {
//     const addButton = document.querySelector('.addingDivsBtn');
//     const container = document.querySelector('.containerDivss');
//     let counter = 10; // Start counting from 10 to avoid id conflicts

//     addButton.addEventListener('click', function() {
//         counter++;
//         const newCandidateCon = document.createElement('div');
//         newCandidateCon.classList.add('CandidatesCon');
        
//         // Create the close button
//         const closeButton = document.createElement('div');
//         closeButton.classList.add('CloseButton');
//         closeButton.textContent = 'X'; // You can use an icon here if preferred
        
//         // Create the image container
//         const imageContainer = document.createElement('div');
//         imageContainer.classList.add('CandiImageContainer');
//         imageContainer.id = `CandiImageContainer${counter}`;
        
//         // Create the name input
//         const nameInput = document.createElement('input');
//         nameInput.classList.add('NameCandiInput');
//         nameInput.type = 'text';
//         nameInput.placeholder = 'Enter Candidate Name';
        
//         // Create the buttons container
//         const buttonsContainer = document.createElement('div');
//         buttonsContainer.classList.add('buttonsNgCandidates');
        
//         // Create upload button container
//         const uploadButtonContainer = document.createElement('div');
//         uploadButtonContainer.classList.add('btCandii');
        
//         // Create upload button
//         const uploadButton = document.createElement('button');
//         uploadButton.classList.add('buttonSivv');
//         uploadButton.classList.add(`UploadPics${counter}`);
//         uploadButton.textContent = ''; // Upload Picture inalis ko kasi di pa alam gagawin sa button
        
//         // Create file input
//         const fileInput = document.createElement('input');
//         fileInput.classList.add('inputFileCert');
//         fileInput.classList.add('inputts');
//         fileInput.classList.add(`inputFileCert${counter}`);
//         fileInput.type = 'file';
//         fileInput.id = `PresPic${counter}`;
//         fileInput.style.display = 'none';
        
//         // Append upload button and file input to the container
//         uploadButtonContainer.appendChild(uploadButton);
//         uploadButtonContainer.appendChild(fileInput);
        
//         // Create save button container
//         const saveButtonContainer = document.createElement('div');
//         saveButtonContainer.classList.add('btCandiiTwo');
        
//         // Create save button
//         const saveButton = document.createElement('button');
//         saveButton.classList.add('buttonSivv');
//         saveButton.classList.add('SaveBtn');
//         saveButton.textContent = ''; // Save inalis ko kasi di pa alam gagawin sa button
        
//         // Append save button to the container
//         saveButtonContainer.appendChild(saveButton);
        
//         // Append all created elements to the newCandidatesCon
//         newCandidateCon.appendChild(closeButton);
//         newCandidateCon.appendChild(imageContainer);
//         newCandidateCon.appendChild(nameInput);
//         newCandidateCon.appendChild(buttonsContainer);
        
//         // Append buttonsContainer to the newCandidateCon
//         buttonsContainer.appendChild(uploadButtonContainer);
//         buttonsContainer.appendChild(saveButtonContainer);
        
//         // Add event listener to the close button
//         closeButton.addEventListener('click', function() {
//             container.removeChild(newCandidateCon);
//         });

//         // Add event listener to the upload button
//         uploadButton.addEventListener('click', function() {
//             fileInput.click(); // Trigger file input click
//         });

//         // Add event listener to the file input
//         fileInput.addEventListener('change', function() {
//             const file = this.files[0];
//             if (file) {
//                 const reader = new FileReader();

//                 reader.onload = function(event) {
//                     const imageUrl = event.target.result;
//                     const img = new Image();
//                     img.src = imageUrl;

//                     img.onload = function() {
//                         // Find the correct image container for this candidate
//                         const imageContainer = newCandidateCon.querySelector('.CandiImageContainer');

//                         // Clear existing content
//                         imageContainer.innerHTML = "";

//                         // Set max-width and max-height to ensure the image fits within the container
//                         img.style.maxWidth = "100%";
//                         img.style.maxHeight = "100%";

//                         // Append the image to the container
//                         imageContainer.appendChild(img);
//                     };
//                 };

//                 reader.readAsDataURL(file);
//             }
//         });

//         // Append the new candidate section to the container
//         container.appendChild(newCandidateCon);
//     });
// });

// modal nung add new candidate
document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.querySelector('.addingDivsBtn');
    const closeButton = document.querySelector('.CloseAdding');
    const candidatesContainer = document.getElementById('addingCandidatesContainer');
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('previewImage');

    // Show the candidate addition form
    addButton.addEventListener('click', function() {
        candidatesContainer.style.display = 'block';
    });

    // Close the candidate addition form
    closeButton.addEventListener('click', function() {
        candidatesContainer.style.display = 'none';
        // Reset file input and image preview
        fileInput.value = ''; // Clear the selected file
        previewImage.style.display = 'none'; // Hide the preview image
    });

    // Add event listener to the file input element
    fileInput.addEventListener('change', function() {
        const file = this.files[0]; // Get the selected file

        if (file) {
            const reader = new FileReader(); // Initialize FileReader object

            // Set onload event handler
            reader.onload = function(e) {
                previewImage.src = e.target.result; // Set image source to the FileReader result
                previewImage.style.display = 'block'; // Display the preview image
            };

            // Read the file as Data URL (base64 format)
            reader.readAsDataURL(file);
        } else {
            previewImage.style.display = 'none'; // Hide the preview image if no file selected
        }
    });
});


function fetchTableData() {
    console.log('Fetching table data...');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'PHPBackend/VotingProcess.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            console.log('XHR ReadyState:', xhr.readyState);
            console.log('XHR Status:', xhr.status);
            if (xhr.status === 200) {
                console.log('Response received:', xhr.responseText);
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log('Response candidates:', response.candidates);
                    var tableBody = document.querySelector('.TableContainerRank tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    // Check if the candidates data is available
                    if (response.candidates && response.candidates.length > 0) {
                        response.candidates.forEach(function(candidate, index) {
                            console.log('Candidate:', candidate); // Debugging candidate data
                            var tr = document.createElement('tr');
                            tr.innerHTML = '<td>' + (index + 1) + '</td><td>' + candidate.candidate_name + '</td><td>' + (candidate.votes !== undefined ? candidate.votes : 0) + '</td>';
                            tableBody.appendChild(tr);
                        });
                    } else {
                        var tr = document.createElement('tr');
                        tr.innerHTML = '<td colspan="3">No candidates found</td>';
                        tableBody.appendChild(tr);
                    }
                } else {
                    console.log('Error:', response.error);
                }
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    xhr.send();
}

// Fetch data initially
fetchTableData();

// Set interval to refresh table every 5 seconds
setInterval(fetchTableData, 5000);
