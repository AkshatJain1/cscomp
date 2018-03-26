<?php $dir = ""; include($dir . "header.php"); ?>

<link rel="stylesheet" href="css/table.css">
<form action="uploads/upload.php" method="post" enctype="multipart/form-data">
  <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="java" id="fileSelect" /><br>
        <label for="problemNumber">Problem Number:</label>
        <select class="number" name="problemNumber">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select><br><br>
        <input type="submit"id = 'problemSubmit' name="submit" value="Upload">
</form>
<table><caption>Submissions</caption><tr><th>Number</th><th>Status</th></tr>
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
      echo "<tr><td>".$row['number']."</td>";
      echo "<td>".$row['status']."</td></tr>";
    }


 ?>
</table>
