<?php


//Declare Variables

$gridSmall = readFromFile("data_small.txt");
$numbOfSmallShape = connectedShapes($gridSmall);
echo "Num of connected shapes in small grid: $numbOfSmallShape\n";

$gridLarge = readFromFile("data_large.txt");
$numOfLargeShape = connectedShapes($gridLarge);
echo "Num of connected shapes in large grid: $numOfLargeShape\n";

// $filePath = "data_large.txt"; 
// $grid = readFromFile($filePath);
// $numOfShapes = connectedShapes($grid);


function readFromFile($filePath) {
    $grid = [];
    $myfile = fopen("$filePath", "r");

    if ($myfile) {
        while (($row = fgets($myfile)) !== false) {
            $grid[] = str_split(trim($row));
            //$grid[] = fgetc($row);
        }
        fclose($myfile);
    } else {
        echo "Error reading the file!";
    }
    //var_dump ($grid);
    return $grid;
}

function selectItem(&$grid, $n, $m, &$selected) {
    $positions = [
        [-1, 0], [1, 0], [0, -1], [0, 1]
    ];

        if ($selected["$n,$m"] ==true)
        return;

    $selected["$n,$m"] = true;

    foreach ($positions as $position) {
        $positionN = $n + $position[0];
        $positionM = $m + $position[1];
        echo "$positionN, ".count($selected)." <br>";
        echo "$positionM, ".count($selected)." <br>";
        if (
            $positionN  >= 0 &&  $positionN  < count($grid) &&
            $positionM  >= 0 &&  $positionM < count($grid[0]) &&
            $grid[ $positionN ][ $positionM] == '1' &&
            !isset($selected[" $positionN , $positionM"])
        ) {
            selectItem($grid,  $positionN , $positionM, $selected);
        }
    }
    return $selected;
}

function connectedShapes($grid) {
    $selected = [];
    $countShape = 0;

    for ($i = 0; $i < count($grid); $i++) {
        for ($j = 0; $j < count($grid[0]); $j++) {
            //echo " [$i $j] = " . ($grid[$i][$j])." ";
            if ($grid[$i][$j] == '1' && !isset($selected["$i,$j"])) {
                selectItem($grid, $i, $j, $selected);
                $countShape++;
            }
        }
        echo "<br>";
    }

    return $countShape;
}

// echo "Num of connected shapes: $numOfShapes\n";
// echo "Num of connected shapes: $numOfSmallShape\n";
// echo "Num of connected shapes: $numOfLargeShape\n";

