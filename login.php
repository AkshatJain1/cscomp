<link rel="stylesheet" href="/css/login.css">
<div class="login">
  <!--  log in form -->
<?php
  //attempts a log in with entered username and password, sets appropriate session variables, redirects to index if succssessful
  function login($user, $pass){
    $servername = "localhost";
    $username = "root";
    $password = "admin";

    $conn = new mysqli($servername, $username, $password, "cscomp");

    if($conn->connect_error){
      die();
    }

    $result = $conn->query("select * from teams where username = \"" . $user . "\" and password = \"" . $pass . "\";");

    if($result->num_rows > 0){

      if(session_status()!==2){
          echo "<p class='err'>logging in</p>";
          session_start();
      }

      $data = $result->fetch_assoc();
      $_SESSION["dbid"] = $data["team_id"];
      $_SESSION["username"] = $data["username"];
      $_SESSION["perm"] = isset($data["permission"]) ? $data["permission"] : 1;

      ob_start();
      header('Location: '.'index.php');
      ob_end_flush();
      die();
    }
    else{
      // wrong login
      echo "<p class='err'>Wrong login. Please try again.</p>";
    }
  }

  // on submit, try to log in
  if(isset($_POST["submit"])){
        if(isset($_POST["loginPassword"])&&isset($_POST["loginUser"])){
          login($_POST["loginUser"], $_POST["loginPassword"]);
        }
  }
 ?>
  <h1>Login</h1>
  <form class="loginForm" action="login" method="post">

    <input type="text" name="loginUser" placeholder="Username" required="required" />
    <input type="password" name="loginPassword" placeholder="Password" required="required" />

    <input type="submit" name="submit" value="Start Coding" class="btn btn-primary btn-block btn-large"></input>

  </form>
</div>
