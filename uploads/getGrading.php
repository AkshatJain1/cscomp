<table>
  <th>Team</th><th>Status</th><th>Problem Number</th><th>Output</th><th>Correct Output</th><th>Grade</th>
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
     if($row['number']<10){
       $compile = shell_exec('"C:\Program Files\Java\jdk1.8.0_144\bin\javac" prob0'.$row['number'].'.java 2>&1');
       $output = shell_exec("java prob0".$row['number']." 2>&1");
     }else{
       $output = shell_exec("java -cp prob".$row['number']);
     }
     echo "<td><pre>".($output)."</pre></td>";

     $sql1 = "UPDATE submissions SET output='".$output."' WHERE problem_id = '".$row['problem_id']."';";

     $result1 = $conn->query($sql1);


   }
   else{
     echo "<td><pre>".$row['output']."</pre></td>";
   }
   chdir("../");
   // print out supposed output, getting from solution text files;
   $sol = "";

   if($row['number']<10){
      $fh = fopen('solutions/prob0'.$row['number'].'-out.txt','r');
   }
   else{
     $fh = fopen('solutions/prob'.$row['number'].'-out.txt','r');
   }
   while ($line = fgets($fh)) {
    $sol.=$line."";
   }
   fclose($fh);

   echo "<td><pre>".$sol."</pre></td>";

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
