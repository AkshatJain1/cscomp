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
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
        </select><br><br>
        <input type="submit"id = 'problemSubmit' name="submit" value="Upload">
</form>
<div id = "content">

</div>
