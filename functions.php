<?php


function towerOfHanoi($diskCount, $totalDisks = 0, $a = COLUMN_FIRST, $b = COLUMN_SECOND, $c = COLUMN_THIRD, &$towerColumns = null, $isFirstTime = true)
{
    if ($isFirstTime) {
        $totalDisks = $diskCount;
        $towerColumns = startTowerColumns($diskCount);
        echo getStartTowersHtml($diskCount, $towerColumns);
    }

    $towerColumns = diskMover($a . '.' . $c, $diskCount, $towerColumns);

    if ($diskCount == 1) {
        echo buildAllTowers($totalDisks, $towerColumns);
        echo getMoveDescriptionHtml($a, $c);
    } else {
        towerOfHanoi($diskCount - 1, $totalDisks, $a, $c, $b, $towerColumns, false);
        towerOfHanoi(1, $totalDisks, $a, $b, $c, $towerColumns, false);
        towerOfHanoi($diskCount - 1, $totalDisks, $b, $a, $c, $towerColumns, false);
    }

}

function getTotalMoves($totalDisks)
{
    return 2 ** $totalDisks - 1;
}

function getMovesHtml($totalDisks)
{
    $moves = getTotalMoves($totalDisks);
    $html = "<div class='col-sm-12' style='border-bottom: 1px solid lightgrey;padding-bottom: 18px;'>";
    $html .= "<h3 style='font-size: 15px;' class='col-sm-6'>Number of disks : {$totalDisks}</h3><h3 style='font-size: 15px;' class='col-sm-6'>Total Moves : {$moves}</h3>";
    $html .= "</div>";

    return $html;
}

function getMoveDescriptionHtml($from, $to)
{
    $html = "<div class='col-sm-12' style='border-bottom: 1px solid lightgrey;padding-bottom: 18px;'>";
    $html .= " Move disk from column " . "<span style='color: red'>" . $from . "</span>" . " to column " . "<span style='color: blue'>" . $to . "</span>" . "<br/>";
    $html .= "</div>";

    return $html;
}

function startTowerColumns($diskCount)
{
    return [
        COLUMN_FIRST => buildDisks($diskCount),
        COLUMN_SECOND => [],
        COLUMN_THIRD => [],
    ];
}

function getStartTowersHtml($diskCount, $towerColumns)
{
    $html = "<div class='col-sm-12' style='padding-bottom: 18px;'>";
    $html .= buildAllTowers($diskCount, $towerColumns);
    $html .= "</div>";
    $html .= "<div class='col-sm-12' style='border-bottom: 1px solid lightgrey;padding-bottom: 18px;'>";
    $html .= "Start towers" . "<br/>";
    $html .= "</div>";

    return $html;
}

function buildDisks($diskCount)
{
    $disks = [];

    $top = 85 / $diskCount;
    for ($i = $diskCount; $i >= 1; $i--) {
        $t = $top * $i;
        $width = 100 / ($diskCount + 1) * $i;
        $color = getDiskColor($i);
        $disks[$i] = "<p style='top: {$t}%;width: {$width}%; height: 20px; background: {$color}; border-radius: 100px / 50px;'></p><br>";
    }

    return $disks;
}

function diskMover($condition, $diskCount, &$towerColumns)
{
    if ($diskCount != 1) {
        return $towerColumns;
    }

    $condition = explode('.', $condition);

    if (count($towerColumns[$condition[0]]) > 0) {

        $disk = array_pop($towerColumns[$condition[0]]);

        array_push($towerColumns[$condition[1]], $disk);
    }

    return $towerColumns;
}


function buildAllTowers($diskCount, array &$towerColumns)
{
    $html = "<div class='col-sm-12' style='padding-bottom: 18px;'>";
    $html .= buildTower($diskCount, $towerColumns[COLUMN_FIRST]);
    $html .= buildTower($diskCount, $towerColumns[COLUMN_SECOND]);
    $html .= buildTower($diskCount, $towerColumns[COLUMN_THIRD]);
    $html .= "</div>";

    return $html;
}

function buildTower($totalDisks, $column)
{
    $height = 25 * $totalDisks;

    $html = "<div class='col-sm-4 center' style='height: {$height}px;border: 1px solid #eaeaea;min-height: 80px;border-bottom: none ;border-top: none'>";

    if (empty($column)) {
        $html .= "</div>";
        return $html;
    }

    foreach ($column as $disk) {
        $html .= $disk;
    }

    $html .= "</div>";

    return $html;
}

function getDiskColor($n)
{
    $n *= 10;
    $n = crc32($n);
    $n &= 0xffffffff;
    return ("#" . substr("000000" . dechex($n), -6));
}

function simpleTowerOfHanoi($diskCount, $a = COLUMN_FIRST, $b = COLUMN_SECOND, $c = COLUMN_THIRD)
{
    if ($diskCount == 1) {
        echo " Move disk from " . "<span style='color: red'>" . $a . "</span>" . " to " . "<span style='color: blue'>" . $c . "</span>" . "<br/>";

    } else {
        simpleTowerOfHanoi($diskCount - 1, $a, $c, $b);
        simpleTowerOfHanoi(1, $a, $b, $c);
        simpleTowerOfHanoi($diskCount - 1, $b, $a, $c);
    }
}

function solveBasedOnOutputType($method,$diskCount){
    switch ($method) {
        case OUTPUT_FULL:
            echo getMovesHtml($diskCount);
            towerOfHanoi($diskCount);
            echo getMovesHtml($diskCount);
            break;
        case OUTPUT_SIMPLE:
            echo getMovesHtml($diskCount);
            simpleTowerOfHanoi($diskCount);
            echo getMovesHtml($diskCount);
            break;
        case OUTPUT_MOVES:
            echo getMovesHtml($diskCount);
            break;
        default:
            defaultOutput($diskCount);
            break;
    }
}

function defaultOutput($diskCount){
    echo getMovesHtml($diskCount);
    towerOfHanoi($diskCount);
    echo getMovesHtml($diskCount);
}

function getTowerParams(){
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

    return [$method,$diskCount];
}

function outputTowerAnswer($method,$diskCount){
    if (isset($method) && isset($diskCount)) {
        solveBasedOnOutputType($method, $diskCount);
    } else {
        defaultOutput(DEFAULT_DISKS_COUNT);
    }
}