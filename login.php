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
        echo "logging in";
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
    echo "<p>wrong login</p>";
  }
}

// on submit, try to log in
if(isset($_POST["submit"])){
      if(isset($_POST["loginPassword"])&&isset($_POST["loginUser"])){
        login($_POST["loginUser"], $_POST["loginPassword"]);
      }
}
 ?>


<!--  log in form -->
<h1>Login</h1>
<form class="loginForm" action="login" method="post">
  <center>
    <table>
      <tr>
        <td class="formLabel">Username</td>
        <td><input type = "text" name = "loginUser" placeholder="johnappleseed"></td>
      </tr>
      <tr>
        <td class="formLabel">Password</td>
        <td><input type="password" name="loginPassword" placeholder="******"></td>
      </tr>
    </table>
    <input type="submit" value = "Login" name="submit"></input>
  </center>
</form>
