setInterval(function() {
  fetch('PHPBackend/checkSessionStatus.php')
      .then(response => {
          // Check if the response is valid JSON
          return response.json().catch(err => {
              console.error('Invalid JSON response:', err);
              return { status: 'error', message: 'Invalid response from server' };  // Default error object
          });
      })
      .then(data => {
          if (data.status === 'inactive' || data.status === 'logged_out') {
              // Redirect user to login page if session is inactive or logged out
              alert("Session Expired");
              window.location.href = 'LoginPage.php';
          }
      })
      .catch(error => {
          console.error('Error during session status check:', error);
          // Handle the error, possibly redirect to an error page or login
      });
}, 2000); // Check every 5 seconds
