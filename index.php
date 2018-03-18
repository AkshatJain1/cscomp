<?
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


<h1>index</h1>

<!-- link for logout -->
<a href="logout.php">Logout</a>
