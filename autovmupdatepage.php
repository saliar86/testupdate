<?php   include_once('autovmupdatefunc.php');    ?>
    
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
    <div class="d-felx flex-row justify-content-center align-items-center py-5">
        <span class="h3">
            Autovm Module Updater
        </span>
        (
        <span class="text-primary">
            <?php echo($RemoteVersion); ?>
        </span>
        )
    </div>
    <div class="d-felx flex-row justify-content-center align-items-center">
        <p>
            <span>
                Your Module Version is 
            </span>
            <span class="text-warning">
                <?php echo($LocalVersion); ?>
            </span>
            <span class="text-light">
                and you should update by click on 
            </span>
            <a class="btn btn-primary px-3 mx-2" href="autovmupdatefunc.php?funcmethod=update">Update Module</a>
        </p>
    </div>
    <div class="d-flex flex-row justify-content-end align-items-center">
        <a class="btn btn-danger px-3 mx-2" href="autovmupdatefunc.php?funcmethod=install">Install Module For Fisrt Time</a>
        <a class="btn btn-danger px-3 mx-2" href="autovmupdatefunc.php?funcmethod=delete">Delete Module</a>
    </div>
</body>
</html>

