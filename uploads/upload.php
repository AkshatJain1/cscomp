<?php $dir = "../"; include($dir . "header.php"); ?>
<?php
if(isset($_POST['submit'])){
  $filename = $_FILES['java']['name'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if($ext === "java"){

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

    $sql = "SELECT * from submissions WHERE number = '".$_POST['problemNumber']."' AND team = '".$_SESSION['username']."' AND status!='fail';";
    $result1 = $conn->query($sql);


    if($result1->num_rows>0) {
      echo "Please submit this problem only when you have failed it.";
    }
    else {
      $sql = "SELECT MAX(problem_id) FROM submissions";
      $result1 = $conn->query($sql);
      $row = mysqli_fetch_row($result1);
      $max = $row[0]+1;

      mkdir("".$max."");
      move_uploaded_file($_FILES["java"]["tmp_name"], $max. "/" . $_FILES["java"]["name"]);

      if($_POST['problemNumber']<10){
        copy("prob0".$_POST['problemNumber'].".txt", $max. "/". "/" ."prob0".$_POST['problemNumber'].".txt");
      }
      else{
        copy("prob0".$_POST['problemNumber'], $max. "/" . $_FILES["java"]["name"] . "/" ."prob0".$_POST['problemNumber'] );
      }


      echo "Your file was uploaded successfully.";


      $sql = "Insert into submissions(team, status, number) values ('".$_SESSION['username']."','wait','".$_POST['problemNumber']."')";

      $result = $conn->query($sql);
    }
    $conn->close();
  }
  else{
    echo "Please go back and upload the java file of your program.";
  }

}
 ?>
