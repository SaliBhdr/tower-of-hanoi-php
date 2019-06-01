<?php

/**
 * main hanoi towers builder function
 * @param int $diskCount number of disks
 * @param string $a first cylinder or column name
 * @param string $b second cylinder or column name
 * @param string $c third cylinder or column name
 */
function simpleTowerOfHanoi($diskCount, $a = COLUMN_FIRST, $b = COLUMN_SECOND, $c = COLUMN_THIRD)
{
    if (isDiskMovable($diskCount)) {
        echo moveHtml($a, $c) . '<br>';
    } else {
        simpleTowerOfHanoi($diskCount - 1, $a, $c, $b);
        simpleTowerOfHanoi(1, $a, $b, $c);
        simpleTowerOfHanoi($diskCount - 1, $b, $a, $c);
    }
}

/**
 * main hanoi towers builder function with visual drawings
 *
 * @param int $diskCount number of disks
 * @param int $totalDisks total disk number (at the beginning total disks and diskcount are the same but as function passes diskcount will decrease)
 * @param string $a first cylinder or column name
 * @param string $b second cylinder or column name
 * @param string $c third cylinder or column name
 * @param null|array $towerColumns array of columns that are used for building towers
 * @param bool $isFirstTime used for building the columns for first time
 */
function towerOfHanoi($diskCount, $totalDisks = 0, $a = COLUMN_FIRST, $b = COLUMN_SECOND, $c = COLUMN_THIRD, &$towerColumns = null, $isFirstTime = true)
{
    if ($isFirstTime) {
        $totalDisks = $diskCount;
        $towerColumns = startTowerColumns($diskCount);
        echo getStartTowersHtml($diskCount, $towerColumns);
    }

    $towerColumns = diskMover($a . '.' . $c, $diskCount, $towerColumns);

    if (isDiskMovable($diskCount)) {
        echo buildAllTowers($totalDisks, $towerColumns);
        echo getMoveDescriptionHtml($a, $c);
    } else {
        towerOfHanoi($diskCount - 1, $totalDisks, $a, $c, $b, $towerColumns, false);
        towerOfHanoi(1, $totalDisks, $a, $b, $c, $towerColumns, false);
        towerOfHanoi($diskCount - 1, $totalDisks, $b, $a, $c, $towerColumns, false);
    }

}

/**
 * building the tower at the start of function
 *
 * @param $diskCount
 * @return array
 */
function startTowerColumns($diskCount)
{
    return [
        COLUMN_FIRST => buildDisks($diskCount),
        COLUMN_SECOND => [],
        COLUMN_THIRD => [],
    ];
}

/**
 * build disks for first time
 *
 * @param $diskCount
 * @return array
 */
function buildDisks($diskCount)
{
    $disks = [];

    for ($i = $diskCount; $i >= 1; $i--) {
        $width = 100 / ($diskCount + 1) * $i;
        $color = getDiskColor($i);
        $disks[$i] = "<p class='disk' style='{{{" . TOPMARGIN_KEY . "}}};width: {$width}%; background: {$color};'>{$i}</p><br>";
    }

    return $disks;
}

/**
 * moves one disk at the top from one column to another
 *
 * @param string $condition the concatenation of start column and the destination column for moving the disk
 * this way we can track the disk movement from one disk to another
 * @param int $diskCount
 * @param $towerColumns
 * @return mixed
 */
function diskMover($condition, $diskCount, &$towerColumns)
{

    if (isDiskNotMovable($diskCount)) {
        return $towerColumns;
    }

    // separated the source and destination columns that concatenated with '.'
    // $condition is a string like A.B which A is source column and B is destionation column
    list($sourceColumn,$destinationColumn) = explode('.', $condition);

    if (count($towerColumns[$sourceColumn]) > 0) {
        //take the top disk from source column
        $disk = array_pop($towerColumns[$sourceColumn]);

        //put it at the top of destination column
        array_push($towerColumns[$destinationColumn],$disk);
    }

    return $towerColumns;
}

/**
 * builds all tower within each column
 *
 * @param int $diskCount
 * @param array $towerColumns
 * @return string
 */
function buildAllTowers($diskCount, array &$towerColumns)
{
    $html = "<div class='col-sm-12 pb18p'>";
    $html .= buildTower($diskCount, $towerColumns[COLUMN_FIRST]);
    $html .= buildTower($diskCount, $towerColumns[COLUMN_SECOND]);
    $html .= buildTower($diskCount, $towerColumns[COLUMN_THIRD]);
    $html .= "</div>";

    return $html;
}

/**
 * builds one tower within a column
 *
 * @param int $totalDisks
 * @param array $column
 * @return string
 */
function buildTower($totalDisks, $column)
{
    $height = DISK_SPACE * $totalDisks;

    $html = "<div class='col-sm-4 center tower-container' style='height: {$height}px;'>";

    if (empty($column)) {
        $html .= "</div>";
        return $html;
    }

    foreach ($column as $disk) {

        $t = DISK_HEIGHT * $totalDisks;

        $html .= str_replace('{{{' . TOPMARGIN_KEY . '}}}', "top: {$t}px", $disk);
        $totalDisks--;
    }

    $html .= "</div>";

    return $html;
}

/*
|--------------------------------------------------------------------------
| Html builders
|--------------------------------------------------------------------------
*/
/**
 * renders description bellow each tower
 *
 * @param $body
 * @return string
 */
