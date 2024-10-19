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

// FUNCTION SA MODAL KAPAG VOTED TSAKA UNDER VOTE   || NILAGAY KO NA TO SA LOOB NG showModal();
// const VotedModal = document.querySelector('.SuccessfulVoteUser');
// const VotedModalOk = document.querySelector('.OkieNa');

// const UnderVoteModal = document.querySelector('.SuccessfulUnderVote');
// const UnderVoteModalOk = document.querySelector('.OkieNaPo');

// VotedModalOk.onclick = function() {
//     VotedModal.style.display = 'none';
// }

// UnderVoteModalOk.onclick = function() {
//     UnderVoteModal.style.display = 'none';
// }



// Dito lahat nagsisimula js nung user voting
document.addEventListener('DOMContentLoaded', function() {
    console.log("Document loaded, initializing...");

    const maxCandidates = 9;
    let currentCount = 0;
    let selectedCandidates = [];

    // Track checkbox state
    const checkboxStates = {};

    // // Function to update the checkbox count
    function updateCheckboxCount() {
        const checkboxes = document.querySelectorAll('.checkboxx');
        const countInput = document.querySelector('.text');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const isChecked = this.checked;
                const candidateId = this.value;

                if (isChecked) {
                    if (currentCount < maxCandidates) {
                        currentCount++;
                        checkboxStates[candidateId] = true; // Track as checked
                    } else {
                        // Prevent checking if max count is reached
                        this.checked = false;
                        alert(`You can only select up to ${maxCandidates} candidates.`);
                    }
                } else {
                    if (checkboxStates[candidateId]) {
                        currentCount--;
                        checkboxStates[candidateId] = false; // Track as unchecked
                        removeCandidate(candidateId);
                    }
                }

                countInput.value = currentCount;
                console.log("Checkbox count updated:", currentCount);      
                
                updateButtonDisabled();
            });
        });
    }

    function updateButtonDisabled() {
        const generateButton = document.querySelector(".buttonSubmitBoto");
        const underVote = document.getElementById('underVote');

        // Hide button if vote count is 0, show otherwise
        if (generateButton && underVote) {
            // If current count is below maxCandidates, set underVote to 'UnderVote'
            if (currentCount < maxCandidates) {
                underVote.value = 'UnderVote';
            } else {
                underVote.value = 'Voted'; // Clear underVote if not under vote
            }
    
            // Enable or disable the button based on whether currentCount is 0
            generateButton.disabled = currentCount === 0 ? true : false;
        }
    }

    // Function to fetch candidates from the database
    function fetchCandidates() {

        var sessionUniqueId = document.getElementById('sessionUniqueId').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "PHPBackend/VotingProcess.php?action=fetchCandidates&sessionUniqueId=" + sessionUniqueId, true);
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
            xhr.open('GET', `PHPBackend/VotingProcess2.php?id=${candidateId}`, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log("Raw response:", xhr.responseText);
                    try {
                        var response = JSON.parse(xhr.responseText);
    
                        // Adjust to handle single candidate object instead of an array
                        if (response.success && response.candidate) {
                            var candidate = response.candidate;
    
                            // Ensure both IDs are compared as strings
                            if (String(candidate.unique_id) === String(candidateId)) {
                                resolve(candidate);
                            } else {
                                console.error('Candidate ID mismatch in the response');
                                reject('Candidate ID mismatch in the response');
                            }
                        } else {
                            console.error('Candidate data is missing or request failed');
                            reject('Candidate data is missing or request failed');
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        reject('Error parsing response');
                    }
                } else {
                    console.error('Failed to fetch candidate with status:', xhr.status);
                    reject('Failed to fetch candidate');
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
                reject('Request failed');
            };
            xhr.send();
        });
    }
    
    

    function handleCheckboxChange(checkbox) {
        const candidateId = parseInt(checkbox.value); // Assuming checkbox value is the unique_id
        const isChecked = checkbox.checked;
    
        if (isChecked) {
            // Code that adds the candidate when the checkbox is checked (this part seems to work fine)
            fetchCandidateData(candidateId).then(candidate => {
                selectedCandidates.push(candidate);
                updateSummary();
            });
        } else {
            // This part needs to call removeCandidate correctly when the checkbox is unchecked
            removeCandidate(candidateId);  // Fix: Ensure it's being called on uncheck
        }
    
        console.log(`Checkbox changed: ${candidateId}, Checked: ${isChecked}`);
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
    
        // Always clear all fields first
        for (let i = 1; i <= maxCandidates; i++) {
            const imgDiv = document.getElementById(`candi${i}_img`);
            const nameInput = document.getElementById(`candi${i}_name`);
            const idInput = document.getElementById(`candi${i}_ID`);
    
            if (imgDiv && nameInput && idInput) {
                imgDiv.innerHTML = '';  // Clear the image div
                nameInput.value = '';   // Clear the name input
                idInput.value = '';     // Clear the ID input
            }
        }
    
        // Now populate the selected candidates
        for (let i = 0; i < selectedCandidates.length; i++) {
            const imgDiv = document.getElementById(`candi${i+1}_img`);
            const nameInput = document.getElementById(`candi${i+1}_name`);
            const idInput = document.getElementById(`candi${i+1}_ID`);
    
            if (imgDiv && nameInput && idInput) {
                const candidate = selectedCandidates[i];
                console.log(`Rendering candidate ${i+1}: ${JSON.stringify(candidate)}`);
                imgDiv.innerHTML = `<img src="Pictures/${candidate.img}" alt="${candidate.candidate_name}">`;
                nameInput.value = candidate.candidate_name;
                idInput.value = candidate.unique_id;
            }
        }
    }    
    
    fetchCandidates();
});

