document.querySelector('.ContainersNgRequestForms').addEventListener('click', function() {
  document.querySelector('.ModalForEachReqForm').style.display = 'block';
});

document.querySelector('.ReqCertClose').addEventListener('click', function(event) {
  event.stopPropagation();
  document.querySelector('.ModalForEachReqForm').style.display = 'none';
});