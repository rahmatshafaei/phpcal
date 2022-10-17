<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>calender</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                background: url("https://c.tadst.com/gfx/1200x630/four-seasons.jpg?1") no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                color: black;
                text-align: center;
            }

            table {
                border: 2px solid black;
                border-collapse: collapse;
                width: 40%;
                font-size: 1.2em;
            }

            tr td {
                border-bottom: 2px solid black;
                width: 15%;
            }
            .week {
                font-weight: bold;
                color: green;
            }
            table {
                overflow: auto;
                margin: auto;
                position: absolute;
                top: 80px;
                left: 0;
                bottom: 0;
                right: 0;
                font-size: 15px;
                border: solid black 1px;
                padding: 10px;
                width: 50%;
                height: 50%;
                text-align: center !important;
                font-weight: bold;
                opacity: 90%;
                background-color: white;

            }
            td {
                margin-top: 5%;
                border: solid black 2px;
                text-align: left !important;
                font-size: 1em;
                text-align: center !important;

            }
            h4 {
                color: black;
                float: left;
                margin-left: 18%;
                font-weight: bold;
                border-radius: 12px;
                background-color: white;
                opacity: 90%;
                padding: 20px;
                border: solid black 2px;

            }
            a {
                text-decoration: none;
            }
            caption{
                color: white;
                text-align:left;
            }
        </style>
    </head>
    <body>

    <?php
// $date=$_GET['date'];
// if($date){
//     $date=$_GET['date'];
// }
// else{
//     $date = date("Y-m-d");
// }
include('namnsdag.php');
$date=$_GET["date"] ?? date("Y-m-d");
//($date) ? $date=$_GET["date"] : $date = date("Y-m-d");
$timestamp = strtotime($date);
$month = date("m", $timestamp);
$month2 = date("n", $timestamp);
$year = date('Y', $timestamp);
$numberofdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
echo '<table>
<caption>'.$date.'</caption>';
for($i=1;$i<=$numberofdays;$i++)
{
    $dateloop = date($year.'-'.$month.'-'.$i);
    $datelooptimestmp = strtotime($dateloop);
    $day = date('l',$datelooptimestmp);
    $week = date('W',$datelooptimestmp);
    $dayofyear = date('z',$datelooptimestmp)+1;
    $namnsdag = implode(" ",$namn[$dayofyear-1]);


    if($i <10)
    {
        $Noll = "0$i";
    }
    else if($i >= 10)
    {
        $Noll = $i;
    }


    $file=fopen("birthday.txt", "r");
    if($bdayArr=fgets($file))
            {
            $temp=explode(",", $bdayArr);
            for($x=0;$x < count($temp);$x++)
            {
                $t="$month2-$Noll";
                $temp2=explode(".",$temp[$x]);
                $temp3= substr($temp2[0], 5);
                $bDate=$temp3;
                if($bDate==$t)
                {
                    $bday.="$temp2[1]";
                    break;
                }

                else if($bDate != $t)
                {
                    $bday= "";
                }
            }
            }

    if ($day == "Monday")
    {
        echo '<td>'.$day.'</td>';
        echo '<td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td><td class="week">'.$week. $bday.'</td>';
    }
    else if ($day == "Sunday")
    {
        echo '<td style="color:red;">'.$day.'</td><td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td>'.'<td>'. $bday.'</td>';
    }
    else
    {
        echo'<tr><td>'.$day.'</td><td>'.$i.'</td><td>'.$dayofyear.'</td><td>'.$namnsdag.'</td>'.'<td>'. $bday.'</td>';
    }
    echo '</tr>';
}
echo '</table>';
$str = strtotime($date);
$minusMonth= date("Y-m-d",strtotime("-1 month",$str));
$plusMonth= date("Y-m-d",strtotime("+1 month",$str));

if(isset($_POST["sub"]))
    {

    $file=fopen("birthday.txt", "a+");
    $writeB=",". $_POST["bDay"].".".$_POST["name"];
    fwrite($file, $writeB);

    }
    fclose($file);
?>
        <h4>
            <a href="?date= <?php echo $minusMonth ?>">Previous Month</a>
        </h4>
        <h4>
            <a href="index.php">Reset</a>
        </h4>
        <h4>
            <a href="?date= <?php echo $plusMonth ?>">Next Month</a>
        </h4>
        <form method="POST" action="index.php">
    <br>
        <label for="birthday">Birthday:</label>
    <br>
        <input type="date" name="bDay" id="birthday" required>
    <br>
    <br>
        <label for="namn">Name:</label>
    <br>
        <input type="text" name="name" id="namn" required>
        <input type="submit" name="sub" id="">
</form>
    </body>
</html>