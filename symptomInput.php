<?php
$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

$symptomType = $_POST["symptom"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$relatedCondition = $_POST["condition"];
$description = $_POST["description"];

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

$sql = "INSERT INTO symptoms (user_Id, type, startDate,endDate, relatedCondition, description)
VALUES ($UserId, '$symptomType', '$startDate', '$endDate', '$relatedCondition','$description')";

echo $sql;
if ($conn->query($sql) === TRUE) {
    header('Location:symptomTracker.php'); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>