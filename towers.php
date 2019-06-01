<?php
require __DIR__ . "/consts.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= HEAD_PAGE_TITLE ?></title>
    <link rel="icon" href="assets/main/images/hanoi.png" type="image/png" sizes="50x50">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/main/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/main/css/style.css">
</head>
<?php
require __DIR__ . "/functions.php";

list($method, $diskCount) = getTowerParams();
?>
<body>
<div class="main">
    <div class="header">
        <h1><a href="index.php" style="color: #fff;text-decoration: none;"><?= HANOI_SOLVE_PAGE_TITLE ?></h1>
    </div>
    <div class="container" style="color: #000;">
        <div class='row'>

            <div class='col-sm-12' style="margin-bottom: 25px;height: 50px;">
                <?php if ($method == OUTPUT_FULL) { ?>
                    <div class='col-sm-4 text-center' style="padding: 15px 10px;border: 1px solid #595959;border-bottom: none ;border-top: none">
                        <h1><?= COLUMN_FIRST ?></h1>
                    </div>
                    <div class='col-sm-4 text-center' style="padding: 15px 10px;border: 1px solid #595959;border-bottom: none ;border-top: none">
                        <h1><?= COLUMN_SECOND ?></h1>
                    </div>
                    <div class='col-sm-4 text-center' style="padding: 15px 10px;border: 1px solid #595959;border-bottom: none ;border-top: none">
                        <h1><?= COLUMN_THIRD ?></h1>
                    </div>
                <?php } ?>
            </div>
            <div class='col-sm-12 panel panel-default'>
                <?php outputTowerAnswer($method, $diskCount); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
