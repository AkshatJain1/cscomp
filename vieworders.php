<?php $dir = ""; include($dir . "header.php"); ?>
<?php
  if (isset($_GET['toggleNo'])&&$_SESSION['perm']==100) {
      // echo $_GET['toggleNo'];
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

      $sql = "UPDATE orders SET active='no' WHERE order_id=".$_GET['toggleNo'].";";
      // echo $sql;
      $result = $conn->query($sql);

      $conn->close();
  }
  if (isset($_GET['toggleYes'])&&$_SESSION['perm']==100) {
      // echo $_GET['toggleYes'];
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

      $sql = "UPDATE orders SET active='yes' WHERE order_id=".$_GET['toggleYes'].";";
      // echo $sql;
      $result = $conn->query($sql);

      $conn->close();
  }
  if(isset($_GET['delete'])&&$_SESSION['perm']==100){
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

    $sql = "DELETE FROM orders WHERE order_id=".$_GET['delete'].";";
    // echo $sql;
    $result = $conn->query($sql);

    $conn->close();
  }
 ?>


 <link rel="stylesheet" href="css/table.css">

<h1>Orders</h1>
 <table>
   <tr>
     <th>Item Names</th>
     <th>Cost</th>
     <?php if($_SESSION['perm']==100){?>
     <th>User</th>
   <?php } ?>
     <th>Active</th>
     <?php if($_SESSION['perm']==100){?>
     <th>Delete</th>
   <?php } ?>
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

   $sql = "SELECT * FROM orders";

   $result = $conn->query($sql);
   while($row = $result->fetch_assoc()) {
     if($row['team_user']==$_SESSION['username']||$_SESSION['perm']==100){
       echo "<tr>
       <td>".$row['itemsName']."</td>
       <td>".$row['cost']."</td>";
       if($_SESSION['perm']==100)
        echo "<td>".$row['team_user']."</td>";

        if($row['active']=='yes'){
          echo "<td><center><a href = 'vieworders.php?toggleNo=\"".$row['order_id']."\"'><div class='box green'> </div></a></center></td>";
        }
        if($row['active']=='no'){
          echo "<td><center><a href = 'vieworders.php?toggleYes=\"".$row['order_id']."\"'><div class='box red'> </div></a></center></td>";
        }
        if($_SESSION['perm']==100)
          echo "<td><a href='vieworders.php?delete=\"".$row['order_id']."\"'><button type='button'>Delete</button></td>";
        echo "</tr>";
     }
   }
   $conn->close();
    ?>
 </table>
