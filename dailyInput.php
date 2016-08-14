<?php
$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

$bloodGlucose = $_POST["bloodGlucose"];
$date = $_POST["date"];
$SbloodPressure = $_POST["SbloodPressure"];
$DbloodPressure = $_POST["DbloodPressure"];
$excercise = $_POST["excercise"];
$steps = $_POST["steps"];
$weight = $_POST["weight"];
$notes = $_POST["notes"];

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

$sql = "INSERT INTO dailyTracking (user_Id, currentDate, bloodGlucose, SbloodPressure, DbloodPressure, excercise, steps, weight, notes)
VALUES ($UserId, '$date', '$bloodGlucose', $SbloodPressure, $DbloodPressure, '$excercise', '$steps', '$weight', '$notes')";

if ($conn->query($sql) === TRUE) {
	// echo $sql;
    header('Location:dailyTracking.html'); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>