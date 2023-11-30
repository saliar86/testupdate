

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-light p-5 text-center">
    <div class="row">
        <div class="col-12">
            <p class="fs-6">
                Local version = <?php include('./module/version.txt') ; ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/update.php">update</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <?php
                // URL of the version.txt file on GitHub
                $versionFileUrl = 'https://raw.githubusercontent.com/saliar86/testupdate/main/module/version.txt';

                // Get the contents of the version.txt file
                $versionContent = file_get_contents($versionFileUrl);

                // Display the contents
                if ($versionContent !== false) {
                    echo 'Github Version: ' . $versionContent;
                } else {
                    echo 'Failed to retrieve version information.';
                }
        ?>
        </div>
    </div>
</body>
</html>