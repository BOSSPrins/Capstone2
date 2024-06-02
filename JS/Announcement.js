//FUNCTION NG SIDEBAR 
const menuImage = document.querySelector(".menu");
const sidebar = document.querySelector(".sidebarContainer");
const mainContainer = document.querySelector(".mainAnnouncementhContainerr");
 
// Function to show the sidebar by default
function showSidebar() {
    sidebar.classList.remove("sideActive");
    mainContainer.classList.remove("mainAnnouncementConActivee");
}
 
// Add event listener to the menu image to toggle sidebar visibility
menuImage.addEventListener("click", function() {
    sidebar.classList.toggle("sideActive");
    mainContainer.classList.toggle("mainAnnouncementConActivee");
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

//FUNCTION SA TEXTAREA POSTING 
const postingTextarea = document.querySelector(".announcementPostInput");
postingTextarea.addEventListener("input", function() {
    adjustTextareaHeight();
});

function adjustTextareaHeight() {
    // Reset the height to auto to calculate the content height
    postingTextarea.style.height = "auto";
    // Set the height to the scrollHeight of the content
    postingTextarea.style.height = postingTextarea.scrollHeight + "px";
}

let uploadingImages;
let fileInput;
//FUNCTION SA PAG UPLOAD NG IMAGES 
document.addEventListener('DOMContentLoaded', function () {
     fileInput = document.querySelector('.announceInput');
    const uploadInfoValue = document.querySelector('.uploadInfoValue');
    const creatingAnnouncementForm = document.querySelector('.creatingAnnouncementForm');
     uploadingImages = document.querySelector('.uploadingImages');
     
    creatingAnnouncementForm.addEventListener('click', function () {
        fileInput.click();
       
    });

    fileInput.addEventListener('change', function () {
        const files = Array.from(fileInput.files);
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const uploadedImage = document.createElement('div');
                uploadedImage.classList.add('uploadedImages');
                uploadedImage.innerHTML = `
                    <img src="${e.target.result}">
                    <div class="remove-btn"> &#88; </div>
                `;
                uploadingImages.appendChild(uploadedImage); // Append uploaded images directly inside .uploadingImages
                updateUploadInfo();
            };
            reader.readAsDataURL(file);
        });
    });

    uploadingImages.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-btn')) {
            e.target.parentElement.remove();
            updateUploadInfo();
        }
    });

    function updateUploadInfo() {
        const count = uploadingImages.querySelectorAll('.uploadedImages').length;
        uploadInfoValue.textContent = count;
    }
});


//FUNCTION SA PROFILE MODAL 
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

// FUNCTION NG MODAL NG DELETE 
const delModal = document.getElementById("deleteModal");

function openDeleteModal() {
    delModal.style.display = "block";
}

function closeModal() {
    delModal.style.display = "none";
}

//FUNCTION NG MODAL NG DETAILS
const detailsModal = document.getElementById("ModalParasaViewDetails");

function openEditModal() {
    detailsModal.style.display = "block";
}

function closeDetails() {
    detailsModal.style.display = "none";
}

//FUNCTION SA TEXTAREA MODAL
const DetailsTextarea = document.querySelector(".modalTextInputIto");
DetailsTextarea.addEventListener("input", function() {
    adjustTextareaHeight();
});

function adjustTextareaHeight() {
    DetailsTextarea.style.height = "auto";
    DetailsTextarea.style.height = DetailsTextarea.scrollHeight + "px";
}

