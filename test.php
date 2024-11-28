<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Suggestion with Table</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <script src="jsPDF/dist/jspdf.umd.min.js"></script>
    <script src="jQuery/jquery.min.js"></script>
    <style>
      body {
    font-family: Arial, sans-serif;
    position: relative;
    margin: 0;
    padding: 0;
    height: 100vh;
    }

    .notification {
        position: absolute;
        top: 20px;
        right: -300px; /* Initially off the screen */
        padding: 15px 20px;
        border-radius: 5px;
        transition: right 0.5s ease; /* Animation for sliding */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Shadow effect */
    }

    .green {
        background-color: #4caf50; /* Green background */
        color: white; /* White text */
    }

    .red {
        background-color: #f44336; /* Red background */
        color: white; /* White text */
    }

    .notification.show {
        right: 20px; /* Position when shown */
    }


    #suggestionInput {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .suggestion-container {
        display: none; /* Hidden by default */
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        width: 100%;
        z-index: 1000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        border: 1px solid #ccc;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .action-button {
        padding: 5px 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .action-button:hover {
        background-color: #0056b3;
    }

    .loader {
  border: 8px solid #f3f3f3; /* Lighter gray border */
  border-radius: 50%;
  border-top: 8px solid blue; /* Top color */
  border-bottom: 8px solid blue; /* Bottom color */
  width: 60px; /* Smaller width */
  height: 60px; /* Smaller height */
  -webkit-animation: spin 1.5s linear infinite; /* Slightly faster spin */
  animation: spin 1.5s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

      
      
    </style>
</head>
<body>
    <div class="autocomplete-container">
        <input type="text" id="suggestionInput" placeholder="Type to search...">
        <div class="suggestion-container" id="suggestionContainer">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th> <!-- New column for action button -->
                    </tr>
                </thead>
                <tbody id="suggestionTableBody">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="notification green" id="greenNotification">This is a green notification!</div>
    <div class="notification red" id="redNotification">This is a red notification!</div>
    
    <button onclick="showGreenNotification()">Show Green Notification</button>
    <button onclick="showRedNotification()">Show Red Notification</button>


    <button onclick="generatePDF()">Generate Letter</button>

    <input type="checkbox" name="" id="">

    <div id="loading-indicator" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
  <div class="loader"></div>
</div>


<form method="POST" action="PHPBackend/Verify_OTP.php">
    <input type="text" name="email" id="email" value="vardump007@gmail.com">
    <input type="hidden" name="action" value="send_otp">
    <button type="submit">Send OTP</button>
</form>


<script>
    
    document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('suggestionInput');
    const suggestionContainer = document.getElementById('suggestionContainer');
    const suggestionTableBody = document.getElementById('suggestionTableBody');

    const data = [
        { name: "John Doe", address: "123 Elm St", phone: "555-1234" },
        { name: "Jane Smith", address: "456 Oak St", phone: "555-5678" },
        { name: "Mike Johnson", address: "789 Pine St", phone: "555-8765" },
        // Add more data as needed
    ];

    input.addEventListener('input', function() {
        const query = input.value.toLowerCase();
        suggestionTableBody.innerHTML = ''; // Clear previous suggestions
        suggestionContainer.style.display = 'none'; // Hide the container by default

        if (query) {
            const filteredData = data.filter(item => item.name.toLowerCase().includes(query));

            if (filteredData.length > 0) {
                filteredData.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.address}</td>
                        <td>${item.phone}</td>
                        <td><button class="action-button" data-name="${item.name}">Action</button></td> <!-- Action button -->
                    `;
                    suggestionTableBody.appendChild(row);
                });
                suggestionContainer.style.display = 'block'; // Show the suggestion container
            }
        }
    });

    // Handle button click event
    suggestionTableBody.addEventListener('click', function(event) {
        if (event.target.classList.contains('action-button')) {
            const name = event.target.getAttribute('data-name');
            alert(`Action button clicked for ${name}`);
            // Perform any action you want here, such as redirecting or displaying more info
        }
    });

    // Hide the suggestion container when clicking outside
    document.addEventListener('click', function(event) {
        if (!input.contains(event.target) && !suggestionContainer.contains(event.target)) {
            suggestionContainer.style.display = 'none';
        }
    });
});

function showGreenNotification() {
    showNotification('greenNotification');
}

function showRedNotification() {
    showNotification('redNotification');
}

function showNotification(notificationId) {
    const notification = document.getElementById(notificationId);
    
    // Show the notification
    notification.classList.add('show');

    // After 2 seconds, hide the notification
    setTimeout(() => {
        notification.classList.remove('show');
        // Move it off the screen again after hiding
        setTimeout(() => {
            notification.style.right = '-300px'; // Reset position
        }, 500); // Wait for the slide-out animation to finish
    }, 2000); // Show for 2 seconds
}


const { jsPDF } = window.jspdf;

// Function to generate the PDF
function generatePDF() {
  const doc = new jsPDF();

  // Set background color (light gray) for the entire page
  doc.setFillColor(204, 204, 204); // RGB for the background color
  doc.rect(0, 0, 210, 297, 'F'); // A4 size: 210mm x 297mm
  
  // Add Logo Image (Assuming the image is available in the same directory)
  const logoUrl = 'Pictures/Mabuhay_Logo.png';  // Make sure the path to the image is correct
  doc.addImage(logoUrl, 'PNG', 15, 15, 60, 30); // X, Y, width, height

  // Set Font for the Text
  doc.setFont('helvetica', 'normal');
  
  // Title: Name of Mabuhay
  doc.setFontSize(20);
  doc.setTextColor(0, 0, 154); // Blue color for text
  doc.text('MABUHAY HOMES 2000 PHASE V', 85, 30); // Positioning for the title

  // Address: Brgy. Salawag, Dasmarinas, Cavite
  doc.setFontSize(12);
  doc.setTextColor(7, 7, 178); // Blue color for the address
  doc.text('Brgy. Salawag, Dasmarinas, Cavite', 85, 40); // Positioning for the address

  // HLURB Registration Number: HLURB REG. # 04-3792
  doc.setFontSize(12);
  doc.setTextColor(214, 0, 0); // Red color for the Registration number
  doc.text('HLURB REG. # 04-3792', 85, 50); // Positioning for the registration number

  // Tel No: Tel. No. 973-9422
  doc.setFontSize(12);
  doc.setTextColor(7, 7, 178); // Blue color for the phone number
  doc.text('Tel. No. 973-9422', 85, 60); // Positioning for the phone number

  // Horizontal Rule (Line)
  doc.setDrawColor(0, 81, 168); // Blue color for the line
  doc.setLineWidth(0.5);
  doc.line(10, 70, 200, 70); // Draw line from left (10) to right (200)

  // Save the document as a PDF
  doc.save('letter.pdf');
}


</script>
</body>
</html>
