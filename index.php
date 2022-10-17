<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }

        table{
            border:2px solid black;
            border-collapse:collapse;
            width:40%;
            font-size:1.2em;
        }

        tr td{
            border-bottom:2px solid black;
            width:15%;
        }
        .week{
            font-weight:bold;
            color:green;
        }
    </style>    
</head>
<body>

<a href="?date=">Previous Month</a>
<a href="?date=">Next Month</a>


<?php
// $date=$_GET['date'];
// if($date){
//     $date=$_GET['date'];
// }
// else{
//     $date = date("Y-m-d");
// }
include('namnsdag.php');
$date=$_GET['date'];
($date) ? $date=$_GET['date'] : $date = date("Y-m-d");
$timestamp = strtotime($date);
$month = date("m", $timestamp);
$year = date('Y', $timestamp);
$numberofdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
echo '<table>';
for($i=1;$i<=$numberofdays;$i++)
{
    $dateloop = date($year.'-'.$month.'-'.$i);
    $datelooptimestmp = strtotime($dateloop);
    $day = date('l',$datelooptimestmp);
    $week = date('W',$datelooptimestmp);
    $dayofyear = date('z',$datelooptimestmp)+1;
    $namnsdag = implode(" ",$namn[$dayofyear-1]);

    if ($day == "Monday")
    {
        echo '<td>'.$day.'</td>';
        echo '<td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td><td class="week">'.$week.'</td>';
    }
    else if ($day == "Sunday")
    {
        echo '<td style="color:red;">'.$day.'</td><td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td>';
    }
    else
    {
        echo'<tr><td>'.$day.'</td><td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>
</body>
</html>