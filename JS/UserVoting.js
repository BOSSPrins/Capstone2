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



let selectedValues = [];
let previousSelections = {}; // Object to store previous selections for each dropdown

// Function to hide selected options in all dropdowns
function hideSelectedOptions() {
    console.log("Hiding selected options. Current selected values:", selectedValues);
    const allDropdowns = document.querySelectorAll('.OptionDropDown, .OptionDropDown2, .OptionDropDown3, .OptionDropDown4, .OptionDropDown5, .OptionDropDown6, .OptionDropDown7, .OptionDropDown8, .OptionDropDown9');
    
    allDropdowns.forEach(dropdown => {
        const options = dropdown.querySelectorAll('label');
        options.forEach(option => {
            const inputElement = option.querySelector('input');
            const value = inputElement.value;

            if (selectedValues.includes(value)) {
                console.log(`Hiding option: ${value}`);
                option.style.display = 'none';
            } else {
                console.log(`Showing option: ${value}`);
                option.style.display = 'block';
            }
        });
    });
}

// Function to handle option selection and update input
function selectOption(dropdownClass, inputId, emeDropPosClass) {
    const dropdown = document.querySelector(dropdownClass);
    const options = dropdown.querySelectorAll('label input');
    const inputField = document.getElementById(inputId);

    if (!inputField) {
        console.error(`No input field found with ID: ${inputId}`);
        return;  // Exit the function if inputField is null
    }

    options.forEach(option => {
        option.addEventListener('change', function() {
            const selectedValue = this.value;
            console.log(`Selected value: ${selectedValue} in dropdown ${dropdownClass}`);

            // Check if there's a previous selection
            const previousValue = previousSelections[dropdownClass] || null;
            console.log(`Previous selection for ${dropdownClass}:`, previousValue);

            if (previousValue) {
                // Remove the previous value from selectedValues before making it visible
                selectedValues = selectedValues.filter(value => value !== previousValue);
                console.log(`Removed ${previousValue} from selectedValues:`, selectedValues);

                // Make the previously selected option visible again
                const previousOption = Array.from(options).find(opt => opt.value === previousValue);
                if (previousOption) {
                    console.log(`Making previous option visible again: ${previousValue}`);
                    previousOption.closest('label').style.display = 'block'; // Show previous option
                }
            }

            // Set the selected value to the input field
            inputField.value = selectedValue;
            console.log(`Set input field ${inputId} value to: ${selectedValue}`);

            // Add selected value to array if not already selected
            if (!selectedValues.includes(selectedValue)) {
                selectedValues.push(selectedValue);
            }
            console.log("Updated selected values:", selectedValues);

            // Store the current selection as the previous one
            previousSelections[dropdownClass] = selectedValue;
            console.log(`Stored ${selectedValue} as previous selection for ${dropdownClass}`);

            // Hide selected options in other dropdowns
            hideSelectedOptions();

            // Close dropdown and rotate the arrow
            dropdown.classList.remove('open');
            dropdown.classList.remove('open2');
            dropdown.classList.remove('open3');
            dropdown.classList.remove('open4');
            dropdown.classList.remove('open5');
            dropdown.classList.remove('open6');
            dropdown.classList.remove('open7');
            dropdown.classList.remove('open8');
            dropdown.classList.remove('open9');
    
            const emeDropPos = document.querySelector(emeDropPosClass);
            emeDropPos.classList.remove('rotateOption');
        });
    });
}

// Apply the function to each dropdown
selectOption('.OptionDropDown', 'DisplayPos1', '.emeDropPos');
selectOption('.OptionDropDown2', 'DisplayPos2', '.emeDropPos2');
selectOption('.OptionDropDown3', 'DisplayPos3', '.emeDropPos3');
selectOption('.OptionDropDown4', 'DisplayPos4', '.emeDropPos4');
selectOption('.OptionDropDown5', 'DisplayPos5', '.emeDropPos5');
selectOption('.OptionDropDown6', 'DisplayPos6', '.emeDropPos6');
selectOption('.OptionDropDown7', 'DisplayPos7', '.emeDropPos7');
selectOption('.OptionDropDown8', 'DisplayPos8', '.emeDropPos8');
selectOption('.OptionDropDown9', 'DisplayPos9', '.emeDropPos9');


