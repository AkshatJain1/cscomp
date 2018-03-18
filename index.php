<?php
// session_start();
// if(isset($_SESSION['username']))
// {
//   echo "destroying session id";
  // $_SESSION=array();
  //  unset($_SESSION);
  //  session_destroy();
// }
// else{
//
//   $r=session_id();
//
//   /* SOME PIECE OF CODE TO AUTHENTICATE THE USER, MOSTLY SQL QUERY... */
//
//   /* now registering a session for an authenticated user */
//   $_SESSION['username']='user';
//
//   /* now displaying the session id..... */
//   echo "the session id id: ".$r;
//   echo " and the session has been registered for: ".$_SESSION['username'];
//
//
//   /* now destroying the session id */
//
//   if(isset($_SESSION['username']))
//   {
//       // $_SESSION=array();
//       // unset($_SESSION);
//       // session_destroy();
//       // echo "session destroyed...";
//   }
// }

// redirecting to login if not logged in
session_start();
if(!isset($_SESSION['username'])){
   ob_start();
   header('Location: '.'login.php');
   ob_end_flush();
   die();
}
?>


<h1>index</h1>

<a href="logout.php">Logout</a>
