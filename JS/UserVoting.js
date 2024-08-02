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


// Dito lahat nagsisimula js nung user voting
document.addEventListener('DOMContentLoaded', function() {
    console.log("Document loaded, initializing...");

    const maxCandidates = 9;
    let selectedCandidates = [];

    // Function to update the checkbox count
    function updateCheckboxCount() {
        const checkboxes = document.querySelectorAll('.checkboxx');
        const countInput = document.querySelector('.text');
        let currentCount = 0;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (currentCount < maxCandidates) {
                        currentCount++;
                    } else {
                        this.checked = false; // Prevent checking if max count is reached
                        return;
                    }
                } else {
                    currentCount--;
                }

                countInput.value = currentCount;
                console.log("Checkbox count updated:", currentCount);
            });
        });
    }

    // Function to fetch candidates from the database
    function fetchCandidates() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "PHPBackend/VotingProcess.php", true); // Adjust URL as needed
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log("Fetched candidates:", response.candidates);
                        generateCandidateDivs(response.candidates);
                    } else {
                        console.error("Failed to fetch candidates:", response.error);
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

    // Function to generate candidate divs
    function generateCandidateDivs(candidates) {
        const container = document.querySelector('.User_containerDivss');
        if (container) {
            candidates.forEach(function(candidate) {
                const checkboxId = `Candidate${candidate.unique_id}`;

                const newDiv = document.createElement('div');
                newDiv.classList.add('User_CandidatesCon', 'form-element');
                newDiv.innerHTML = `
                    <input type="hidden" name="candidate_id" value="${candidate.unique_id}">
                    <input class="checkboxx" type="checkbox" name="platform" value="${candidate.unique_id}" id="${checkboxId}">
                    <label for="${checkboxId}">
                        <div class="User_CandiImageContainer">
                            <img src="Pictures/${candidate.img}" alt="${candidate.candidate_name}">
                        </div>
                        <div class="title">
                            <span>${candidate.candidate_name}</span>
                        </div>
                    </label>
                `;

                const checkbox = newDiv.querySelector('.checkboxx');
                checkbox.addEventListener('change', function() {
                    handleCheckboxChange(checkbox);
                });

                container.appendChild(newDiv);
            });

            updateCheckboxCount();
        }
    }

    function fetchCandidateData(candidateId) {
        return new Promise((resolve, reject) => {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', `PHPBackend/VotingProcess.php?id=${candidateId}`, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success && response.candidates.length > 0) {
                            // Find the candidate by ID
                            var candidate = response.candidates.find(c => c.unique_id === candidateId);
                            if (candidate) {
                                resolve(candidate);
                            } else {
                                reject('Candidate not found in the response');
                            }
                        } else {
                            reject('Candidate data is missing or request failed');
                        }
                    } catch (e) {
                        reject('Error parsing response');
                    }
                } else {
                    reject('Failed to fetch candidate');
                }
            };
            xhr.onerror = function() {
                reject('Request failed');
            };
            xhr.send();
        });
    }

    function handleCheckboxChange(checkbox) {
        console.log(`Checkbox changed: ${checkbox.value}, Checked: ${checkbox.checked}`);
        if (checkbox.checked) {
            if (selectedCandidates.length < maxCandidates) {
                addCandidate(checkbox.value);
            } else {
                checkbox.checked = false;
            }
        } else {
            removeCandidate(checkbox.value);
        }
    }

    function addCandidate(candidateId) {
        fetchCandidateData(candidateId).then(candidate => {
            console.log(`Fetched candidate data: ${JSON.stringify(candidate)}`);
            selectedCandidates.push(candidate);
            console.log(`Added candidate: ${JSON.stringify(candidate)}`);
            updateSummary();
        }).catch(error => {
            console.error("Error fetching candidate data:", error);
        });
    }

    function removeCandidate(candidateId) {
        selectedCandidates = selectedCandidates.filter(candidate => candidate.unique_id !== candidateId);
        console.log(`Removed candidate ID: ${candidateId}`);
        updateSummary();
    }

    function updateSummary() {
        console.log("Updating summary...");
        console.log(`Selected candidates: ${selectedCandidates.length}`);
        renderSummary();
    }

    function renderSummary() {
        console.log(`Rendering summary for ${selectedCandidates.length} candidates...`);
        for (let i = 1; i <= maxCandidates; i++) {
            const imgDiv = document.getElementById(`candi${i}_img`);
            const nameInput = document.getElementById(`candi${i}_name`);
            const idInput = document.getElementById(`candi${i}_ID`);

            if (imgDiv && nameInput && idInput) {
                if (i <= selectedCandidates.length) {
                    const candidate = selectedCandidates[i - 1];
                    console.log(`Rendering candidate ${i}: ${JSON.stringify(candidate)}`);
                    imgDiv.innerHTML = `<img src="Pictures/${candidate.img}" alt="${candidate.candidate_name}">`;
                    nameInput.value = candidate.candidate_name;
                    idInput.value = candidate.unique_id;
                } else {
                    console.log(`Clearing candidate ${i}`);
                    imgDiv.innerHTML = '';
                    nameInput.value = '';
                    idInput.value = '';
                }
            } else {
                console.error(`Element not found: candi${i}_img or candi${i}_name or candi${i}_ID`);
            }
        }
    }

    fetchCandidates();
});

// Pang insert ng boto ng user
document.getElementById('submitVoteButton').addEventListener('click', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    var user_ID = document.getElementById('user_ID').value;
    var candidate_IDs = [];
    for (var i = 1; i <= 9; i++) {
        var candidate_ID = document.getElementById('candi' + i + '_ID').value;
        if (candidate_ID) {
            candidate_IDs.push(candidate_ID);
        }
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/VotingProcess.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Votes submitted successfully');
            } else {
                console.log('Error: ' + response.error);
            }
        }
    };
    var data = {
        voter_id: user_ID,
        candidate_ids: candidate_IDs
    };
    xhr.send(JSON.stringify(data));
});