//FUNCTION SA MODAL PAG UPLOAD NG IMAGES 
document.addEventListener('DOMContentLoaded', function () {
    const EditingPics = document.getElementById('EditingPics');
    const inputElement = EditingPics.querySelector('.editingInput');
    const uploadedImagesContainer = document.querySelector('.editingUploadedImages');

    EditingPics.addEventListener('click', function() {
        inputElement.click();
    });

    inputElement.addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const files = event.target.files;
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (event) {
                const imageUrl = event.target.result;
                const imageElement = createImageElement(imageUrl, file);
                uploadedImagesContainer.appendChild(imageElement);
            }
            reader.readAsDataURL(file);
        });
    }

    function createImageElement(imageUrl, file) {
        const uploadedImageDiv = document.createElement('div');
        uploadedImageDiv.classList.add('uploadedImagesModal');

        const image = document.createElement('img');
        image.src = imageUrl;
        image.classList.add('uploadedImage');
        uploadedImageDiv.appendChild(image);

        const removeButton = document.createElement('div');
        removeButton.classList.add('removeBtnModal');
        removeButton.textContent = 'X';
        removeButton.addEventListener('click', function () {
            uploadedImageDiv.remove();
        });
        uploadedImageDiv.appendChild(removeButton);

        return uploadedImageDiv;
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".anawns");
    const sabmitBoton = document.getElementById("sabmitBoton");
    const errorText = form.querySelector(".iror");
    // const successText = form.querySelector(".sakses");

    const modal = document.getElementById("successModal");
    const okButton = document.querySelector(".okButn.OkSaModal");

    // Function to open the success modal
    function openSuccessModal() {
        console.log("Opening success modal");
        modal.style.display = "block";
    }

    // Event listener for the "OK" button to refresh the page
    okButton.addEventListener("click", () => {
        modal.style.display = "none";
        location.reload(); // Refresh the page
    });

    // Prevent the form from submitting traditionally
    form.onsubmit = (e) => {
        e.preventDefault();
    };

    if (sabmitBoton) {
        sabmitBoton.onclick = () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "PHPBackend/Announce.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response.trim();  // Trim any extra spaces
                        console.log("Response from server:", data);

                        if (data === "success") {
                            console.log("Data is 'success'");
                            // successText.textContent = "Announcement posted successfully!";
                            // successText.style.display = "block";
                            form.reset();

                            // Clear the file inputs and uploaded images
                            if (fileInput) {
                                fileInput.value = '';
                                console.log("File input cleared");
                            }
                            if (uploadingImages) {
                                while (uploadingImages.firstChild) {
                                    uploadingImages.removeChild(uploadingImages.firstChild);
                                }
                                console.log("Uploaded images removed");
                            }
                            updateUploadInfo();

                            // Open the success modal
                            openSuccessModal();
                        } else {
                            errorText.textContent = data;
                            errorText.style.display = "block";
                            console.log("Error:", data);
                        }
                    }
                }
            };
            let formData = new FormData(form);
            xhr.send(formData);
        };
    }

     // Add event listener to edit buttons
     document.querySelectorAll('.iditBoton').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
        });
    });

    // Add event listener to delete buttons
    document.querySelectorAll('.dilitBoton').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
        });
    });

    function updateUploadInfo() {
        if (uploadingImages) {
            const count = uploadingImages.querySelectorAll('.uploadedImages').length;
            const uploadInfoValue = document.querySelector('.uploadInfoValue');
            if (uploadInfoValue) {
                uploadInfoValue.textContent = count;
            }
        }
    }
});


// AJAX NG MODAL   DISPLAY NG PIC PWEDE PA MULTIPLE, 
                // DI MAALIS YUNG KA SAME NAME NG PIC, 
                // DI MAKITA YUNG SUSUNOD NA IPOPOST NA PIC KAPAG PAISA ISA ANG LAGAY 
                
