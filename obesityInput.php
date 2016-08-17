<?php
$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

$currentWeight = $_POST["CurrentWeight"];
$desiredWeight = $_POST["DesiredWeight"];
$SDWeight = $_POST["SDWeight"];
$EDWeight = $_POST["EDWeight"];

$currentBMI = $_POST["CurrentBMI"];
$desiredBMI = $_POST["DesiredBMI"];
$SDBmi = $_POST["SDBmi"];
$EDBmi = $_POST["EDBmi"];

$currentWaist = $_POST["CurrentWaist"];
$desiredWaist = $_POST["DesiredWaist"];
$SDWaist = $_POST["SDWaist"];
$EDWaist = $_POST["EDWaist"];

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

$sql = "INSERT INTO obesity (userId, CurrentWeight, DesiredWeight,SDweight, EDweight, CurrentBMI, DesiredBMI, SDBmi, EDBmi, CurrentWaist, DesiredWaist, SDWaist, EDWaist)
VALUES ($UserId, $currentWeight, $desiredWeight, '$SDWeight', '$EDWeight', $currentBMI, $desiredBMI, '$SDBmi', '$EDBmi', $currentWaist, $desiredWaist,'$SDWaist', '$EDWaist')";

if ($conn->query($sql) === TRUE) {
    header('Location:obesity.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>