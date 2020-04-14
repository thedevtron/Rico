<?php 
require_once dirname( __FILE__ ) . '/' . "../config/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($job)) {
    $query = "SELECT * FROM crimes WHERE crimeUuid = '$job'";
}

$result = mysqli_query($link, $query) or die(mysqli_error($link));
$counter = 0;
while ($row = mysqli_fetch_array($result))
{
     $tableArray[$counter]['counter'] = $counter;
     $tableArray[$counter]['crime'] = $row['crime'];
     $tableArray[$counter]['crimeUuid'] = $row['crimeUuid'];
     $tableArray[$counter]['crimeDescription'] = $row['crimeDescription'];
     $tableArray[$counter]['workerLimit'] = $row['workerLimit'];
     $tableArray[$counter]['sponsoredJob'] = $row['sponsoredJob'];
     $tableArray[$counter]['paymentType'] = $row['paymentType'];
	 $tableArray[$counter]['paymentAmount'] = $row['paymentAmount'];
     $tableArray[$counter]['crimeTime'] = date('M d h:i A',strtotime($row['crimeTime']));
     $counter++;
}

if(isset($job)) {
    $query2 = "SELECT * FROM crimeClaims WHERE crimeUuid = '$job'";
}

$result = mysqli_query($link, $query2) or die(mysqli_error($link));
$counter = 0;
while ($row = mysqli_fetch_array($result))
{
     $workerClaims = $counter;
     $counter++;
}


//Close Connection
mysqli_close($link);
?>