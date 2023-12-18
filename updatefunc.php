<?php

// URL of the zip file
$zipFileUrl = 'https://dev.frenchexam.ir/codes.zip';

// Local path to save the zip file
$localZipFilePath = __DIR__ . '/codes.zip';

// Local directory to unzip the contents
$localExtractPath = __DIR__ . '/DownloadFolder/new';

// Initialize cURL session
$ch = curl_init($zipFileUrl);
$fp = fopen($localZipFilePath, 'wb');

// Set cURL options
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

// Execute cURL session
curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    echo 'Zip file downloaded successfully.';
}

// Close cURL session and file pointer
curl_close($ch);
fclose($fp);

// Check if the zip file was downloaded successfully
if (file_exists($localZipFilePath)) {
    // Open the zip file
    $zip = new ZipArchive;
    if ($zip->open($localZipFilePath) === TRUE) {
        // Extract the contents to the local directory
        $zip->extractTo($localExtractPath);
        $zip->close();

        echo 'Zip file extracted successfully.';
    } else {
        echo 'Failed to open the zip file.';
    }
} else {
    echo 'Failed to download the zip file.';
}

?>