$(document).ready(function () {

    $(document).ready(function () {
        let fileNames = [];
        let initialFileNames = [];
    
        $('.SaModal').click(function (e) {
            e.preventDefault();
            console.log("SaModal clicked");
        
            var news_id = $(this).closest('tr').find('.news_id').text().trim();
            console.log("News ID:", news_id);
        
            $.ajax({
                method: "POST",
                url: "PHPBackend/Process.php",
                data: {
                    'click_SaModal': true,
                    'news_id': news_id,
                },
                success: function (response) {
                    console.log("AJAX Response:", response);
                    try {
                        var jsonData = JSON.parse(response);
                        console.log("Parsed JSON Data:", jsonData);
        
                        if (jsonData.error) {
                            console.error('Error in AJAX response:', jsonData.error);
                            return;
                        }
        
                        if (typeof jsonData === 'object' && jsonData !== null) {
                            $('#newsID').val(jsonData['news_id']);
                            $('#del_newsID').val(jsonData['news_id']);
                            $('#StrDate').val(jsonData['start_date']);
                            $('#StrTime').val(jsonData['start_time']);
                            $('#EnDate').val(jsonData['end_date']);
                            $('#EnTime').val(jsonData['end_time']);
                            $('#Title').val(jsonData['title']);
                            $('#Descrip').val(jsonData['context']);
        
                            // Clear previous images and hide container
                            $('#Images').empty();
                            fileNames = [];
                            initialFileNames = [];
        
                            if (jsonData['img'].length > 0) {
                                console.log("Images found:", jsonData['img']);
                                $.each(jsonData['img'], function (i, imgSrc) {
                                    imgSrc = imgSrc.trim();
                                    if (imgSrc) { // Check if imgSrc is not empty
                                        var imageUrl = 'Pictures/' + encodeURIComponent(imgSrc);
                                        console.log("Image URL:", imageUrl);
                                        
                                        var imageHtml = `
                                            <div class="uploadedImages">
                                                <img src="${imageUrl}">
                                                <div class="remove-btn" data-img-name="${imgSrc}"> &#88; </div>
                                            </div>
                                        `;
                                        $('#Images').append(imageHtml);
                                        fileNames.push(imgSrc);
                                        initialFileNames.push(imgSrc);
                                    }
                                });
                            } else {
                                console.log("No images found, hiding container");
                                $('#Images').hide();
                            }
                            
        
                            $('#selectedFileNames').html(fileNames.map(name => `<div>${name}</div>`).join(''));
                        } else {
                            console.error('Parsed JSON Data is not an object:', jsonData);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                    }
                },
            });
        });
        
        const imagesContainer = $('#Images');
    
        imagesContainer.on('click', '.remove-btn', function () {
            console.log('Remove button clicked');
            const imageName = $(this).data('img-name').trim();
            console.log('Image name:', imageName);
            const index = fileNames.indexOf(imageName);
            console.log('Index:', index);
    
            if (index !== -1) {
                fileNames.splice(index, 1);
                $('#selectedFileNames').html(fileNames.map(name => `<div>${name}</div>`).join(''));
                console.log('Updated fileNames:', fileNames);
            }
    
            $(this).parent('.uploadedImages').remove();
        });
    
        $('.newEditingInput').change(function (e) {
            const files = this.files;
            const uploadedImagesContainer = $('.editingUploadedImages');
        
            // Clear existing images
            uploadedImagesContainer.empty();
        
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const imageUrl = event.target.result;
                    const imageElement = createImageElement(imageUrl);
                    // Check if image is already appended
                    if (!isImageAppended(uploadedImagesContainer, imageUrl)) {
                        uploadedImagesContainer.append(imageElement);
                    }
                };
                reader.readAsDataURL(file);
            });
        });
        
        function createImageElement(imageUrl) {
            const uploadedImageDiv = document.createElement('div');
            uploadedImageDiv.classList.add('uploadedImagesModal');
        
            const image = document.createElement('img');
            image.src = imageUrl;
            image.classList.add('uploadedImage');
            uploadedImageDiv.appendChild(image);
        
            return uploadedImageDiv;
        }
        
        function isImageAppended(container, imageUrl) {
            const images = container.find('.uploadedImage');
            for (let i = 0; i < images.length; i++) {
                if (images[i].src === imageUrl) {
                    return true;
                }
            }
            return false;
        }
        
        $('#Apdeyt').click(function (e) {
            e.preventDefault();
        
            var formData = new FormData();
            formData.append('update_SaModal', true);
            formData.append('news_id', $('#newsID').val());
            formData.append('start_date', $('#StrDate').val());
            formData.append('start_time', $('#StrTime').val());
            formData.append('end_date', $('#EnDate').val());
            formData.append('end_time', $('#EnTime').val());
            formData.append('title', $('#Title').val());
            formData.append('context', $('#Descrip').val());
        
            // Append the images
            var images = $('#PicNames')[0].files;
            for (var i = 0; i < images.length; i++) {
                formData.append('images[]', images[i]);
            }
        
            // Append the existing images from fileNames array
            formData.append('initial_images', JSON.stringify(initialFileNames));
            formData.append('remaining_images', JSON.stringify(fileNames));
        
            // Send AJAX request
            $.ajax({
                url: 'PHPBackend/Process.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log('Update AJAX Response:', response);
                    try {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success) {
                            alert('Data updated successfully');
                            $('#ModalParasaViewDetails').hide();
                            window.location.reload();
                        } else if (jsonData.error) {
                            console.error('Error in update response:', jsonData.error);
                            alert('Failed to update data: ' + jsonData.error);
                        } else {
                            console.error('Unexpected response:', response);
                            alert('Unexpected response received');
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        alert('Error parsing JSON: ' + error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Update AJAX error:', error);
                    alert('Update AJAX error: ' + error);
                }
            });
        
        });
    });
    

    // Button ng delete sa table
    $(document).on("click", ".delBOTON", function(){
        var news_id = $(this).closest('tr').find('.news_id').text();
        $('.delete_newsID').val(news_id);         
    });
    
    window.closeModal = function() {
        $('#deleteModal').hide();
    };

    // Yung delete na mismo sa modal ng delete
    $('.DelSaModal').click(function (e) { 
        e.preventDefault();
        var delete_newsID = $('.delete_newsID').val();
        
        $.ajax({
            type: "POST",
            url: "PHPBackend/DeleteProcess.php",
            data: {
                'Confirm_DEL': true,
                'delete_newsID': delete_newsID,
            },
            success: function (response) {
                try {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success) {
                        console.log('Record deleted successfully');

                        $("tr:has(td.news_id:contains('" + delete_newsID + "'))").remove(); 
                        closeModal();
                        location.reload();
                    } else {
                        console.error('Failed to delete record:', jsonData.error);
                    }
                } catch (error) {
                    console.error('Error parsing delete response:', error);
                }
                
            },
            error: function(xhr, status, error) {
                console.error('Delete AJAX error:', error);
            }
        });
    });

});