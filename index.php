<?php $dir = ""; include($dir . "header.php"); ?>

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
</style>
<!-- content -->


<h1>TOMPKINS COMPUTER SCIENCE COMPETITION </h1>



<!-- info such as rank, problems submitted, member scores, admin released information, etc-->

<!-- if a team show members, add members,show member scores -->
<?php
if ($_SESSION['perm']==1) {




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


  //add member in database

  if(isset($_POST['sub'])){
    $sql = "INSERT INTO members(name,team) VALUES ('".$_POST['memberName']."','".$_SESSION['username']."')";
    $result = $conn->query($sql);
    header('Location:index.php');

    }


  //display members already in databse
  $sql = "SELECT * FROM members WHERE team='".$_SESSION['username']."';";

  $result = $conn->query($sql);

  if($result->num_rows>0){
    echo "<table id = 'members'><caption>Competitors</caption>";
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row['name']."</td>";
      if($row['writtenScore']==null){
        echo "<td>N/A</td>";
      }
      else {
        echo "<td>".$row['writtenScore']."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }



$conn->close();

if($result->num_rows<3){
?>



<!--register members-->
<form action="index" method="post">
      <label for="memberName">Member Name: </label>
      <input type="text" name="memberName" placeholder="John Doe">
    <input type="submit" name="sub" value="Register Member">
</form>
<?php }} ?>

<!-- if an admin, set written scores-->



<!-- rank info, problems submitted-->
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

    $sql = "SELECT * FROM teams WHERE username='".$_SESSION['username']."';";
    $result = $conn->query($sql);
    $level = "adv";
    while($row = $result->fetch_assoc()){
      $level = $row['level'];
    }





  //display members already in databse
  $sql = "SELECT * FROM teams WHERE level='".$level."' ORDER BY points DESC, problemsWrong, username;";
  if($level == null){
      $sql = "SELECT * FROM teams WHERE level!='null' ORDER BY level, points DESC, problemsWrong, username;";
  }
  $result = $conn->query($sql);

  $nov=true;
  if($result->num_rows>0){
    if($level=='adv'||$_SESSION['perm']==100){
      echo "<table style = 'display: inline;' id = 'rankings'><th>Team</th><th>Points</th><th>Right</th>";
      echo "<caption>Advanced Rankings</caption>";
    }
    while($row = $result->fetch_assoc()) {
      if($row['level']=='nov'&&$nov == true){
        echo "</table><table style = 'float:right;' id = 'rankings'><caption>Novice Rankings</caption><th>Team</th><th>Points</th><th>Right</th>";
        $nov = false;
      }
      echo "<tr>
      <td>".$row['username']."</td>";
      echo "<td>".$row['points']."</td>";
      echo "<td>".$row['problemsRight']."</td>";
      echo "</tr>";
    }
    echo "</table>";
  }

 ?>
