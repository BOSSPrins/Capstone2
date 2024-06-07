//FUNCTION SA NAVBAT PAYMENTS AND HISTORY 
const toggleContent = (contentId) => {
  // Hide all content sections
  const contents = document.querySelectorAll(".EachContentsMonth");
  contents.forEach((content) => {
    content.style.display = "none";
  });
  
  // Display the selected content
  const selectedContent = document.getElementById(contentId);
  if (selectedContent) {
    selectedContent.style.display = "block";
  }
}

//FUNCTION SA PAG LAGAY NG PROOF OF PAYMENTS PICTURE 
const previewImage = (event) => {
  const input = event.target;
  const preview = document.getElementById('preview');
  preview.style.display = "block";

  const reader = new FileReader();
  reader.onload = () => {
      preview.src = reader.result;
  };
  reader.readAsDataURL(input.files[0]);
}


document.addEventListener("DOMContentLoaded", () => {
const form = document.querySelector(".userBayad");
const sabmitBoton = document.getElementById("sabmitBoton");
// errorText = form.querySelector(".iror");

form.onsubmit = (e) => {
  // Prevent the form from submitting normally
  e.preventDefault();
};


if (sabmitBoton) { 
  sabmitBoton.onclick = () => {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "PHPBackend/PayProcess.php", true);
      xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                let data = xhr.response.trim();  // Trim any extra spaces
                console.log("Response from server:", data);

                if (data === "success") {
                  console.log("Data is 'success'");

                  alert("Payment Success");
                  // location.reload();
                
                } else {
                  // errorText.textContent = data;
                  // errorText.style.display = "block";
                  console.log("Error:", data);
                }
              
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
      };
    }
  }
});