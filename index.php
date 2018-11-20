<html>
<head>
  <title>Tompkins CS</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">


  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <link rel="stylesheet" href="/css/index.css">
</head>


<body>
<?php

  // redirecting to login page if not logged in
  session_start();
  if(!isset($_SESSION['username'])){
     ob_start();
     header('Location: '.'login.php');
     ob_end_flush();
     die();
  }
  $dir="";
?>



  <div class="overlay"></div>

  <img src="img/back.jpg" alt="Background for Homepage" id = "video">

  <div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 my-auto">
          <div class="masthead-content text-white py-5 py-md-0">
            <h1 class="mb-3">Welcome to the Tompkins Computer Science Competition, <?php echo $_SESSION['username'] ?></h1>

            <!-- links for other pages -->
            <nav id = 'menu' >
             <a href=<?php echo $dir."index.php" ?>>Home</a><br>

              <a href=<?php echo $dir."menu.php" ?>>Menu</a><br>

              <a href = <?php echo $dir."vieworders.php" ?>>View Orders</a><br>
              <?php if($_SESSION['perm']==100){ ?>
                <a href=<?php echo $dir."writtenScore.php" ?>>Writtens</a><br>
            <?php } ?>

            <?php if($_SESSION['perm']==100){ ?>
              <a href=<?php echo $dir."addTeam.php" ?>>Add Team</a><br>
           <?php } ?>
           <?php if($_SESSION['perm']==100){ ?>
             <a href=<?php echo $dir."uploads/gradeProblems.php" ?>>Grade Problems</a><br>
           <?php } ?>
           <?php if($_SESSION['perm']==1){ ?>
             <a href=<?php echo $dir."submitProblem.php" ?>>Submit Problems</a><br>
           <?php } ?>

              <a href=<?php echo $dir."downloads.php" ?>>Downloads</a><br>

              <a href=<?php echo $dir."logout.php" ?>>Logout</a>
            </nav>


          </div>
        </div>
      </div>
    </div>
  </div>

<div class = "tables">
  <ul class="list-unstyled text-center mb-0">
<!-- info such as rank, problems submitted, member scores, admin released information, etc-->

<!-- if a team show members, add members,show member scores -->
<?php
if ($_SESSION['perm']==1) {

  $servername = "localhost";
  $username = "root";
  $password = "admin";
  $dbname = "cscomp";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


  //add member in database

  if(isset($_POST['sub'])){
      $sql = "INSERT INTO members(name,team) VALUES ('".$_POST['memberName']."','".$_SESSION['username']."')";
      $result = $conn->query($sql);
      header('Location:index.php');
    }


  //display members already in databse
  $sql = "SELECT * FROM members WHERE team='".$_SESSION['username']."';";

  $result = $conn->query($sql);
  if($result->num_rows<3){

  ?>
  <li class='list-unstyled-item'>
    <!--register members-->
    <form action="index" method="post">
          <label for="memberName" style="font-weight:800"> Member Name: </label>
          <input type="text" name="memberName" placeholder="John Doe">
        <input type="submit" name="sub" value="Register">
    </form>
  </li>

  <?php
  }
  if($result->num_rows>0){
    echo "<li class='list-unstyled-item'><table id = 'members'><caption>Competitors</caption><th>Name</th><th>Score</th>";
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td>".$row['name']."</td>";
      if($row['writtenScore']==null){
        echo "<td>N/A</td>";
      }
      else {
        echo "<td>".$row['writtenScore']."</td>";
      }
      echo "</tr>";
    }
    echo "</table></li>";
  }



$conn->close();

}

?>





<!-- rank info, problems submitted-->
<?php


  $servername = "localhost";
  $username = "root";
  $password = "admin";
  $dbname = "cscomp";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


  //find level of team

    $sql = "SELECT * FROM teams WHERE username='".$_SESSION['username']."';";
    $result = $conn->query($sql);
    $level = "adv";
    while($row = $result->fetch_assoc()){
      $level = $row['level'];
    }

  //display members already in databse
  $sql = "SELECT * FROM teams WHERE level='".$level."' ORDER BY points DESC, problemsWrong, username;";
  if($level == null){
      $sql = "SELECT * FROM teams WHERE level!='null' ORDER BY level, points DESC, problemsWrong, username;";
  }
  $result = $conn->query($sql);

  $nov=true;
  if($result->num_rows>0){
    if($level=='adv'||$_SESSION['perm']==100){
      echo "<li class='list-unstyled-item'><p class = 'caption'>Advanced Rankings</p><div class = 'scrollit'><table id = 'rankings'><thead><th>Team</th><th>Points</th><th>Right</th></thead><tbody>";

    }
    while($row = $result->fetch_assoc()) {
      if($row['level']=='nov'&&$nov == true){
        echo "</tbody></table></div></li><li class='list-unstyled-item'><p class = 'caption'>Novice Rankings</p><div class = 'scrollit'><table style='margin-left:20px;' id = 'rankings'><thead><th>Team</th><th>Points</th><th>Right</th></tead><tbody>";
        $nov = false;
      }
      echo "<tr>
      <td>".$row['username']."</td>";
      echo "<td>".$row['points']."</td>";
      echo "<td>".$row['problemsRight']."</td>";
      echo "</tr>";
    }
    echo "</tbody></table></div></li>";
  }

 ?>
    </ul>
  </div>
</body>
</html>

<script type="text/javascript">
  $('table').scrollTableBody();
</script>
