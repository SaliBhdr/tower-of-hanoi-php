<?php
require __DIR__ . "/includes/consts.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= HEAD_PAGE_TITLE ?></title>
    <link rel="icon" href="assets/main/images/hanoi.png" type="image/png" sizes="50x50">
    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/main/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/main/css/style.css">
</head>
<body>
<div class="main">
    <div class="header">
        <h1>
            <a target="_blank" href="https://github.com/SaliBhdr/tower-of-hanoi">
                <?= HOME_PAGE_TITLE ?>
            </a>
        </h1>
    </div>
    <div class="container">
        <form id="booking-form" class="booking-form" method="GET" action="towers.php">
            <div class="form-group">
                <div class="form-quantity">
                    <label for="quantity">Disks</label>
                    <span class="modify-qty plus" onClick="up()"><i class="zmdi zmdi-chevron-up"></i></span>
                    <input type="text" name="<?= DISKS_INPUT_NAME ?>" id="quantity" value="<?= DEFAULT_DISKS_COUNT ?>"
                           class="nput-text qty text">
                    <span class="modify-qty minus" onClick="down()"><i class="zmdi zmdi-chevron-down"></i></span>
                </div>
                <div class="form-destination">
                    <label for="full">Full Draw</label>
                    <input type="radio" id="full" name="<?= SOLVE_INPUT_NAME ?>" value="<?= OUTPUT_FULL ?>" checked>

                    <label for="simple">Simple Solve</label>
                    <input type="radio" id="simple" name="<?= SOLVE_INPUT_NAME ?>" value="<?= OUTPUT_SIMPLE ?>">

                    <label for="moves">Only Moves</label>
                    <input type="radio" id="moves" name="<?= SOLVE_INPUT_NAME ?>" value="<?= OUTPUT_MOVES ?>">
                </div>
                <div class="form-submit">
                    <input type="submit" id="submit" class="submit" name="<?= SUBMIT_BTN_NAME ?>"
                           value="<?= SUBMIT_BTN_VALUE ?>"/>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- JS -->
<script src="assets/main/vendor/jquery/jquery.min.js"></script>
<script src="assets/main/js/main.js"></script>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>