//PANGALAWANG MGA DIVS NA PAG EEDITAN //
// 1ST
function toggleDropOpsPos() {
    const PositionDropDown = document.querySelector(".OptionDropDown");
    PositionDropDown.classList.toggle("open");

    // Rotate the emeSet element
    const emeDropPos = document.querySelector('.emeDropPos');
    emeDropPos.classList.toggle('rotateOption');
}

// 2ND
function toggleDropOpsPos2() {
    const PositionDropDown2 = document.querySelector(".OptionDropDown2");
    PositionDropDown2.classList.toggle("open2");

    // Rotate the emeSet element
    const emeDropPos2 = document.querySelector('.emeDropPos2');
    emeDropPos2.classList.toggle('rotateOption');
}

// 3RD
function toggleDropOpsPos3() {
    const PositionDropDown3 = document.querySelector(".OptionDropDown3");
    PositionDropDown3.classList.toggle("open3");

    // Rotate the emeSet element
    const emeDropPos3 = document.querySelector('.emeDropPos3');
    emeDropPos3.classList.toggle('rotateOption');
}

// 4TH
function toggleDropOpsPos4() {
    const PositionDropDown4 = document.querySelector(".OptionDropDown4");
    PositionDropDown4.classList.toggle("open4");

    // Rotate the emeSet element
    const emeDropPos4 = document.querySelector('.emeDropPos4');
    emeDropPos4.classList.toggle('rotateOption');
}

// 5TH
function toggleDropOpsPos5() {
    const PositionDropDown5 = document.querySelector(".OptionDropDown5");
    PositionDropDown5.classList.toggle("open5");

    // Rotate the emeSet element
    const emeDropPos5 = document.querySelector('.emeDropPos5');
    emeDropPos5.classList.toggle('rotateOption');
}

// 6TH
function toggleDropOpsPos6() {
    const PositionDropDown6 = document.querySelector(".OptionDropDown6");
    PositionDropDown6.classList.toggle("open6");

    // Rotate the emeSet element
    const emeDropPos6 = document.querySelector('.emeDropPos6');
    emeDropPos6.classList.toggle('rotateOption');
}

// 7TH
function toggleDropOpsPos7() {
    const PositionDropDown7 = document.querySelector(".OptionDropDown7");
    PositionDropDown7.classList.toggle("open7");

    // Rotate the emeSet element
    const emeDropPos7 = document.querySelector('.emeDropPos7');
    emeDropPos7.classList.toggle('rotateOption');
}

// 8TH
function toggleDropOpsPos8() {
    const PositionDropDown8 = document.querySelector(".OptionDropDown8");
    PositionDropDown8.classList.toggle("open8");

    // Rotate the emeSet element
    const emeDropPos8 = document.querySelector('.emeDropPos8');
    emeDropPos8.classList.toggle('rotateOption');
}

// 9TH
function toggleDropOpsPos9() {
    const PositionDropDown9 = document.querySelector(".OptionDropDown9");
    PositionDropDown9.classList.toggle("open9");

    // Rotate the emeSet element
    const emeDropPos9 = document.querySelector('.emeDropPos9');
    emeDropPos9.classList.toggle('rotateOption');
}

function checkInputsAndToggleButton() {

    const inputNames = [
        'DisplayPos1', 'DisplayPos2', 'DisplayPos3', 'DisplayPos4',
        'DisplayPos5', 'DisplayPos6', 'DisplayPos7', 'DisplayPos8', 'DisplayPos9'
    ];
    
    const allFilled  = inputNames.every(name => {
        const input = document.querySelector(`input[name="${name}"]`);
        return input && input.value.trim() !== '';
    });
    
    const btn = document.querySelector('.buttonSubmitBoto2');                                  

    if (btn) {
        if (allFilled) {
            btn.disabled = false; // Enable the button      
        } else {
            btn.disabled = true;  // Disable the button
        }
    }
}

// Function pangdisplay kung sino pinili gamit data-display
function handleRadioChange(radio, displayPosId) {
    const displayValue = radio.getAttribute('data-display');
    document.getElementById(displayPosId).value = displayValue;
}

// Function panglagay ng value sa hidden input para sa insert sa detabes
function candiPositionValue(radio, candiPos) {
    const inputValue = radio.value;
    document.getElementById(candiPos).value = inputValue;
}

// Adding event listeners to all radio buttons
document.querySelectorAll('.OptionDropDown input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos1');
        candiPositionValue(this, 'CandiPos1');
        checkInputsAndToggleButton();    
    });
});

