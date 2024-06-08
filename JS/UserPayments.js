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



