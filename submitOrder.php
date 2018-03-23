<?php $dir = ""; include($dir . "header.php"); ?>


<?php

  echo "alert('submitting')";
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

 ?>
