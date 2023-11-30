

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
                Current Version= <?php include('./module/version.txt') ; ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button href="/update.php">update</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php 
                $latestVersion = file_get_contents('https://github.com/saliar86/testupdate.git/main/version.txt');
                return $latestVersion !== false ? trim($latestVersion) : null; 
            ?>
        </div>
    </div>
</body>
</html>