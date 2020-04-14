<?php
// Initialize the session
session_start();

if(isset($_GET["loggedin"])) {
  $loggedin = true;
}

if(isset($_GET["sort"])) { 
  $sort = $_GET["sort"];
}

if(isset($_GET["job"])) { 
  $job = $_GET["job"];
  require_once 'assets/php/jobDetail.php';
} else {
  require_once 'assets/php/jobs.php';
}

require_once 'assets/php/time_elapsed.php'

?>
<html >
<head>
  <meta charset="UTF-8">
  <title>RI₵O</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Droid+Sans'>
  <script src="https://kit.fontawesome.com/7d71860d85.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/main.css">
</head>

<!-- JOB BOARD -->

<?php if(!isset($_GET["job"])) : ?>
<body>

  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <a style="color:red;" href="?login"><i class="fas fa-sign-in-alt"></i></a>
  </div>

  <div class="entries">
  <?php $i = 1; foreach($tableArray as $row) {?>
      <div class="entry">
        <a href="?job=<?php echo $row['crimeUuid'] ?>">
        <div class="title big <?php if($row['sponsoredJob'] == 1) { echo "talon"; } if($row['sponsoredJob'] == 2) { echo "gnome"; } ?>"><?php if($row['sponsoredJob'] == 1) : ?><img class="image-talon" width="15%" src="assets/img/talon.png"/><?php endif; ?><?php if($row['sponsoredJob'] == 2) : ?><img class="image-talon" width="15%" src="assets/img/gnome.png"/><?php endif; ?><?php echo $row['crime'] ?></div>
        <div class="body">
          <p><?php echo time_elapsed_string($row['crimeTime']) ?></strong></p>
        </div>
        </a>
      </div>
  <?php } ?>
  </div>

<script src="assets/js/index.js"></script>

</body>
<?php endif; ?>

<!-- JOB DETAILS -->

<?php if(isset($job)) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="window.location.href = 'https://nopixel.online/rico/test/index.php';">
    <!-- <div class="styled-select slate">
        <select onchange="window.location=this.value">
            <option value="" disabled selected>Sort</option>
            <option value="?sort=time">Time</option>
            <option value="?sort=value">Value</option>
            <option value="?sort=rep">Seller Rep</option>
        </select>
    </div>
    <input type="text" name="search" placeholder="Search.."> -->
  </div>
  <?php $i = 1; foreach($tableArray as $row) {?>
    <?php if ($row["sellerUuid"] == $row["sellerUuid"]) : ?>
      <section class="jobDetails">
        <h1 class="center"><?php echo $row['crime'] ?></h1>
        <h4 class="center">Posted: <?php echo time_elapsed_string($row['crimeTime']) ?></h4> 
        <p>Job UUID: <?php echo $row['crimeUuid'] ?></p> 
        <p>Job Description: <?php echo $row['crimeDescription'] ?></p> 
        <p>Worker Limit: <?php echo $row['workerLimit'] ?></p>
        <p>Current Claims: <?php echo $row['workerClaims'] ?></p> 
        <p>Payment Type: <?php echo $row['paymentType'] ?></p> 
        <p>Payment Amount: <?php echo $row['paymentAmount'] ?></p> 
      </section>
    <?php endif; ?>
  <?php } ?>
<script src="assets/js/index.js"></script>
</body>
<?php endif; ?>

</html>
