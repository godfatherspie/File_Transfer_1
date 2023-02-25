<?php
// Set the upload directory
$upload_dir = "uploads/";

// If files were submitted
if (!empty($_FILES)) {
    // Loop through all the files
    foreach ($_FILES['file']['name'] as $i => $name) {
        // Check if the file was uploaded successfully
        if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK) {
            // Generate a unique filename for the uploaded file
            $filename = uniqid() . "_" . $name;
            // Move the file from the temporary location to the upload directory
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $upload_dir . $filename);
        }
    }
}

// If the form was submitted with a URL parameter
if (isset($_GET['url'])) {
    // Get the URL parameter
    $url = $_GET['url'];
    // Generate a QR code for the URL
    $qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($url);
    // Output the QR code image
    header('Content-Type: image/png');
    readfile($qr);
}
?>
