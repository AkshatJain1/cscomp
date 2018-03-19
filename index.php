<?php
// redirecting to login page if not logged in
session_start();
if(!isset($_SESSION['username'])){
   ob_start();
   header('Location: '.'login.php');
   ob_end_flush();
   die();
}
?>

<!-- content -->


<h1>Welcome <?php echo $_SESSION['username'] ?></h1>

<!-- links for other pages -->
<?php
    echo "<a href = 'vieworders.php'>View Orders</a>";
 ?>
 <br>
<a href="menu.php">Menu</a>
<br>
<!-- link for logout -->
<a href="logout.php">Logout</a>
<br>
<a href="downloads.php">Downloads</a>

<!-- info such as rank, problems submitted, member scores, admin released information, etc-->
