<?php $dir = ""; include($dir . "header.php"); ?>

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
        <input type="submit"id = 'problemSubmit' name="submit" value="Upload" readonly>
</form>
