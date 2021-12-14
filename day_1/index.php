<?php

function convertInputToUsefulArray(string $filename): array
{
    $results = file_get_contents($filename);
    $usefulList = explode("\n", $results);
    return $usefulList;
}

function getInstancesOfDepthIncrease(array $depths): int
{
    $counter = 0;
    $previousDepth = 0;

    for ($i = 0; $i < sizeof($depths); $i++)
    {
        //If first entry in array set previous depth and continue to next loop
        if ($i === 0)
        {
            $previousDepth = $depths[$i];
            continue;
        }

        //General processing, if depth greater than previous depth increment counter
        if ($previousDepth < $depths[$i])
        {
            $counter++;
        }

        //Set new previous depth for next loop
        $previousDepth = $depths[$i];
    }

    return $counter;
}

function createThreeWayAdditionArray(array $data): array
{
    $sumArray = [];
    $counter = 0;
    $scratchSum = 0;

    for($i = 0; $i < sizeof($data); $i++)
    {
        //echo "For loop start counter {$counter}, i value is {$data[$i]} <br>";
        if ((sizeof($data) - $i) >= 3)
        {
            if ($counter !== 3)
            {
                $scratchSum += $data[$i];
                $counter++;
                //echo "If counter less than 3: {$scratchSum} , {$counter} <br>";
            }
            
            if ($counter === 3)
            {
                $sumArray[] = $scratchSum;
                $counter = 0;
                $scratchSum = 0;
                //echo "Third iteration marker: <br>";
                //echo "<pre>";
                //print_r($sumArray);
                //echo "</pre>";
            }
        }

        //echo "end of for loop processing <br>";
    }

    return $sumArray;
}

function trioSumGenerator(array $data):array
{
    $sumArray = [];

    //@todo split array into an array of groups of three sums
    for($i = 0; $i < sizeof($data); $i++)
    {
        $temp = (sizeof($data)-1) - $i;
        //echo "i value is: {$i} | " . $temp . "<br>";
        if((int)$temp >= 3)
        {
            $v1 = $i;
            $v2 = $i + 1;
            $v3 = $i + 2;
            $scratchAdd = 0;

            $scratchAdd += $data[$v1];
            $scratchAdd += $data[$v2];
            $scratchAdd += $data[$v3];

            $sumArray[] = $scratchAdd;
        }
        else
        {
            break;
        }
    }

    return $sumArray;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AOC21 - Day 1</title>
</head>
<body>
    <h1>AOC Day 1</h1>

    <h2>Part 1</h2>

    <?php

        //Get useful data to process
        $data = convertInputToUsefulArray("input.txt");
        
        //Process data to find times depth increased
        $counter = getInstancesOfDepthIncrease($data);

        echo "<br>The number of times the depth increased is: {$counter}<br>";
        
    ?>

    <h2>Part 2</h2>

    <?php
        //Generate three way sum array from original data
        //$threeWayArray = createThreeWayAdditionArray($data);
        $threeWayArray = trioSumGenerator($data);

        //Obtain integer of increases in depth
        $result = getInstancesOfDepthIncrease($threeWayArray);

        echo "<br>The number of times the depth has increased from the three way sum analysis is: {$result}<br>";

    ?>

    <br>
    <br>
    <a href="../index.php">Home</a>
</body>
</html>