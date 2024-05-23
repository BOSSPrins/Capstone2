document.addEventListener("DOMContentLoaded", () => {
const form = document.querySelector(".saynap"),
continueBtn = form.querySelector(".bttn"),
errorText = form.querySelector(".iror");

form.onsubmit = (e)=>{ //preventing the form from submitting
    e.preventDefault();
}
if (continueBtn) {
 continueBtn.onclick = ()=>{   
          
    let xhr = new XMLHttpRequest();      //start ajax creating XML object
    xhr.open("POST", "PHPBackend/Signup.php", true);
    xhr.onload = ()=>{  
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              console.log(data);
              if(data === "success"){
                location.href="LoginPage.php";
              }else{
                errorText.textContent = data;
                errorText.style.display = "block";
                console.log(data);
              }
          }
      }
    }
    // sending data through ajax to php
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
  };    
}
});