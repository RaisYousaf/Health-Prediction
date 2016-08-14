<?php
$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

$weight = $_POST["CurrentWeight"];
$date = $_POST["date"];
$bmi = $_POST["bmi"];
$waist = $_POST["waist"];

//Start your session
   session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['user']))
      $UserId = $_SESSION['user'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$checkSql = "SELECT * from currentWeight where userId = $UserId";


$result = $conn->query($checkSql);
if ($result->num_rows > 0) {
    // output data of each row
    $sql = "UPDATE currentWeight SET weight=$weight, bmi=$bmi, currentDate='$date', waist=$waist WHERE userId = $UserId";
    if ($conn->query($sql) === TRUE) {
	   	$weightSql = "SELECT * from obesity where userId =$UserId";
	   	$weightResult = $conn->query($weightSql);
	   	if ($weightResult->num_rows > 0) {
	   		while($row = $weightResult->fetch_assoc()) {
		        $desiredWeight = $row["CurrentWeight"] - $row["DesiredWeight"];
		        $edWeight = $row["EDweight"];
		        $desiredBMI = $row["CurrentBMI"] - $row["DesiredBMI"];
		        $edBMI = $row["EDBmi"];
		        $desiredWaist = $row["CurrentWaist"] - $row["DesiredWaist"];
		        $edWaist = $row["EDWaist"];
		        $percentageWeight = (($row["CurrentWeight"] - $weight)/$desiredWeight) * 100;
		        $percentageBmi = (($row["CurrentBMI"] - $bmi)/$desiredBMI) * 100;
		        $percentageWaist = (($row["CurrentWaist"] - $waist)/$desiredWaist) * 100;
    		}
	   	}
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
} else {
    $sql = "INSERT INTO currentWeight (userId, weight, bmi, currentDate, waist)VALUES ($UserId, $weight, $bmi,'$date','$waist')";
    if ($conn->query($sql) === TRUE) {
   	$weightSql = "SELECT * from obesity where userId =$UserId";
   	$weightResult = $conn->query($weightSql);
   	if ($weightResult->num_rows > 0) {
   		while($row = $weightResult->fetch_assoc()) {
	        $desiredWeight = $row["CurrentWeight"] - $row["DesiredWeight"];
	        $edWeight = $row["EDweight"];
	        $desiredBMI = $row["CurrentBMI"] - $row["DesiredBMI"];
	        $edBMI = $row["EDBmi"];
	        $desiredWaist = $row["CurrentWaist"] - $row["DesiredWaist"];
	        $edWaist = $row["EDWaist"];
	        $percentageWeight = (($row["CurrentWeight"] - $weight)/$desiredWeight) * 100;
	        $percentageBmi = (($row["CurrentBMI"] - $bmi)/$desiredBMI) * 100;
	        $percentageWaist = (($row["CurrentWaist"] - $waist)/$desiredWaist) * 100;
		}
   	}
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title>Obesity</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
		function goBack() {
		    window.history.back();
		}
	</script>
     <script> 
    $(function(){
      $("#includedContent").load("carousel.html"); 
      $("#footer").load("footer.html"); 
    });
    </script>
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
</head>
<body>
	<div id="includedContent"></div>
		<div class="container">
			<div class="row">
		    	<h2> Weight Tracking </h2>
		    	<div class="progress">
			    	<div class="progress-bar progress-bar-striped active" role="progressbar"aria-valuenow="<?php echo round($percentageWeight); ?>" 
			    	aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($percentageWeight); ?>%;">
			      		<?php echo round($percentageWeight); ?>%
			    	</div>
		  		</div> 
		  	</div>
		  	<div class="row">
		  		<h2> BMI Tracking </h2>
		  		<div class="progress">
				    <div class="progress-bar progress-bar-striped active" role="progressbar"aria-valuenow="<?php echo round($percentageBmi); ?>" 
				    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($percentageBmi); ?>%;">
				      <?php echo round($percentageBmi); ?>%
				    </div>
		  		</div>
		  	</div>
		  	<div class="row">
		  		<h2> Waist Tracking </h2>
		 		<div class="progress">
				  <div class="progress-bar progress-bar-striped active" role="progressbar"aria-valuenow="<?php echo round($percentageWaist); ?>" 
				  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($percentageWaist); ?>%;">
				    <?php echo round($percentageWaist); ?>%
				  </div>
		  		</div>
		  	</div>
		</div>
		<div class="form-group">
              <label class="col-md-6 control-label" for="singlebutton"></label>
              <div class="col-md-3">
                <button id="singlebutton" name="singlebutton" class="btn btn-primary" onclick="goBack()">Go Back</button>
              </div>
            </div>
		<div id="footer"></div> 
	</body>
</html>
