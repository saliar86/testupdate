<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autovm Module Updater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body class="container bg-dark text-light p-5">


<?php

$DirectoriesList = ['console', 'includes/hooks/autovm', 'modules/addons/autovm', 'modules/addons/cloudsnp', 'modules/addons/cloud', 'modules/servers/balance', 'modules/servers/traffic', 'modules/servers/product', 'includes/hooks/balance.php', 'includes/hooks/autovm.php'];
$RemoteZipAddress = 'http://localhost:8888/whmcsmodule.zip';
$RemoteVersionAddress = 'http://localhost:8888/autovmversion.txt';
$RemoteVersion = file_get_contents($RemoteVersionAddress);


$localZipAddress = __DIR__ . '/downloaded.zip';
$RooteAddress = __DIR__ . '/';
$LocalVersionAddress = __DIR__ . '/autovmversion.txt';
$LocalVersion = file_get_contents($LocalVersionAddress);




























$method = $_GET['funcmethod'];

if(empty($method) || ($method != 'install' && $method != 'delete' && $method != 'update')){
    $method = 'none';
}

// if($method == 'none')
// {
//     echo 'this method is not registered';
// } else {
//     echo 'Method: ' . $method . '<br>';
// }

if($method == 'install')
{
    DownloadZip($RemoteZipAddress, $localZipAddress);
    ExtractZip($localZipAddress, $RooteAddress);
    DeletDirectory('__MACOSX');
}



if($method == 'delete')
{    
    foreach ($DirectoriesList as $item){
        DeletDirectory($item);
    }
}





function DeletDirectory($src) {
    $notexist = '<span class="text-danger">Not Exist: </span>';

    if (!file_exists($src)) {
        echo $notexist;
        echo $src . '<br>';
        return;
    }

    if (is_file($src)) {
        unlink($src);
        echo "Deleted : $src <br>";
        return;
    }
    
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            $full = $src . '/' . $file;
            if (is_dir($full) ) {
                DeletDirectory($full);
            }
            else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    if (is_dir($src) && rmdir($src)) {
        echo "Deleted : $src <br>";
    } elseif (is_file($src) && unlink($src)) {
        echo "Deleted : $src <br>";
    } else {
        echo "Error: $src <br>";
    }
    
}






function DownloadZip($RemoteZipAddress, $localZipAddress) 
{
    
    // Initialize cURL session
    $ch = curl_init($RemoteZipAddress);
    $fp = fopen($localZipAddress, 'wb');

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
}



function ExtractZip($localZipAddress, $RooteAddress) 
{   
    // Check if the zip file was downloaded successfully
    if (file_exists($localZipAddress)) {
        // Open the zip file
        $zip = new ZipArchive;
        if ($zip->open($localZipAddress) === TRUE) {
            // Extract the contents to the local directory
            $zip->extractTo($RooteAddress);
            $zip->close();
            echo 'Zip file extracted successfully.';
        } else {
            echo 'Failed to open the zip file.';
        }
    } else {
        echo 'Failed to download the zip file.';
    }
}














?>






</body>
</html>

