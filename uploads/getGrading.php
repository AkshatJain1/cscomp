<table>
  <th>Team</th><th>Status</th><th>Problem Number</th><th>Output</th><th>Correct Output</th><th>Grade</th>

  <style media="screen">
  #out {
    background-color: cyan;
  }
  </style>
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
   chdir("submissions/".$row['problem_id']);
   if($row['output']==null){
     $compile = shell_exec('"C:\Program Files\Java\jdk1.8.0_144\bin\javac" '.$row['fileName'].'.java 2>&1');
     $output = mysqli_real_escape_string($conn, shell_exec("java ".$row['fileName']." 2>&1"));

     $sql1 = "UPDATE submissions SET output='".$output."' WHERE problem_id = '".$row['problem_id']."';";

     $result1 = $conn->query($sql1);
   }
   else{
     $arr = explode("\n", $row['output']);
     $maxLen = 0;
     foreach($arr as $val) {
       if(strlen($val) > $maxLen) {
         $maxLen = strlen($val);
       }
     }
     echo '<td><textarea rows="'.(substr_count($row['output'], "\n")).'" cols="'.($maxLen+1).'" style="border:0" placeholder="'.$row['output'].'" readonly></textarea></td>';
   }
   chdir("../../");
   // print out supposed output, getting from solution text files;
   $sol = "";

   $sql1 = "SELECT * FROM problems WHERE number='".$row['number']."';";
   $result1 = $conn->query($sql1);
   $fN = "";
   while($row1 = $result1->fetch_assoc()){
     $fN = $row1['input'];
   }
   $fh = fopen('solutions/'.$fN.'.out','r');

   while ($line = fgets($fh)) {
    $sol.=$line."";
   }
   fclose($fh);

   $arr = explode("\n", $sol);
   $maxLen = 0;
   foreach($arr as $val) {
     if(strlen($val) > $maxLen) {
       $maxLen = strlen($val);
     }
   }
   echo '<td><textarea rows="'.(substr_count($sol, "\n")+1).'" cols="'.$maxLen.'" style="border:0" placeholder="'.$sol.'" readonly></textarea></td>';

   //pass or fail
   echo "<td>
      <div style = 'width:20;height:20;'></div>
     <a href = '?pass=\"".$row['problem_id']."\"'><button>Pass</button></a>
     <a href = '?fail=\"".$row['problem_id']."\"'><button>Fail</button></a>
   </td>";
   echo "</tr>";

}

$conn->close();


 ?>
</table>

<script type="text/javascript">
  var i = 0;
  $("tr").each(function(){
    if(i!=0) {
      var user = ($($(this).find('td:eq(3)').find("textarea:first-child")[0]).attr('placeholder'));
      var sol = ($($(this).find('td:eq(4)').find("textarea:first-child")[0]).attr('placeholder'));

      if(user.trim().valueOf() == sol.trim().valueOf())
        $(this).find('td:eq(5)').find("div:first-child")[0].style.backgroundColor = "green";
      else
        $(this).find('td:eq(5)').find("div:first-child")[0].style.backgroundColor = "red";
    }
    i++;
  });
</script>
