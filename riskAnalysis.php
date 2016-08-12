<html>
<body>
<?php
   //Start your session
   session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['user']))
      echo $_SESSION['user'];
?>
Your BMI: <?php echo $_POST["BMI"]; ?><br>
Your Blood Pressure: <?php echo $_POST["BloodPressure"]; ?><br>
Your Excercise: <?php echo $_POST["Excercise"]; ?><br>
Your Smoking: <?php echo $_POST["Smoking"]; ?><br>

</body>
</html>