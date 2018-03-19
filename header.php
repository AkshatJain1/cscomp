<?php

// redirecting to login page if not logged in
session_start();
if(!isset($_SESSION['username'])){
   ob_start();
   header('Location: '.'login.php');
   ob_end_flush();
   die();
}
echo $_SESSION['username']."<br>";
 ?>

 <a href="index.php">index</a>
 <a href="logout.php">Logout</a>
