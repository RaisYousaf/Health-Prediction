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

    <title>Symptom Tracker</title>

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
      <h2>Symptoms</h2>
      <p>Currently Tracked Symptoms</p>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Related Condition</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
           <?php
              $servername = "localhost";
              $username = "root";
              $password = "asdfg123";
              $dbname = "dbtest";

              session_start();
             //Read your session (if it is set)
              if (isset($_SESSION['user']))
                $UserId = $_SESSION['user'];

              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              } 

              $sql = "SELECT * from symptoms where user_Id = $UserId ORDER BY startDate asc";

              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  // output data of each row

                  while($row = $result->fetch_assoc()) {
                      //echo "Diabetes: " . $row["Diabities"]. " - Heart Attack: " . $row["Heart Attack"];
                      // $diabities = $row["Diabities"];
                      // $attack = $row["Heart Attack"];
                    $eDate = "-";
                    if($row["endDate"]!== "0000-00-00"){
                      $eDate = $row["endDate"];
                    }
                    echo '<tr>
                            <td>'.$row["type"].'</td>
                            <td>'.$row["startDate"].'</td>
                            <td>'.$eDate.'</td>
                            <td>'.$row["relatedCondition"].'</td>
                            <td>'.$row["description"].'</td>
                          </tr>';
                  }
              } else {
                  echo "0 results";
              }

              $conn->close();
          ?>
        </tbody>
      </table>
    </div>
    <div id="footer"></div> 
  </body>
</html>