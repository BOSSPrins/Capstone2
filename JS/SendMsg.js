const form = document.querySelector(".typing-area"), 
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector(".sendbtn"),
chatBox = document.querySelector(".chatbaks");
let chatbaks = document.getElementById("message-display");


function scrollToBottom() {  
  chatBox.scrollTop = chatBox.scrollHeight;
};
  
form.onsubmit = (e)=>{ //preventing the form from submitting
  e.preventDefault();
}
function getFormattedTimestamp() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is zero-based
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');

  // Format: YYYY-MM-DD HH:MM:SS
  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

  sendBtn.onclick = ()=>{   
          
  let xhr = new XMLHttpRequest();      //start ajax creating XML object
  xhr.open("POST", "PHPBackend/InsertChat.php", true);
  xhr.onload = ()=>{  
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          inputField.value = "";
          scrollToBottom();
          getFormattedTimestamp();
        }
    }
  }
  // sending data through ajax to php
  let formData = new FormData(form); //creating new formData object
  xhr.send(formData); //sending the form data to php
};

chatBox.onmouseenter = ()=>{
  chatBox.classList.add("active");
  
}
chatBox.onmouseleave = ()=>{
  chatBox.classList.remove("active");
}

function startInterval() {

  intervalId = setInterval(() => {

  let xhr = new XMLHttpRequest(); //start ajax creating XML object
  xhr.open("POST", "PHPBackend/GetChat.php", true);
  xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
              let data = xhr.response;
              chatBox.innerHTML = data;
              if (!chatBox.classList.contains("active")) { // kapag yung active wala sa kanya
                  scrollToBottom();
                  getFormattedTimestamp();
                 
              }
              addHoverListeners();
              addDropdownListeners();
          }
      }
  }
  
  let formData = new FormData(form); //creating new formData object
  xhr.send(formData);

}, 500);
// magarun ito nang tuloy tuloy after 500 ms
}

function addHoverListeners() {
  let tridotElements = document.querySelectorAll('.chatItems');
  tridotElements.forEach(element => {
      element.addEventListener('mouseover', () => {
          clearInterval(intervalId);
          console.log("Interval cleared on hover.");
      });
      element.addEventListener('mouseout', () => {
          startInterval();
          console.log("Interval restarted on mouse out.");
      });
  });
}

function addDropdownListeners() {
  document.querySelectorAll('.ItemDrop-btn').forEach(function(item) {
      item.addEventListener('click', function(e) {
          e.preventDefault();
          if (this.parentElement.classList.contains('active')) {
              this.parentElement.classList.remove('active');
          } else {
              document.querySelectorAll('.ItesmDropDown').forEach(function(i) {
                  i.classList.remove('active');
              });
              this.parentElement.classList.add('active');
          }
      });
  });
}

startInterval();
// DI PA WRAP YUNG BUBBLE SA BILANG NG TEXT