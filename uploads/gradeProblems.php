<?php $dir = "../"; include($dir . "header.php"); ?>
<link rel="stylesheet" href="../css/table.css">
<h1>Grading</h1>
<table>
  <th>Team</th><th>Status</th><th>Problem Number</th><th>Output</th><th>Supossed</th><th>Grade</th>
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
$sql = "SELECT * FROM submissions WHERE status='wait'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  echo "<tr>";
   echo "<td>".$row['team']."</td>";
   echo "<td>".$row['status']."</td>";
   echo "<td>".$row['number']."</td>";
   chdir("".$row['problem_id']);
   if($row['output']==null){
     $output = shell_exec("java Main");
     echo "<td><pre>".($output)."</pre></td>";

     $sql1 = "UPDATE submissions SET output='".$output."' WHERE problem_id = '".$row['problem_id']."';";

     $result1 = $conn->query($sql1);

   }
   else{
     echo "<td><pre>".$row['output']."</pre></td>";
   }
   chdir("../");
   // print out supposed output, getting from database;
   echo "<td>Haha</td>";
   //pass or fail
   echo "<td>
     <a href = '?pass=\"".$row['problem_id']."\"'><button>Pass</button></a>
     <a href = '?fail=\"".$row['problem_id']."\"'><button>Fail</button></a>
   </td>";
   echo "</tr>";

}

$conn->close();


 ?>
</table>


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
    $conn->close();
    header("Location: gradeProblems.php");
  }
  else if(isset($_GET['fail'])){
    $probID = $_GET['fail'];

    $sql1 = "UPDATE submissions SET status='fail' WHERE problem_id = ".$probID.";";
    echo $sql1;
    $result1 = $conn->query($sql1);
    $conn->close();
    header("Location: gradeProblems.php");
  }

  $conn->close();
?>
