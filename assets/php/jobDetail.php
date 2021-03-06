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
while ($row = mysqli_fetch_array($result))
{
     $crime = $row['crime'];
     $crimeUuid = $row['crimeUuid'];
     $crimeDescription = $row['crimeDescription'];
     $crimeUrl = $row['crimeUrl'];
     $crimeLimit = $row['workerLimit'];
     $crimeSponsored = $row['sponsoredJob'];
     $crimeTime = date('M d h:i A',strtotime($row['crimeTime']));
     $paymentType = $row['paymentType'];
	 $paymentAmount = $row['paymentAmount'];
     $sellerUuid = $row['sellerUuid'];
}

if(isset($job) || isset($jobClaim)) {
    $query2 = "SELECT * FROM crimeClaims WHERE crimeUuid = '$job'";
    $result = mysqli_query($link, $query2) or die(mysqli_error($link));
    $crimeClaims = 0;
    $counter = 1;
    while ($row = mysqli_fetch_array($result))
    {
        $crimeClaims = $counter;
        $counter++;
    }

    $query3 = "SELECT * FROM crimeClaims WHERE crimeUuid = '$job'";
    $result = mysqli_query($link, $query3) or die(mysqli_error($link));
    $tableArray = array();
    $counter = 0;
    while ($row = mysqli_fetch_array($result))
    {
        $tableArray[$counter]['crimeUuid'] = $row['crimeUuid'];
        $tableArray[$counter]['workerUuid'] = $row['workerUuid'];
        $tableArray[$counter]['workerIdentifier'] = $row['workerIdentifier'];
        $tableArray[$counter]['crimeCompleted'] = $row['crimeCompleted'];
        $tableArray[$counter]['crimeProof'] = $row['crimeProof'];
        $tableArray[$counter]['claimTime'] = $row['claimTime'];
        $tableArray[$counter]['workerPaypal'] = $row['workerPaypal'];
        $counter++;
    }
}

//Close Connection
mysqli_close($link);
?>