// Pang insert ng boto ng user
document.getElementById('submitVoteButton').addEventListener('click', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    var VoteDate = document.getElementById('timestamp1').textContent;
    var underVote = document.getElementById('underVote').value;
    var user_ID = document.getElementById('user_ID').value;
    var candidate_IDs = [];
    for (var i = 1; i <= 9; i++) {
        var candidate_ID = document.getElementById('candi' + i + '_ID').value;
        if (candidate_ID) {
            candidate_IDs.push(candidate_ID);
        }
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/VotingProcess2.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        showModal(underVote);
                    } else {
                        console.log('Error: ' + response.error);
                    }
                } catch (e) {
                    console.error('Invalid JSON response:', xhr.responseText);
                }
            } else {
                console.error('Request failed. Status:', xhr.status);
            }
        }
    };
    var data = {
        voter_id: user_ID,
        candidate_ids: candidate_IDs,
        voteStatus: underVote,
        vote_date: VoteDate
    };
    console.log(data);
    xhr.send(JSON.stringify(data));
});

function showModal(underVote) {
    var modalSelector = underVote === 'UnderVote' ? '.SuccessfulUnderVote' : '.SuccessfulVoteUser';
    var modal = document.querySelector(modalSelector);
    var BtnOkieNaPo = modal.querySelector('.OkieNaPo');
    var BtnOkieNa = modal.querySelector('.OkieNa');
    
    if (modal) {
        modal.style.display = 'block';

        if (BtnOkieNa) {
            BtnOkieNa.onclick = function() {
                modal.style.display = 'none';
                location.reload();
            };
        }

        if (BtnOkieNaPo) {
            BtnOkieNaPo.onclick = function() {
                modal.style.display = 'none';
                location.reload();
            };
        }
        

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    }
}



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


// Function para pang check kung naka boto na tapos may overlay
function checkVotingHistory() {
    // Retrieve the unique ID from the hidden input field
    var sessionUniqueId = document.getElementById('sessionUniqueId').value;

    $.ajax({
        type: 'POST',
        url: 'PHPBackend/DeclareWinner.php', // Update this with the correct path
        data: { action: 'check_voting_history', unique_id: sessionUniqueId }, // Ensure sessionUniqueId is defined
        dataType: 'json',
        success: function(response) {
            console.log('Parsed response:', response);
            if (response.success) {
                // Handle successful response
                if (response.voted) {
                    console.log('User has already voted.');
                    var voteContainer = document.getElementById('FirstVotingContainer');

                    var overlay = document.createElement('div');
                    overlay.style.position = 'absolute';
                    overlay.style.width = '100%';
                    overlay.style.height = '100%';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                    overlay.innerHTML = `
                                        <div style="text-align: center; margin-top: 40%;">
                                            
                                            <p style="color: white; font-size: 25px;">You have already voted</p>
                                        </div>
                                    `;
                    //<img src="Pictures/Mabuhay_Logo.png" alt="Logo" style="max-width: 35%; margin-bottom: 30px;">

                    voteContainer.appendChild(overlay);
                } else {
                    console.log('User has not voted yet.');
                }
            } else {
                console.error('Error:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
    
};


// Function kung tapos na yung botohan e buong voting may overlay na
function fetchOverlayMessage() {
    $.ajax({
        type: 'POST',
        url: 'PHPBackend/DeclareWinner.php',
        data: { action: 'fetch_overlay_message' },
        dataType: 'json',
        success: function(response) {
            console.log("fetchOverlayMessage response:", response); // Log overlay message response
            if (response.success && response.status === 'VotingEnded') {
                document.getElementById('Overlay').style.display = 'flex';
                document.getElementById('FirstVotingContainer').style.display = 'none';
            } else {
                // If no overlay needed, proceed to check voting history
                checkVotingHistory();
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            // Proceed to check voting history in case of an error
            checkVotingHistory();
        }
    });
}

function formatDate(now) {
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Add leading zero
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0'); // 24-hour format
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function updateTimestamp() {
    const now = new Date();
    const formattedDate = formatDate(now);

    document.getElementById('timestamp1').textContent = formattedDate;
}

// Optionally update the timestamp every second
setInterval(updateTimestamp, 1000);


// Call the function when the page loads
window.onload = function () {
    updateTimestamp();
    fetchOverlayMessage();
};
