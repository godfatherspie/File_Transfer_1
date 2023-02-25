$(document).ready(function () {
  // handle form submission
  $('#file-form').submit(function (event) {
    event.preventDefault();
    var form = $('#file-form')[0];
    var formData = new FormData(form);
    // send form data to server
    $.ajax({
      type: 'POST',
      url: 'file_transfer.php',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        $('#message').html(response);
        $('#message').show();
        $('#file-form')[0].reset();
        $('#qr-code').empty(); // clear QR code
      },
    });
  });

  // handle generate QR code button click
  $('#generate-qr-code').click(function (event) {
    event.preventDefault();
    var fileUrl = $('#file-url').val();
    // generate QR code
    var qrcode = new QRCode('qr-code', {
      text: fileUrl,
      width: 256,
      height: 256,
      colorDark: '#000000',
      colorLight: '#ffffff',
      correctLevel: QRCode.CorrectLevel.H,
    });
  });
});
