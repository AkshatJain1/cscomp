<?php $dir = ""; include($dir . "header.php"); ?>
<h1>Writtens</h1>

<style media="screen">
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    margin-bottom: 3em;
    margin-top: 3em;
  }

  td,th {
    /* border: 1px dashed #aaa; */
    text-align: center;
    padding: 1em;
    overflow: auto;
  }
  tr:nth-child(even) {
    background-color: #ccc;
  }

  #members{
      width: 20%;
      margin: 0 auto;
  }
  #members td,th{
    border: 1px dashed #aaa;

  }
  #rankings{
      width: 10%;

  }
  #rankings td,th{
    border: 3px dotted #ddd ;
  }
  .writtenEdit{
    width: 50px;
  }
</style>
<?php

if(isset($_POST['sub'])) {

  $servername = "localhost";
  $username = "root";
  $password = "admin";
  $dbname = "cscomp";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

  //display members already in databse
  $sql = "UPDATE members SET writtenScore = '".$_POST['written']."' WHERE name='".$_POST['member']."';";

  $result = mysqli_query($conn,$sql);

  header("Location: writtenScore.php");

}

  $servername = "localhost";
  $username = "root";
  $password = "admin";
  $dbname = "cscomp";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

//display members already in databse
$sql = "SELECT * FROM members ORDER BY (CASE WHEN writtenScore IS NULL THEN 1 ELSE 0 END) DESC, writtenScore DESC;";

$result = mysqli_query($conn,$sql);

if($result->num_rows>0){
  echo "<form action = 'writtenScore' method = 'POST'>";
  echo "<center><input type = 'text' name = 'member' style = 'margin-right:10px;margin-bottom:50px;'>";
  echo "<input class = 'writtenEdit' type = 'number' name = 'written' style = 'margin-right:10px;'>";
  echo "<input type = 'submit' name = 'sub' value='Update'></center>";
  echo "<table id = 'members'><caption>Competitors</caption>
  <th>
  Name
  </th>
  <th>
  Written Score
  </th>
  <th>
  Team
  </th>
  <th>
  School
  </th>
  <th>
  Level
  </th>

  ";
  while($row =mysqli_fetch_assoc($result)) {


    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    if($row['writtenScore']==null){

      echo "<td> -- </td>";
    }
    else {
      echo "<td>".$row['writtenScore']."</td>";
      // echo "<td>".$row['writtenScore']."</td>";
    }
    echo "<td>".$row['team']."</td>";
    $sql = "SELECT * FROM teams where username='".$row['team']."';";
    $result1 = $conn->query($sql);
      while($row1 = $result1->fetch_assoc()) {
        echo "<td>".$row1['school']."</td>";
        if($row1['level']=='nov'){
          echo "<td>Novice</td>";
        }
        else{
          echo "<td>Advanced</td>";
        }

      }
    echo "</tr>";

  }

  echo "</table>";
  echo "</form>";

}

 ?>
