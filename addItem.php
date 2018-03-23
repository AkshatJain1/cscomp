<?php $dir = ""; include($dir . "header.php"); ?>
<link rel = "stylesheet"  href ="css/table.css">
<?php
if(isset($_POST['sub'])){
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
  $sql = "SELECT * from items WHERE name = '".$_POST['name']."';";
  // echo $sql;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "already taken";
  } else {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sql = "INSERT INTO items(name, price, available) VALUES('".$name."','".$price."','yes')";
      // echo $sql;
      $result = $conn->query($sql);
  }
  // if($result->num_row==0){
  //   // $sql = "INSERT items SET available='yes' WHERE item_id=".$_GET['toggleYes'].";";
  //   // // echo $sql;
  //   // $result = $conn->query($sql);
  //   echo "lmao available";
  // }

  $conn->close();
}

 ?>
<form action="addItem" method="post">
  <table id='menu'>
    <tr>
      <th>Name</th>
      <th>Price</th>
    </tr>
    <tr>
      <th>
        <input type="text" name="name" value="">
      </th>
      <th>
        <input type="number" name="price" value="">
      </th>
    </tr>
  </table>
  <center><input type="submit" name="sub" value="Add"></center>
</form>
