<?php $dir = ""; include($dir . "header.php"); ?>
<link rel = "stylesheet"  href ="css/table.css">

<?php
echo "<h3>Menu</h3>";
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

  $cost = 0;
  $items = "none|";
   if (isset($_POST["item"])) {
     $items ="";
     $name =  $_POST["item"];
     foreach ($name as $item){
         $items .=str_replace('_', ' ', $item)."|";

         $result = $conn->query("Select * from items where name='".$item."'");

         while($row = $result->fetch_assoc()) {
            $cost += $row['price'];
         }
     }
   }
   //gets rid of the last '|'
   $items = substr($items,0,-1);





   $sql = "Insert into orders(itemsName, cost, team_user, active) values ('".$items."','".$cost."','".$_SESSION['username']."','yes')";

   $result = $conn->query($sql);

  $conn->close();

  ob_start();
  header('Location: '.'vieworders.php');
  ob_end_flush();
  die();

}



 ?>

<form action="menu" method="post">
  <table>
    <tr>
      <th>Picture</th>
      <th>Name</th>
      <th>Price</th>
      <th>Available</th>
      <th>Select</th>
    </tr>

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

    $sql = "SELECT * FROM items";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td><img src = 'img/".$row['name'].".jpg' alt = 'Item Picture' class = 'pic'></td>
      <td>".str_replace('_', ' ', $row['name'])."</td>
      <td>".$row['price']."</td>";

      if($row['available']=='yes'){
        echo "<td><center><div class='box green'> </div></center></td>";
        echo "<td><input type = 'checkbox' name = 'item[]' value='".$row['name']."'></td></tr>";
      }
      if($row['available']=='no'){
        echo "<td><center><div class='box red'> </div></center></td>";
        echo "<td><input type = 'checkbox' name = 'item[]' value='".$row['name']."' disabled></td></tr>";
      }

    }
    $conn->close();
     ?>
  </table>

  <center><input type="submit" name="sub" value="Order"></center>
</form>
