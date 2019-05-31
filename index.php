<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tower Of Hanoi</title>
    <link rel="icon" href="assets/main/images/hanoi.png" type="image/png" sizes="50x50">
    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/main/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/main/css/style.css">
</head>
<body>
    <div class="main">
        <div class="header">
            <h1><a style="color: #fff;text-decoration: none;" target="_blank" href="https://en.wikipedia.org/wiki/Tower_of_Hanoi">Tower Of Hanoi</a></h1>
        </div>
        <div class="container">
            <form id="booking-form" class="booking-form" method="GET" action="towers.php">
                <div class="form-group">
                    <div class="form-quantity">
                        <label for="quantity">Disks</label>
                        <span class="modify-qty plus" onClick="up()"><i class="zmdi zmdi-chevron-up"></i></span>
                        <input type="text" name="disk_count" id="quantity" value="3" class="nput-text qty text">
                        <span class="modify-qty minus" onClick="down()"><i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                    <div class="form-destination">
                        <label for="full">full draw</label>
                        <input type="radio" id="full" name="solve_method"  value="full_draw" checked>

                        <label for="simple">simple solve</label>
                        <input type="radio" id="simple" name="solve_method" value="simple_solve"  class="nput-text text">

                        <label for="moves">only moves</label>
                        <input type="radio" id="moves" name="solve_method"  value="just_moves">
                    </div>
                    <div class="form-submit">
                        <input type="submit" id="submit" name="submit" class="submit" value="Solve" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- JS -->
    <script src="assets/main/vendor/jquery/jquery.min.js"></script>
<!--    <script src="assets/main/vendor/jquery-ui/jquery-ui.min.js"></script>-->
    <script src="assets/main/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>