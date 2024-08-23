document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".saynap");
  const SaynapBtn = form.querySelector(".SaynapBtn");
  const errorText = form.querySelector(".iror");

  if (SaynapBtn) {
      console.log("Signup button found");

      SaynapBtn.addEventListener("click", (event) => {
          console.log("Signup button clicked");

          // Prevent default form submission
          event.preventDefault();

          let formData = new FormData(form);

          // Debugging: Log all form data entries
          for (const [key, value] of formData.entries()) {
              console.log(`${key}: ${value}`);
          }

          let xhr = new XMLHttpRequest();
          xhr.open("POST", "PHPBackend/Signup.php", true);

          xhr.onload = () => {
              console.log("AJAX request completed");

              if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                      let data = xhr.response.trim();  // Use trim() to handle unexpected white space
                      console.log("Response received: ", data);

                      if (data === "success") {
                          console.log("Redirecting to LoginPage.php");
                          // location.reload();
                          alert("Ayos na bossiing");
                          location.href = "LoginPage.php";

                      } else {
                          errorText.textContent = data;
                          errorText.style.display = "block";
                          console.log("Error text displayed: ", data);
                      }
                  } else {
                      console.log("Error: Request status not 200");
                  }
              } else {
                  console.log("Error: XHR readyState is not DONE");
              }
          }

          xhr.onerror = () => {
              console.log("Error: AJAX request failed");
          }

          console.log("Form data being sent: ", formData);
          xhr.send(formData);
      });
  } else {
      console.log("Signup button not found");
  }
});

function calculateAge() {
  console.log("calculateAge function called");

  const dob = document.getElementById('dob').value;
  const ageInput = document.getElementById('age');
  console.log("DOB value: ", dob);

  if (dob) {
      const dobDate = new Date(dob);
      const today = new Date();
      let age = today.getFullYear() - dobDate.getFullYear();
      const monthDiff = today.getMonth() - dobDate.getMonth();
      const dayDiff = today.getDate() - dobDate.getDate();

      if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
          age--;
      }

      ageInput.value = age;
      console.log("Calculated age: ", age);
  } else {
      ageInput.value = '';
      console.log("DOB not provided, age input cleared");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  console.log("Second DOMContentLoaded for checkboxes");

  const checkYes = document.getElementById("checkYes");
  const checkNo = document.getElementById("checkNo");

  checkYes.addEventListener("change", () => {
      console.log("Yes checkbox changed: ", checkYes.checked);
      if (checkYes.checked) {
          checkNo.checked = false;
          console.log("No checkbox unchecked");
      }
  });

  checkNo.addEventListener("change", () => {
      console.log("No checkbox changed: ", checkNo.checked);
      if (checkNo.checked) {
          checkYes.checked = false;
          console.log("Yes checkbox unchecked");
      }
  });
});
