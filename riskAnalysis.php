<?php
$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

$bmi = $_POST["BMI"];
$bloodPressure = $_POST["BloodPressure"];
$excercise = $_POST["Excercise"];
$smoking = $_POST["Smoking"];

$finalValue = "{$bmi}{$excercise}{$bloodPressure}{$smoking}";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "select * from diseaseprobability where Levels = $finalValue";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
        $diabities = $row["Diabities"];
        $attack = $row["Heart Attack"];
    }
} else {
    echo "0 results";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->

    <title>Risk Predictor</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
</head>
<body>
  <div id="includedContent"></div>
    <div class="container">
      <h2>Health table</h2>
      <p>Follow the following conventions when filling out the form:</p>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Type</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>BMI</td>
            <td>Under weight</td>
            <td>Normal</td>
            <td>Over Weight</td>
            <td>Obese</td>
          </tr>
          <tr>
            <td>Blood Pressure</td>
            <td>Yes</td>
            <td>while Pregnant</td>
            <td>No</td>
            <td>Pre-Hypertension</td>
          </tr>
          <tr>
            <td>Excercise</td>
            <td>Yes</td>
            <td>No</td>
            <td> - </td>
            <td> - </td>
          </tr>
           <tr>
            <td>Smoke</td>
            <td>Yes</td>
            <td>No</td>
            <td> - </td>
            <td> - </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="container">
      <p> <b> Your Selection: </b></p>
      <ul>
      	<li> <b>BMI: </b><?php echo $bmi?> </li>
      	<li> <b>Excercise: </b><?php echo $excercise?> </li>
      	<li> <b>Blood Pressure: </b><?php echo $bloodPressure?> </li>
      	<li> <b>Smoking: </b><?php echo $smoking?> </li>
      </ul>
      <b>Result: </b>You have <?php echo $diabities; ?>% changes of getting diabeties and <?php echo $attack ?>% chances of getting a heart disease.
      <p><?php if ($diabities > 30) {echo "<p>"; echo"<b>"; echo "Conclusion: "; echo"</b>"; echo "You are prone to diabetes."; echo "</p>"; 
        echo "<b>";
        echo "Symtoms: ";
        echo "</b>";
        echo "<ul>";
        echo "<li>";
        echo "Urinating often";
        echo "</li>";
        echo "<li>";
		echo "Feeling very thirsty";
		echo "</li>";
		echo "<li>";
		echo "Feeling very hungry - even though you are eating";
		echo "</li>";
		echo "<li>";
		echo "Extreme fatigue";
		echo "</li>";
		echo "<li>";
		echo "Blurry vision";
		echo "</li>";
		echo "<li>";
		echo "Cuts/bruises that are slow to heal";
		echo "</li>";
		echo "<li>";
		echo "Weight loss - even though you are eating more (type 1)";
		echo "</li>";
		echo "<li>";
		echo "Tingling, pain, or numbness in the hands/feet (type 2)";
		echo "</li>";
		echo "</ul>";
		echo "<p>";
		echo "<b>";
		echo "Recomendations: ";
		echo "</b>";
		echo "</p>";
		echo "<ul>";
		echo "<li>";
		echo "Move More.";
		echo "</li>";
		echo "<li>";
		echo "Lower your weight.";
		echo "</li>";
		echo "<li>";
		echo "See your Doctor more often.";
		echo "</li>";
		echo "<li>";
		echo "Eat Better.";
		echo "</li>";
		echo "<li>";
		echo "Make sleep a priority.";
		echo "</li>";
		echo "<li>";
		echo "Choose and Commit.";
		echo "</li>";
		echo "</ul>";
		echo "</p>";}
		?>
	</p>
	<p><?php if ($attack > 30) {echo "<p>"; echo"<b>"; echo "Conclusion: "; echo"</b>"; echo "You are prone to Heart Diseases."; echo "</p>"; 
        echo "<b>";
        echo "Symtoms: ";
        echo "</b>";
        echo "<ul>";
        echo "<li>";
        echo "Shortness of breath";
        echo "</li>";
        echo "<li>";
		echo "Palpitations (irregular heart beats, or a \"flip-flop\" feeling in your chest)";
		echo "</li>";
		echo "<li>";
		echo "Feeling very hungry - even though you are eating";
		echo "</li>";
		echo "<li>";
		echo "A faster heartbeat";
		echo "</li>";
		echo "<li>";
		echo "Weakness or dizziness";
		echo "</li>";
		echo "<li>";
		echo "Nausea";
		echo "</li>";
		echo "<li>";
		echo "Sweating";
		echo "</li>";
		echo "</ul>";
		echo "<p>";
		echo "<b>";
		echo "Recomendations: ";
		echo "</b>";
		echo "</p>";
		echo "<ul>";
		echo "<li>";
		echo "Know your blood pressure and keep it under control.";
		echo "</li>";
		echo "<li>";
		echo "Exercise regularly.";
		echo "</li>";
		echo "<li>";
		echo "Get tested for diabetes and if you have it, keep it under control.";
		echo "</li>";
		echo "<li>";
		echo "Know your cholesterol and triglyceride levels and keep them under control.";
		echo "</li>";
		echo "<li>";
		echo "Eat a lot of fruits and vegetables.";
		echo "</li>";
		echo "<li>";
		echo "Maintain a healthy weight.";
		echo "</li>";
		echo "</ul>";
		echo "</p>";}
		?>
	</p>
	<a href="dailyTracking.html"> Track your Daily Goals here to stay fit and active. </a>
    </div>
    <div id="footer"></div> 
  </body>
</html>