document.querySelectorAll('.OptionDropDown2 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos2');
        candiPositionValue(this, 'CandiPos2');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown3 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos3');
        candiPositionValue(this, 'CandiPos3');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown4 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos4');
        candiPositionValue(this, 'CandiPos4');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown5 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos5');
        candiPositionValue(this, 'CandiPos5');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown6 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos6');
        candiPositionValue(this, 'CandiPos6');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown7 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos7');
        candiPositionValue(this, 'CandiPos7');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown8 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos8');
        candiPositionValue(this, 'CandiPos8');
        checkInputsAndToggleButton();
    });
});

document.querySelectorAll('.OptionDropDown9 input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        handleRadioChange(this, 'DisplayPos9');
        candiPositionValue(this, 'CandiPos9');
        checkInputsAndToggleButton();
    });
});

function loadWinners() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "PHPBackend/VotingXML.php", true);
    xhr.onload = function () {
        if (this.status == 200) {
            const xmlDoc = this.responseXML;
            if (!xmlDoc) {
                console.error("No valid XML received.");
                return;
            }

            const winners = xmlDoc.getElementsByTagName("winner");
            if (!winners || winners.length === 0) {
                console.error("No winners found in XML.");
                return;
            }

            for (let i = 0; i < winners.length; i++) {
                const candidateName = winners[i].getElementsByTagName("candidate_name")[0].childNodes[0].nodeValue;
                const img = winners[i].getElementsByTagName("img")[0].childNodes[0].nodeValue;

                const nameElement = document.getElementById(`CandiName${i + 1}`);
                const imgElement = document.getElementById(`CandiImage${i + 1}`);

                var unique_id = winners[i].getElementsByTagName('unique_id')[0].textContent;
                var uidInput = document.getElementById(`UID${i + 1}`);
                if (uidInput) {
                    uidInput.value = unique_id;
                }

                // Check if elements exist before setting their values
                if (nameElement) {
                    nameElement.value = candidateName;
                } else {
                    console.error(`Element with ID 'CandiName${i + 1}' not found.`);
                }

                if (imgElement) {
                    imgElement.innerHTML = `<img src='Pictures/${img}' alt='${candidateName}' />`;
                } else {
                    console.error(`Element with ID 'CandiImage${i + 1}' not found.`);
                }
            }
        }
    };
    xhr.send();
}

