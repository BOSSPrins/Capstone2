document.querySelector('.ContainersNgRequestForms').addEventListener('click', function() {
  document.querySelector('.ModalForEachReqForm').style.display = 'block';
});

document.querySelector('.ReqCertClose').addEventListener('click', function(event) {
  event.stopPropagation();
  document.querySelector('.ModalForEachReqForm').style.display = 'none';
});


//Ajax nung send ng Insert sa detabes
$(document).ready(function () {
            
  $('.BiyuModal').click(function (e) { 
      e.preventDefault();
      
      var user_id = $(this).closest('tr').find('.user_id').text();
      var lastName = $('#Lname').val();
      var firstName = $('#Fname').val();
      var middleName = $('#Mname').val();
      var age = $('#Age').val();
      var sex = $('#Sex').val();
      var phoneNumber = $('#PhoneNum').val();
      var block = $('#Blk').val();
      var lot = $('#Lot').val();
      var ecName = $('#ecName').val();
      var ecRel = $('#ecRel').val();
      var ecNum = $('#ecNum').val();

      $.ajax({
          method: "POST",
          url: "PHPBackend/InsertData.php", // Change the URL to your PHP script for insertion
          data: {
              'insert_data': true,
              'user_id': user_id,
              'last_name': lastName,
              'first_name': firstName,
              'middle_name': middleName,
              'age': age,
              'sex': sex,
              'phone_number': phoneNumber,
              'block': block,
              'lot': lot,
              'ec_name': ecName,
              'ec_relship': ecRel,
              'ec_phone_num': ecNum
          },

          success: function (response) {
              // Handle success response
              console.log(response);
          },
          error: function(xhr, status, error) {
              // Handle error
              console.error('Error:', error);
          }
      });
  });
});
