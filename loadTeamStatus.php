<?php

// redirecting to login page if not logged in
session_start();
if(!isset($_SESSION['username'])){
   ob_start();
   header('Location: '.'login.php');
   ob_end_flush();
   die();
}
 ?>
 <table ><caption style="margin-bottom: 20px"><strong>Submissions<strong></caption>
   <tr><th>Name</th><th>Status</th><th>Submission Output</th></tr>

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


  //find level of team

    $sql = "SELECT * FROM submissions WHERE team='".$_SESSION['username']."';";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
      // TODO: output problem name instead of number
      $sql1 = "SELECT * FROM problems WHERE number='".$row['number']."';";
      $result1 = $conn->query($sql1);
      while($row1 = $result1->fetch_assoc()){
        echo "<tr><td>".$row1['name']."</td>";
      }
      echo "<td>".$row['status']."</td>";
      if ($row["status"] != "wait") {
        if (strpos($row['output'], 'Exception') !== false) {
          echo "<td>".$row['output']."</td></tr>";
        }
        else {
          if ($row["status"] == "pass") {
            echo "<td>Passed!</td></tr>";
          }
          else {
            echo "<td>Logic/Compile Error</td></tr>";
          }
        }
      }
      else{
        echo "<td>Pending</td></tr>";
      }
    }


 ?>
</table>
