<?php $dir = ""; include($dir . "header.php"); ?>
<h1>Registration</h1>
<?php
if($_SESSION['perm']!=100){
  header("Location: logout.php");
}
if(isset($_POST['sub'])) {
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


  $sql = "INSERT INTO teams (username, password, points, level, problemsRight, problemsWrong, permission, school )";
  $sql .= " VALUES('".$_POST['name']."','".$_POST['pass']."','0','".$_POST['level']."','0','0','1','".$_POST['school']."');";

  $result = $conn->query($sql);

  header("Location: addTeam.php");
}
 ?>
<table>
<form style = 'margin-top:10em;' action="addTeam" method="post">
  <tr><td><label for="name">Name: </label></td>
  <td><input type="text" name="name" value=<?php

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

    $num = 'team'.rand(1, 100);
  while (true) {
    $num = 'team'.rand(1, 100);

    $sql = "SELECT * FROM teams WHERE username = '".$num."';";

    $result = $conn->query($sql);
    if($result->num_rows==0){
      break;
    }
  }
  $conn->close();
  echo $num;

  ?> readonly></td></tr>
  <br /><br>
  <tr><td><label for="password">Password: </label></td>
  <td><input type="password" name="pass" value="" required></td></tr>
  <br />
  <!-- <label for="level">Level: </label><br> -->
  <tr>
  <table>
    <th>Level</th>
    <tr>
        <td>Advanced:</td><td><input type="radio" name="level" value="adv"></td><br>
    </tr>
    <tr>
        <td>Novice:</td><td><input type="radio" name="level" value="nov"></td>
    </tr>
  </table></tr>
  <br>
    <tr><td><label for="school">School: </label></td>
  <td><input type="text" name="school" value="" required></td></tr>
  <tr><input type="submit" name="sub" value="Add Team"></tr>
</form>
</table>
