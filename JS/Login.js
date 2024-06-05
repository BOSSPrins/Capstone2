document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".lagin");
  const continueBtn = form.querySelector(".laginbtn");
  const errorText = form.querySelector(".iror");

  form.onsubmit = (e) => {
    // Prevent the form from submitting normally
    e.preventDefault();
  };

  if (continueBtn) {
    continueBtn.onclick = () => {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "PHPBackend/Login.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            console.log(data);

            if (data === "admin") {
              window.location.href = "DashBoard.php";
            } else if (data === "user") {
              window.location.href = "UserRequest.php";
            } else {
              errorText.textContent = data;
              errorText.style.display = "block";
              console.log(data);
            }
          }
        }
      };

      let formData = new FormData(form);
      xhr.send(formData);
    };
  }
});
