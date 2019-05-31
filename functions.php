<?php


function towerOfHanoi($diskCount, $totalDisks = 0, $a = 'A', $b = 'B', $c = 'C', &$towerColumns = null, $isFirstTime = true)
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
    $html .= "<h3 style='font-size: 20px;' class='col-sm-6'>number of disks : {$totalDisks}</h3><h3 style='font-size: 20px;' class='col-sm-6'>Total Moves : {$moves}</h3>";
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
        'a' => buildDisks($diskCount),
        'b' => [],
        'c' => [],
    ];
}

function getStartTowersHtml($diskCount, $towerColumns)
{
    $html = "<div class='col-sm-12' style='padding-bottom: 18px;'>";
    $html .= buildAllTowers($diskCount, $towerColumns);
    $html .= "</div>";
    $html .= "<div class='col-sm-12' style='border-bottom: 1px solid lightgrey;padding-bottom: 18px;'>";
    $html .= "Start of towers" . "<br/>";
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

    $condition = strtolower($condition);

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
    $html .= buildTower($diskCount, $towerColumns['a']);
    $html .= buildTower($diskCount, $towerColumns['b']);
    $html .= buildTower($diskCount, $towerColumns['c']);
    $html .= "</div>";

    return $html;
}

function buildTower($totalDisks, $column)
{
    $height = 25 * $totalDisks;

    $html = "<div class='col-sm-4 panel-body center' style='height: {$height}px'>";

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

function simpleTowerOfHanoi($diskCount, $a = 'A', $b = 'B', $c = 'C')
{
    if ($diskCount == 1) {
        echo " Move disk from " . "<span style='color: red'>" . $a . "</span>" . " to " . "<span style='color: blue'>" . $c . "</span>" . "<br/>";

    } else {
        simpleTowerOfHanoi($diskCount - 1, $a, $c, $b);
        simpleTowerOfHanoi(1, $a, $b, $c);
        simpleTowerOfHanoi($diskCount - 1, $b, $a, $c);
    }
}