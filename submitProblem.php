<?php $dir = ""; include($dir . "header.php"); ?>
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
      $container.load("loadTeamStatus.php");
      var refreshId = setInterval(function()
      {
          $container.load('loadTeamStatus.php');
      }, 9000);
  });
</script>

<link rel="stylesheet" href="css/table.css">
<form action="uploads/upload.php" method="post" enctype="multipart/form-data">
  <h2>Upload File</h2>
        <label for="fileSelect">Filename:</label>
        <input type="file" name="java" id="fileSelect" /><br>
        <label for="problemNumber">Problem Number:</label>
        <select class="number" name="problemNumber">
          <!--  TODO: get from problem names, keep value same -->
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
            $sql1 = "SELECT * FROM problems";

            $result1 = $conn->query($sql1);
            while($row = $result1->fetch_assoc()){
              echo "<option value = '".$row['number']."'>".$row['name']."</option>";
            }
          ?>
        </select><br><br>
        <input type="submit"id = 'problemSubmit' name="submit" value="Upload">
</form>
<div id = "content">

</div>