// // Function to check unique_id in session
// function checkUniqueIdInSession() {
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', 'PHPBackend/VotingProcess.php?check_unique_id=true', true);
//     xhr.onload = function() {
//         if (xhr.status >= 200 && xhr.status < 300) {
//             var response = JSON.parse(xhr.responseText);
//             if (response.success) {
//                 console.log("Unique ID in session:", response.unique_id);
//             } else {
//                 console.log("No unique ID in session");
//             }
//         } else {
//             console.error("Request failed with status:", xhr.status);
//         }
//     };
//     xhr.send();
// }

// // Call the function to check unique_id on page load
// document.addEventListener('DOMContentLoaded', function() {
//     checkUniqueIdInSession();
//     // Other initialization code
// });


document.addEventListener("DOMContentLoaded", function () {
    const generateButton = document.querySelector(".buttonSubmitBoto");
    const summary_modal = document.getElementById("UsersSummaryModal");
    const closeBtn = summary_modal.querySelector(".UsersCloseSummary"); // Fix: select close button correctly

    generateButton.addEventListener("click", function () {
        summary_modal.style.display = "block"; // Show the modal
    });

    closeBtn.addEventListener("click", function () {
        summary_modal.style.display = "none"; // Hide the modal
    });

    // Close the modal if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (event.target === summary_modal) {
            summary_modal.style.display = "none";
        }
    });
});

//PANGALAWANG MGA DIVS NA PAG EEDITAN //
function toggleDropOpsPos() {
    const PositionDropDown = document.querySelector(".OptionDropDown");
    PositionDropDown .classList.toggle("open");

    // Rotate the emeSet element
    const emeDropPos = document.querySelector('.emeDropPos');
    emeDropPos.classList.toggle('rotateOption');
}

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('summaryModalTwo');
    var btn = document.querySelector('.buttonSubmitBoto2');
    var span = document.querySelector('.closeSummaryTwo');

    // Show the modal
    btn.onclick = function() {
        modal.style.display = 'block';
    }

    // Hide the modal
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Hide the modal if the user clicks outside of it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
});

// Luma pero nagana
// document.addEventListener('DOMContentLoaded', function() {
//     console.log("Document loaded, initializing checkbox count...");
//     const checkboxes = document.querySelectorAll('.checkboxx');
//     const countInput = document.querySelector('.text');

//     let currentCount = 0;

//     checkboxes.forEach(function(checkbox) {
//         checkbox.addEventListener('change', function() {
//             if (this.checked) {
//                 if (currentCount < 9) {
//                     currentCount++;
//                 } else {
//                     this.checked = false; // Prevent checking if max count is reached
//                     return;
//                 }
//             } else {
//                 currentCount--;
//             }

//             countInput.value = currentCount;
//             console.log("Checkbox count updated:", currentCount);
//         });
//     });
// });
// document.addEventListener('DOMContentLoaded', function() {
//     console.log("Document loaded, fetching candidates...");
//     fetchCandidates();
// });
// function fetchCandidates() {
//     var xhr = new XMLHttpRequest();
//     xhr.open("GET", "PHPBackend/VotingProcess.php", true);
//     xhr.onload = function() {
//         console.log("XHR request completed with status:", xhr.status);
//         if (xhr.status >= 200 && xhr.status < 300) {
//             try {
//                 console.log("xhr.responseText:", xhr.responseText);
//                 var response = JSON.parse(xhr.responseText);
//                 console.log("Parsed response:", response);
//                 if (response.success) {
//                     console.log("Candidates fetched successfully:", response.candidates);
//                     response.candidates.forEach(function(candidate) {
//                         console.log("Adding candidate:", candidate);
//                         addCandidateToGeneratedDiv(candidate);
//                     });
//                 } else {
//                     console.error("Error fetching candidates:", response.error);
//                 }
//             } catch (e) {
//                 console.error("Failed to parse JSON response:", e);
//             }
//         } else {
//             console.error("Request failed with status:", xhr.status);
//         }
//     };
//     xhr.onerror = function() {
//         console.error("XHR request failed");
//     };
//     xhr.send();
// }
// function addCandidateToGeneratedDiv(candidate) {
//     console.log("Adding candidate to generated div:", candidate);
//     const container = document.querySelector('.User_containerDivss');
//     if (!container) {
//         console.error("Container not found");
//         return;
//     }

//     const newCandidateCon = document.createElement('div');
//     newCandidateCon.classList.add('User_CandidatesCon', 'form-element');

//     const checkbox = document.createElement('input');
//     checkbox.classList.add('checkboxx');
//     checkbox.type = 'checkbox';
//     checkbox.name = 'platform';
//     checkbox.value = candidate.unique_id;
//     checkbox.id = candidate.unique_id;

//     const label = document.createElement('label');
//     label.htmlFor = candidate.unique_id;

//     const imageContainer = document.createElement('div');
//     imageContainer.classList.add('User_CandiImageContainer');

//     const img = document.createElement('img');
//     img.src = `Pictures/${candidate.img}`;
//     img.alt = candidate.candidate_name;
//     imageContainer.appendChild(img);

//     const titleDiv = document.createElement('div');
//     titleDiv.classList.add('title');

//     const span = document.createElement('span');
//     span.textContent = candidate.candidate_name;
//     titleDiv.appendChild(span);

//     label.appendChild(imageContainer);
//     label.appendChild(titleDiv);

//     newCandidateCon.appendChild(checkbox);
//     newCandidateCon.appendChild(label);

//     container.appendChild(newCandidateCon);
//     console.log("New candidate div added to container.");
// }