function descriptionHtml($body)
{

    $html = "<div class='col-sm-12 move-description'>";
    $html .= $body . "<br/>";
    $html .= "</div>";

    return $html;
}

/**
 * renders the html of total moves and number of disks html on the top and bottom of page
 *
 * @param $totalDisks
 * @param string $place => css class of container
 * @return string
 */
function getMovesHtml($totalDisks, $place = 'none')
{
    $place = getMovesClass($place);

    $moves = getTotalMoves($totalDisks);
    $html = "<div class='col-sm-12 moves-container {$place}'>";
    $html .= "<h3 class='col-sm-6' style='color: " . getDiskColor($totalDisks) . "'>Number of disks : {$totalDisks}</h3>";
    $html .= "<h3 class='col-sm-6'>Total Moves : {$moves}</h3>";
    $html .= "</div>";

    return $html;
}

/**
 * renders html of every move
 *
 * @param $from
 * @param $to
 * @return string
 */
function getMoveDescriptionHtml($from, $to)
{
    $body = moveHtml($from, $to);

    $html = descriptionHtml($body);

    return $html;
}

/**
 * renders the move sentence html
 *
 * @param $from
 * @param $to
 * @return string
 */
function moveHtml($from, $to)
{
    return "Move disk from " . "<span class='label label-danger'>" . $from . "</span>" . " <i class='zmdi zmdi-arrow-right'></i> " . "<span class='label label-success'>" . $to . "</span>";
}

/**
 * renders the html of towers at the start
 *
 * @param $diskCount
 * @param $towerColumns
 * @return string
 */
function getStartTowersHtml($diskCount, $towerColumns)
{
    $html = buildAllTowers($diskCount, $towerColumns);

    $html .= descriptionHtml("Start Towers");

    return $html;
}

/*
|--------------------------------------------------------------------------
| Helper functions
|--------------------------------------------------------------------------
*/
/**
 * gets the hexadecimal value of color based on int number
 *
 * @param $n
 * @return string
 */
function getDiskColor($n)
{
    $n *= 70;
    $n = crc32($n);
    $n &= 0xffffffff;
    return ("#" . substr("000000" . dechex($n), -6));
}

/**
 * default output of towers if no params has set in towers.php file
 *
 * @param int $diskCount
 */
function defaultOutput($diskCount)
{
    echo getMovesHtml($diskCount, 'top-moves');
    towerOfHanoi($diskCount);
    echo getMovesHtml($diskCount, 'btm-moves');
}

/**
 * solve the algorithm based on method type
 * @values full,simple,only moves
 *
 * @param $method
 * @param $diskCount
 */
function solveBasedOnOutputType($method, $diskCount)
{
    switch ($method) {
        case OUTPUT_FULL:
            echo getMovesHtml($diskCount, 'top-moves');
            towerOfHanoi($diskCount);
            echo getMovesHtml($diskCount, 'btm-moves');
            break;
        case OUTPUT_SIMPLE:
            echo getMovesHtml($diskCount, 'top-moves');
            simpleTowerOfHanoi($diskCount);
            echo getMovesHtml($diskCount, 'btm-moves');
            break;
        case OUTPUT_MOVES:
            echo getMovesHtml($diskCount, 'none');
            break;
        default:
            defaultOutput($diskCount);
            break;
    }
}

/**
 * total moves to solve the algorithm pow(2,n) - 1
 *
 * @param int $totalDisks
 * @return int
 */
function getTotalMoves($totalDisks)
{
    return 2 ** $totalDisks - 1;
}

/**
 * gets the css class of moves html section
 *
 * @param $place
 * @return string
 */
function getMovesClass($place)
{
    return in_array($place, ['btm-moves', 'top-moves', 'none']) ? $place : 'btm-moves';
}

/**
 * outputs the algorithm answer based on requested method
 *
 * @param $method
 * @param $diskCount
 */
function outputTowerAnswer($method, $diskCount)
{
    if (isset($method) && isset($diskCount)) {
        solveBasedOnOutputType($method, $diskCount);
    } else {
        defaultOutput(DEFAULT_DISKS_COUNT);
    }
}

/**
 * the disk is only movable if $diskCount equals to 1
 *
 * @param int $diskCount
 * @return bool
 */
function isDiskMovable($diskCount){
    return $diskCount == 1;
}

/**
 * the disk is only movable if $diskCount equals to 1
 *
 * @param int $diskCount
 * @return bool
 */
function isDiskNotMovable($diskCount){
    return $diskCount != 1;
}

/**
 * gets the params from each form request
 *
 * if no params has been set or the tower.php file reached directly it sets params to default towers disk
 * number and render method
 *
 * @return array
 */
function getTowerParams()
{
    $method = OUTPUT_FULL;
    $diskCount = DEFAULT_DISKS_COUNT;

    if (isset($_GET[SUBMIT_BTN_NAME]) && $_GET[SUBMIT_BTN_NAME] == SUBMIT_BTN_VALUE) {
        $method = (isset($_GET[SOLVE_INPUT_NAME]))
            ? $_GET[SOLVE_INPUT_NAME]
            : OUTPUT_FULL;
        $diskCount = (isset($_GET[DISKS_INPUT_NAME]) && $_GET[DISKS_INPUT_NAME] >= 1)
            ? $_GET[DISKS_INPUT_NAME]
            : DEFAULT_DISKS_COUNT;
    }

    return [$method, $diskCount];
}