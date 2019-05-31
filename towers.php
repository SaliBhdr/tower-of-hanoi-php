<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tower Of Hanoi</title>
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

if(isset($_GET['submit']) && $_GET['submit'] == 'Solve'){
    $method = $_GET['solve_method'] ?? 'full_draw';
    $diskCount = (isset($_GET['disk_count']) && $_GET['disk_count'] >= 1) ? $_GET['disk_count']:3;
}
?>
<body>
<div class="main">
    <div class="header">
        <h1><a href="index.php" style="color: #fff;text-decoration: none;">Home<a></h1>
    </div>
    <div class="container" style="color: black;">
    <div class='row'>

        <div class='col-sm-12' style="margin-bottom: 25px;height: 50px;">
            <?php if($method == 'full_draw' || $method == 'simple_solve'){ ?>
            <div class='col-sm-4 text-center'>
                <h1>A</h1>
            </div>
            <div class='col-sm-4 text-center'>
                <h1>B</h1>
            </div>
            <div class='col-sm-4 text-center'>
                <h1>C</h1>
            </div>
            <?php  } ?>
        </div>
        <div class='col-sm-12 panel panel-default'>
            <?php
            if(isset($method) && isset($diskCount)){
                switch ($method){
                    case 'full_draw':
                        echo getMovesHtml($diskCount);
                        towerOfHanoi($diskCount);
                        echo getMovesHtml($diskCount);
                        break;
                    case 'simple_solve':
                        echo getMovesHtml($diskCount);
                        simpleTowerOfHanoi($diskCount);
                        echo getMovesHtml($diskCount);
                        break;
                    case  'just_moves':
                        echo getMovesHtml($diskCount);
                        break;
                    default:
                        echo getMovesHtml($diskCount);
                        towerOfHanoi($diskCount);
                        echo getMovesHtml($diskCount);
                        break;
                }
            }else{
                echo getMovesHtml(3);
                towerOfHanoi(3);
                echo getMovesHtml(3);
            }

            ?>
        </div>
    </div>
    </div>
</div>
</body>
</html>
