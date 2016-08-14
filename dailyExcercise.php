<?php

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "asdfg123";
$dbname = "dbtest";

session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['user']))
      $UserId = $_SESSION['user'];

$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    
    $result = mysqli_query($con, "SELECT currentDate, excercise FROM dailyTracking where user_id = $UserId ORDER BY currentDate asc");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['currentDate'] , "y" => $row['excercise']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>