function getInputValues() {
    const mainContainer = document.querySelector('.MainContainerAll');
    console.log('Main Container:', mainContainer);

    const candidates = mainContainer.querySelectorAll('.CandidatesConPangalawa');
    console.log('Candidates:', candidates); // Log the candidates
    
    const values = [];

    candidates.forEach((candidate, candidateIndex) => {
        // Get all elements with names starting with 'CandiPos', 'UID', 'CandiImage', and 'CandiName'
        const candiPosElement = candidate.querySelector('[name^="CandiPos"]');
        const uidElement = candidate.querySelector('[name^="UID"]');
        const imageContainer  = candidate.querySelector('[name^="CandiImage"]'); // Ensure this matches your actual HTML
        const nameElement = candidate.querySelector('[name^="CandiName"]');   // Ensure this matches your actual HTML

        console.log(`Candidate ${candidateIndex + 1}:`, candidate); // Log each candidate container

        const position = candiPosElement ? candiPosElement.value : 'Not found';
        const uid = uidElement ? uidElement.value : 'Not found';
        const image = imageContainer ? imageContainer.querySelector('img')?.src : 'Not found'; // Extract image src
        const name = nameElement ? nameElement.value : 'Not found';

        console.log('Position:', position);
        console.log('UID:', uid);
        console.log('Image:', image);
        console.log('Name:', name);
        
        if (position !== 'Not found' && uid !== 'Not found') {
            values.push({
                position: position,
                uniqueId: uid,
                image: image,
                name: name
            });
        }
    });

    console.log('Final values:', values); // Log values for debugging
    return values;
}
// Function to populate the summary modal
function populateSummaryModal() {
    const values = getInputValues(); // Retrieve values to populate the modal

    values.forEach((candidate) => {
        const { position, uniqueId, image, name } = candidate;
        console.log(`Populating modal for position: ${position} with UID: ${uniqueId}, Image: ${image}, Name: ${name}`);

        // Populate UID, Image, and Name based on position
        switch (position) {
            case "President":
                console.log('Assigning President values');
                document.getElementById('PresUID').value = uniqueId;
                
                const presImage = document.getElementById('PresImg');
                if (presImage) {
                    // Clear previous content
                    presImage.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    presImage.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }


                const presName = document.getElementById('PresName');
                if (presName) {
                    presName.value = name; // Set the name text
                    console.log('Name element found and updated', presName.value);
                } else {
                    console.log('Name element for President not found');
                }
                break;
            case "VicePresident":
                console.log('Assigning VicePresident values');
                document.getElementById('VpresUID').value = uniqueId;

                const VpresImage = document.getElementById('VpresImg');
                if (VpresImage) {
                    // Clear previous content
                    VpresImage.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    VpresImage.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }

                const VpresName = document.getElementById('VpresName');
                if (VpresName) {
                    VpresName.value = name; // Set the name text
                    console.log('Name element found and updated', VpresName.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Secretary":
                console.log('Assigning Secretary values');
                document.getElementById('SecUID').value = uniqueId;

                const SecImage = document.getElementById('SecImg');
                if (SecImage) {
                    // Clear previous content
                    SecImage.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    SecImage.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const SecName = document.getElementById('SecName');
                if (SecName) {
                    SecName.value = name; // Set the name text
                    console.log('Name element found and updated', SecName.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Treasurer":
                console.log('Assigning Treasurer values');
                document.getElementById('TreaUID').value = uniqueId;

                const TreaImg = document.getElementById('TreaImg');
                if (TreaImg) {
                    // Clear previous content
                    TreaImg.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    TreaImg.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const TreaName = document.getElementById('TreaName');
                if (TreaName) {
                    TreaName.value = name; // Set the name text
                    console.log('Name element found and updated', TreaName.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Auditor":
                console.log('Assigning Auditor values');
                document.getElementById('AudUID').value = uniqueId;

                const AudImg = document.getElementById('AudImg');
                if (AudImg) {
                    // Clear previous content
                    AudImg.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    AudImg.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const AudName = document.getElementById('AudName');
                if (AudName) {
                    AudName.value = name; // Set the name text
                    console.log('Name element found and updated', AudName.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "PeaceInOrder":
                console.log('Assigning PeaceInOrder values');
                document.getElementById('PioUID').value = uniqueId;

                const PioImg = document.getElementById('PioImg');
                if (PioImg) {
                    // Clear previous content
                    PioImg.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    PioImg.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }

                const PioName = document.getElementById('PioName');
                if (PioName) {
                    PioName.value = name; // Set the name text
                    console.log('Name element found and updated', PioName.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Director1":
                console.log('Assigning Director1 values');
                document.getElementById('Dir1UID').value = uniqueId;

                const Dir1Img = document.getElementById('Dir1Img');
                if (Dir1Img) {
                    // Clear previous content
                    Dir1Img.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    Dir1Img.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const Dir1Name = document.getElementById('Dir1Name');
                if (Dir1Name) {
                    Dir1Name.value = name; // Set the name text
                    console.log('Name element found and updated', Dir1Name.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Director2":
                console.log('Assigning Director2 values');
                document.getElementById('Dir2UID').value = uniqueId;

                const Dir2Img = document.getElementById('Dir2Img');
                if (Dir2Img) {
                    // Clear previous content
                    Dir2Img.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    Dir2Img.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const Dir2Name = document.getElementById('Dir2Name');
                if (Dir2Name) {
                    Dir2Name.value = name; // Set the name text
                    console.log('Name element found and updated', Dir2Name.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            case "Director3":
                console.log('Assigning Director3 values');
                document.getElementById('Dir3UID').value = uniqueId;

                const Dir3Img = document.getElementById('Dir3Img');
                if (Dir3Img) {
                    // Clear previous content
                    Dir3Img.innerHTML = '';
                    
                    // Create and add the new image element
                    const imgElement = document.createElement('img');
                    imgElement.src = image; // Set the image src
                    imgElement.alt = name; // Optional: Set alt text
                    imgElement.style.width = '100%'; // Adjust as needed
                    imgElement.style.height = 'auto'; // Adjust as needed
                    
                    Dir3Img.appendChild(imgElement); // Add the image to the div
                    console.log('Image element found and updated', imgElement.src);
                } else {
                    console.log('Image element for President not found');
                }
                
                const Dir3Name = document.getElementById('Dir3Name');
                if (Dir3Name) {
                    Dir3Name.value = name; // Set the name text
                    console.log('Name element found and updated', Dir3Name.value);
                } else {
                    console.log('Name element for President not found');
                };

                break;
            default:
                console.log(`No matching position for: ${position}`);
                break;
        }
    });
}


// FUNCTION PARA SA SUMMARY MODAL 2
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('summaryModalTwo');
    const btn = document.querySelector('.buttonSubmitBoto2');
    const span = document.querySelector('.closeSummaryTwo');

    // Show the modal
    btn.onclick = function() {
        const values = getInputValues();
        console.log('Values from getInputValues:', values); // Log values passed to the modal

        populateSummaryModal(values); // Populate the modal before showing it

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


let isWinner = false;

// Function to check if the user is a winner
function checkWinnerStatus(callback) {
    // var uniqueId = document.getElementById('WinnerUniqueId').value;

    $.ajax({
        type: 'POST',
        url: 'PHPBackend/DeclareWinner.php', // Path to your PHP file
        data: {
            action: 'check_winner' // Add an action parameter
            // unique_id: uniqueId
        },
        dataType: 'json',
        cache: false,
        success: function(response) {
            console.log("checkWinnerStatus response:", response); // Log response to see the server's reply
            if (response.success && response.display) {
                // If the user is a winner, show the SecondVotingContainer
                document.getElementById('SecondVotingContainer').style.display = 'block';
                document.getElementById('FirstVotingContainer').style.display = 'none';
                isWinner = true;
                callback(true); // Proceed as a winner
            } else {
                console.log('Not a winner or error in status.');
                callback(false); // Not a winner, continue normal flow
                // Hide the SecondVotingContainer if not a winner
                document.getElementById('SecondVotingContainer').style.display = 'none';
            }

            // Debugging: Log the display state of both containers
            console.log("FirstVotingContainer display after checkWinnerStatus:", document.getElementById('FirstVotingContainer').style.display);
            console.log("SecondVotingContainer display after checkWinnerStatus:", document.getElementById('SecondVotingContainer').style.display);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            callback(false); // Treat error as not a winner
        }
    });
}


// Function kung tapos na yung botohan e buong voting may overlay na
function fetchOverlayMessage(callback) {
    $.ajax({
        type: 'POST',
        url: 'PHPBackend/DeclareWinner.php',
        data: { action: 'fetch_overlay_message' },
        dataType: 'json',
        success: function(response) {
            console.log("fetchOverlayMessage response:", response); // Log overlay message response
            if (response.success) {
                if (response.status === 'VotingEnded' && !isWinner) {
                    document.getElementById('Overlay').style.display = 'flex';
                    document.getElementById('FirstVotingContainer').style.display = 'none';
                    document.getElementById('SecondVotingContainer').style.display = 'none';
                } else {
                    callback(); // Proceed with normal voting flow
                }
            } else {
                console.error('Error:', response.error);
                callback(); // Proceed if error occurred
            }

            // Debugging: Log the display state of both containers
            console.log("FirstVotingContainer display after fetchOverlayMessage:", document.getElementById('FirstVotingContainer').style.display);
            console.log("SecondVotingContainer display after fetchOverlayMessage:", document.getElementById('SecondVotingContainer').style.display);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            callback(); // Proceed in case of an AJAX error
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
    document.getElementById('timestamp2').textContent = formattedDate;
}

// Optionally update the timestamp every second
setInterval(updateTimestamp, 1000);


// Pangcheck kung nakaboto na for new candidates positions
function checkVotingPositions() {
    // Retrieve the unique ID from the hidden input field
    var newCandiPositions = document.getElementById('newCandiPositions').value;

    $.ajax({
        type: 'POST',
        url: 'PHPBackend/DeclareWinner.php', // Update this with the correct path
        data: { action: 'check_voting_positions', unique_id: newCandiPositions }, // Ensure sessionUniqueId is defined
        dataType: 'json',
        success: function(response) {
            console.log('Parsed response:', response);
            if (response.success) {
                // Handle successful response
                if (response.voted) {
                    console.log('User has already voted for new positions.');
                    var voteContainer = document.getElementById('SecondVotingContainer');

                    var overlay = document.createElement('div');
                    overlay.style.position = 'absolute';
                    overlay.style.width = '100%';
                    overlay.style.height = '100%';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                    overlay.innerHTML = `
                                        <div style="text-align: center; margin-top: 20%;">
                                            
                                            <p style="color: white; font-size: 25px;">Wait for the other directors to vote</p>
                                        </div>
                                    `;
                    //<img src="Pictures/Mabuhay_Logo.png" alt="Logo" style="max-width: 35%; margin-bottom: 30px;">

                    voteContainer.appendChild(overlay);
                } else {
                    console.log('User has not voted yet for new positions.');
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

// function para kahit tapos na yung botohan e makakaboto parin ng pagset ng position   
function handleVotingStatus() {
    fetchOverlayMessage(function(isOngoing) {
        if (isOngoing) {
            // Only check for the winner if voting is ongoing and no winner has been set
            if (!isWinner) {
                checkWinnerStatus();
            } else {
                console.log('Winner already confirmed not checking for winners again.');
            }
        } else {
            console.log('Voting has ended; not checking for winners.');
        }

        // Debugging: Log the display state of both containers
        console.log("FirstVotingContainer display after handleVotingStatus:", document.getElementById('FirstVotingContainer').style.display);
        console.log("SecondVotingContainer display after handleVotingStatus:", document.getElementById('SecondVotingContainer').style.display);
    });
}



// Call the function when the page loads
window.onload = function () {
    loadWinners();
    checkVotingPositions();
    updateTimestamp();
    
    // First, check if the user is already a winner
    checkWinnerStatus(function(isWinnerStatusChecked) {
        if (isWinnerStatusChecked) {
            console.log('Winner status confirmed; skipping further voting checks.');
        } else {
            // If not a winner, proceed with the voting status check
            fetchOverlayMessage(function() {
                // If no overlay, check the user's voting history
                checkVotingHistory();
            });
        }

        // Debugging: Log the display state of both containers
        console.log("FirstVotingContainer display after checkWinnerStatus in onload:", document.getElementById('FirstVotingContainer').style.display);
        console.log("SecondVotingContainer display after checkWinnerStatus in onload:", document.getElementById('SecondVotingContainer').style.display);
    });

    handleVotingStatus();
};


// Function sa pagboto ng positions ng mga nanalo
document.getElementById('submitPositionBTN').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent form from submitting the traditional way

    // Gather the position values
    let winnerUID = document.getElementById('WinnerUID').value;

    let presidentPosition = document.getElementById('PresValue').value;
    let presidentName = document.getElementById('PresName').value;
    let presidentUID = document.getElementById('PresUID').value;

    let vicePresidentPosition = document.getElementById('VpresValue').value;
    let vicePresidentName = document.getElementById('VpresName').value;
    let vicePresidentUID = document.getElementById('VpresUID').value;

    let secretaryPosition = document.getElementById('SecValue').value;
    let secretaryName = document.getElementById('SecName').value;
    let secretaryUID = document.getElementById('SecUID').value;

    let treasurerPosition = document.getElementById('TreaValue').value;
    let treasurerName = document.getElementById('TreaName').value;
    let treasurerUID = document.getElementById('TreaUID').value;

    let auditorPosition = document.getElementById('AudValue').value;
    let auditorName = document.getElementById('AudName').value;
    let auditorUID = document.getElementById('AudUID').value;

    let peaceInOrderPosition = document.getElementById('PioValue').value;
    let peaceInOrderName = document.getElementById('PioName').value;
    let peaceInOrderUID = document.getElementById('PioUID').value;

    let director1Position = document.getElementById('Dir1Value').value;
    let director1Name = document.getElementById('Dir1Name').value;
    let director1UID = document.getElementById('Dir1UID').value;

    let director2Position = document.getElementById('Dir2Value').value;
    let director2Name = document.getElementById('Dir2Name').value;
    let director2UID = document.getElementById('Dir2UID').value;

    let director3Position = document.getElementById('Dir3Value').value;
    let director3Name = document.getElementById('Dir3Name').value;
    let director3UID = document.getElementById('Dir3UID').value;

    let setPositionDate = document.getElementById('timestamp2').textContent;

    // Create an XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/DeclareWinner.php', true); // Change 'path_to_your_php_file.php' to your actual PHP file path
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define what happens on successful data submission
    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            if (response.success) {
                alert("Positions successfully inserted.");
                location.reload();
            } else {
                alert("Error: " + response.error);
            }
        }
    };

    // Prepare the data for sending
    let params = 
        'action=insert_positions' +
        '&winnerUID=' + encodeURIComponent(winnerUID) + 

        '&presidentPosition=' + encodeURIComponent(presidentPosition) + 
        '&presidentName=' + encodeURIComponent(presidentName) + 
        '&presidentUID=' + encodeURIComponent(presidentUID) + 

        '&vicePresidentPosition=' + encodeURIComponent(vicePresidentPosition) + 
        '&vicePresidentName=' + encodeURIComponent(vicePresidentName) + 
        '&vicePresidentUID=' + encodeURIComponent(vicePresidentUID) + 

        '&secretaryPosition=' + encodeURIComponent(secretaryPosition) + 
        '&secretaryName=' + encodeURIComponent(secretaryName) + 
        '&secretaryUID=' + encodeURIComponent(secretaryUID) + 

        '&treasurerPosition=' + encodeURIComponent(treasurerPosition) + 
        '&treasurerName=' + encodeURIComponent(treasurerName) + 
        '&treasurerUID=' + encodeURIComponent(treasurerUID) + 

        '&auditorPosition=' + encodeURIComponent(auditorPosition) + 
        '&auditorName=' + encodeURIComponent(auditorName) + 
        '&auditorUID=' + encodeURIComponent(auditorUID) + 

        '&peaceInOrderPosition=' + encodeURIComponent(peaceInOrderPosition) +
        '&peaceInOrderName=' + encodeURIComponent(peaceInOrderName) +
        '&peaceInOrderUID=' + encodeURIComponent(peaceInOrderUID) +

        '&director1Position=' + encodeURIComponent(director1Position) + 
        '&director1Name=' + encodeURIComponent(director1Name) +
        '&director1UID=' + encodeURIComponent(director1UID) +

        '&director2Position=' + encodeURIComponent(director2Position) + 
        '&director2Name=' + encodeURIComponent(director2Name) + 
        '&director2UID=' + encodeURIComponent(director2UID) + 

        '&director3Position=' + encodeURIComponent(director3Position) +
        '&director3Name=' + encodeURIComponent(director3Name) +
        '&director3UID=' + encodeURIComponent(director3UID) +

        '&setPositionDate=' + encodeURIComponent(setPositionDate);

    // Send the request with the parameters
    xhr.send(params);
});


// Function ng paglagay ng position sa table ng add candidate
function tallyVotes() {
    // Create an XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/DeclareWinner.php', true); // Adjust the path to your PHP file
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define what happens on successful data submission
    xhr.onload = function() {
        try {
            const response = JSON.parse(this.responseText);
            if (response.success) {
                displayVoteTallyInConsole(response.votes);
            } else {
                console.error("Error: " + response.error);
            }
        } catch (error) {
            console.error("Invalid JSON response:", this.responseText);
        }
    };

    // Send the request to tally votes
    xhr.send('action=tally_votes');
}

function displayVoteTallyInConsole(voteData) {
    console.log('Vote Tally by Position:');
    for (let position in voteData) {
        if (voteData.hasOwnProperty(position)) {
            console.log(`Position: ${position}`);
            console.log(`Winner: ${voteData[position].candidate_name}`);
            console.log(`UID: ${voteData[position].candidate_uid}`);
            console.log(`Votes: ${voteData[position].votes}`);
            console.log('--------------------------------');
        }
    }
}

// Set the interval when the page loads
var checkNewWinnersInterval = setInterval(checkForNewWinners, 1000);

function checkForNewWinners() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHPBackend/DeclareWinner.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                
                console.log("Response received:", response);  // Debug log

                if (response.success) {
                    // Convert response.count to a number and check if it equals 0
                    var count = Number(response.count);  // Ensure count is a number
                    if (count === 0) {
                        console.log(response.message);
                        clearInterval(checkNewWinnersInterval);  // Clear the interval
                        console.log("Interval cleared");  // Log to confirm
                        tallyVotes();
                    } else {
                        console.log(response.message + ": " + count);  // Log the count
                    }
                } else {
                    console.error("Error: " + response.error);
                }
            } catch (e) {
                console.error("Failed to parse response: " + e);
            }
        }
    };

    // Send the request with action 'check_new_winners'
    xhr.send('action=check_new_winners');
}





