<?php $dir = "../"; include($dir . "header.php"); ?>
<script type="text/javascript">

  $(document).ready(function()
  {
      $.ajaxSetup(
      {
          cache: false,
          beforeSend: function() {
              //$('#content').hide();
          },
          complete: function() {
              //$('#content').show();
          },
          success: function() {
              //$('#content').show();
          }
      });
      var $container = $("#content");
      $container.load("getGrading.php");
      var refreshId = setInterval(function()
      {
          $container.load('getGrading.php');
      }, 5000);
  });
</script>

<link rel="stylesheet" href="../css/table.css">
<h1>Grading</h1>
<div id = "content">

</div>

<?php

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "cscomp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  if(isset($_GET['pass'])){
    $probID = $_GET['pass'];

    $sql1 = "UPDATE submissions SET status='pass' WHERE problem_id = ".$probID.";";

    $result1 = $conn->query($sql1);

    $sql2 = "SELECT * FROM submissions WHERE problem_id = ".$probID.";";

    $result2 = $conn->query($sql2);
    while($row = $result2->fetch_assoc()){
      $sql3 = "UPDATE teams SET problemsRight=problemsRight + 1 WHERE username = '".$row['team']."';";
      $result3 = $conn->query($sql3);

      $points=60;
      $sql4 = "SELECT * FROM submissions WHERE team = '".$row['team']."' AND status='fail' AND number = '".$row['number']."';";
      echo $sql4;
      $result4 = $conn->query($sql4);
      while($row1 = $result4->fetch_assoc()){
          $points -= 5;
      }
      $sql3 = "UPDATE teams SET points=points + ".$points." WHERE username = '".$row['team']."';";
      $result3 = $conn->query($sql3);
    }



    $conn->close();
    header("Location: gradeProblems.php");

  }
  else if(isset($_GET['fail'])){
    $probID = $_GET['fail'];

    $sql1 = "UPDATE submissions SET status='fail' WHERE problem_id = ".$probID.";";
    echo $sql1;
    $result1 = $conn->query($sql1);


    $sql2 = "SELECT * FROM submissions WHERE problem_id = ".$probID.";";

    $result2 = $conn->query($sql2);
    while($row = $result2->fetch_assoc()){

      $sql3 = "UPDATE teams SET problemsWrong=problemsWrong + 1 WHERE username = '".$row['team']."';";
      $result3 = $conn->query($sql3);

      // $sql3 = "UPDATE teams SET points=points - 5 WHERE username = '".$row['team']."';";
      // $result3 = $conn->query($sql3);
    }


    $conn->close();
    header("Location: gradeProblems.php");
  }

  $conn->close();
?>
