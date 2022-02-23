<?php

$output = getMember($_GET['id']);

echo("This is the member activity page for: " . $output[1] . " " . $output[2] . " " . $output[0]);





$passingMbrInfo = [$output[1], $output[2], $output[0]]; //Creates the array to pass the correct info to function

$userHistory = mbrHistory($passingMbrInfo);           //Takes function result and stores it as a 2d array 
?>
<table>
    <?php
foreach($userHistory as $uHis){                         //Iterate through the 2d array. First value of each is the First Name, Middle Name is second, Last is thrid, checkin time 4th, and checkout 5th
    ?>
    <th>Date </th>
    <tr><td>
    <?php
    echo(date("m/d/Y",$uHis[3]));
    ?>
    </td></tr>
    <tr>
        <td style="margin:5px; padding:15px" colspan="2">Time in: <?php echo(date("h:i:sa", $uHis[3])); ?> 
        </td>
        
        <td colspan="2">Time out: <?php echo(date("h:i:sa", $uHis[4])); ?>
        </td>
    </tr>
    <tr>
        <td style="margin:5px; padding:15px" colspan="2"> Total Time this visit: <?php 
            $diff = $uHis[4] - $uHis[3];
            $diff = $diff / 60;
            $diff = (int)$diff;
            echo($diff . " minutes");
        ?>
        </td>
    </tr>
    <?php
}
?>