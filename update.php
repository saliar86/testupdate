<?php

// Function to get the version of the module
function getModuleVersion()
{
    $versionFile = __DIR__ . '/module/version.txt'; // Assuming version.txt is in the module directory
    return file_exists($versionFile) ? trim(file_get_contents($versionFile)) : null;
}

// Function to get the latest version from GitHub
function getLatestVersion()
{
    $latestVersion = file_get_contents('https://raw.githubusercontent.com/autovm-modules/AutoVM-WHMCS-Modules/main/version.txt');
    return $latestVersion !== false ? trim($latestVersion) : null;
}

// Function to check if an update is needed
function isUpdateNeeded()
{
    $currentVersion = getModuleVersion();
    $latestVersion = getLatestVersion();

    return $currentVersion !== null && $latestVersion !== null && $currentVersion !== $latestVersion;
}

// Function to run the update
function runUpdate()
{
    $moduleDir = __DIR__ . '/module';
    $backupDir = $moduleDir . '/old';

    // Create the backup directory if it doesn't exist
    if (!file_exists($backupDir)) {
        mkdir($backupDir, 0777, true);
    }

    // Copy existing module files to the backup directory
    $oldFiles = glob($moduleDir . '/*');
    foreach ($oldFiles as $file) {
        $destination = $backupDir . '/' . basename($file);
        copy($file, $destination);
    }

    // Remove existing module files
    array_map('unlink', glob($moduleDir . '/*'));

    // Clone or pull the latest module files from GitHub
    exec('git -C ' . $moduleDir . ' pull origin main');
}

// Main script logic
if (isUpdateNeeded()) {
    runUpdate();
    echo "Module updated successfully.";
} else {
    echo "Module is up to date.";
}
