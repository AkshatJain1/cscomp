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
<style media="screen">
  nav a{
      margin-right: 1em;
    }

</style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <!-- links for other pages -->
 <nav id = 'tabs' style="float: right">
  <a href="index.php">Home</a>

   <a href="menu.php">Menu</a>

   <a href = 'vieworders.php'>View Orders</a>
   <?php if($_SESSION['perm']==100){ ?>
     <a href="writtenScore.php">Writtens</a>
 <?php } ?>

 <?php if($_SESSION['perm']==100){ ?>
   <a href="addTeam">Add Team</a>
<?php } ?>

   <a href="downloads.php">Downloads</a>

   <a href="logout.php">Logout</a>
 </nav>
