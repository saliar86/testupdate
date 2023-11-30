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
    $latestVersion = file_get_contents('https://raw.githubusercontent.com/saliar86/testupdate/main/module/version.txt');
    return $latestVersion !== false ? trim($latestVersion) : null;
}

// Function to check if an update is needed
function isUpdateNeeded()
{
    $currentVersion = getModuleVersion();
    $latestVersion = getLatestVersion();
    echo('<br>');echo('<br>');
    echo('Local file version is = ' . $currentVersion);
    echo('<br>');echo('<br>');
    echo('Latest version on git is = ' . $latestVersion);
    echo('<br>');echo('<br>');
    return $currentVersion !== null && $latestVersion !== null && $currentVersion !== $latestVersion;
}

// Function to run the update
function runUpdate()
{
    $moduleDir = __DIR__ . '/module';
    $backupDir = __DIR__ . '/backupDir';

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
    cloneGit();
    
}


function cloneGit()
{
    // Set the repository URL and target directory
    $repositoryUrl = 'https://github.com/saliar86/testupdate.git';
    $targetDirectory = '/module';

    // Git clone command
    $gitCloneCommand = 'git clone ' . $repositoryUrl . ' ' . $targetDirectory;

    // Execute the Git clone command
    exec($gitCloneCommand, $output, $returnCode);

    // Check for errors and display output
    if ($returnCode !== 0) {
        echo 'Git clone failed with return code ' . $returnCode . PHP_EOL;
        echo 'Output: ' . implode(PHP_EOL, $output) . PHP_EOL;
    } else {
        echo 'Git clone successful.' . PHP_EOL;
    }
}


// Main script logic
if (isUpdateNeeded()) {
    runUpdate();
    echo "<br>Module updated successfully.<br>";
} else {
    echo "<br>Module is up to date.<br>";
}
