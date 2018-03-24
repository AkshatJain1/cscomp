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
<style media="screen">
  nav a{
      margin-right: 1em;
    }

</style>
<header>
<?php

// $dom = new DOMDocument();
// $time = $dom->getElementById("timer");
// if($time->textContent=="EXPIRED"){
//   echo "lol";
// }

 ?>
  <!-- Display the countdown timer in an element -->
<p id="timer" style="display: inline"></p>


 <!-- links for other pages -->
 <nav id = 'tabs' style="float: right">
  <a href=<?php echo $dir."index.php" ?>>Home</a>

   <a href=<?php echo $dir."menu.php" ?>>Menu</a>

   <a href = 'vieworders.php'>View Orders</a>
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

 <script>
 // Set the date we're counting down to
 var countDownDate = new Date("March 23, 2018 3:37:25").getTime();

 // Update the count down every 1 second
 var x = setInterval(function() {

   // Get todays date and time
   var now = new Date().getTime();

   // Find the distance between now an the count down date
   var distance = countDownDate - now;

   // Time calculations for days, hours, minutes and seconds
   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
   var seconds = Math.floor((distance % (1000 * 60)) / 1000);

   // Display the result in the element with id="demo"
   document.getElementById("timer").innerHTML = hours + "h "
   + minutes + "m ";

   // If the count down is finished, write some text
   if (distance < 0) {
     clearInterval(x);
     document.getElementById("timer").innerHTML = "EXPIRED";
     $("#problemSubmit").prop('disabled', true)
   }
 }, 1000);
 </script>
</header>
