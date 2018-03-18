<?php
  session_start();
  $_SESSION=array();
  unset($_SESSION);
  session_destroy();

  ob_start();
  header('Location: '.'login.php');
  ob_end_flush();
  die();
?>
