<?php

// redirecting to login page if not logged in
session_start();
if(!isset($_SESSION['username'])){
   ob_start();
   header('Location: '.'login.php');
   ob_end_flush();
   die();
}
echo "<pre>".$_SESSION['username']."</pre>";
 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/timer.js" charset="utf-8"></script>

<style media="screen">
  nav a{
      margin-right: 1em;
    }
</style>

<header>
<title>Tompkins CS</title>
    <!-- Display the countdown timer in an element -->
    <p id="timer" style="display: inline">Null</p>


   <!-- links for other pages -->
   <nav id = 'tabs' style="float: right">
    <a href=<?php echo $dir."index.php" ?>>Home</a>

     <a href=<?php echo $dir."menu.php" ?>>Menu</a>

     <a href = <?php echo $dir."vieworders.php" ?>>View Orders</a>
     <?php if($_SESSION['perm']==100){ ?>
       <a href=<?php echo $dir."writtenScore.php" ?>>Writtens</a>
   <?php } ?>

   <?php if($_SESSION['perm']==100){ ?>
     <a href=<?php echo $dir."addTeam.php" ?>>Add Team</a>
  <?php } ?>
  <?php if($_SESSION['perm']==100){ ?>
    <a href=<?php echo $dir."uploads/gradeProblems.php" ?>>Grade Problems</a>
  <?php } ?>
  <?php if($_SESSION['perm']==1){ ?>
    <a href=<?php echo $dir."submitProblem.php" ?>>Submit Problems</a>
  <?php } ?>

     <a href=<?php echo $dir."downloads.php" ?>>Downloads</a>

     <a href=<?php echo $dir."logout.php" ?>>Logout</a>
   </nav>

</header>
