<?php $dir = ""; include($dir . "header.php"); ?>
<link rel = "stylesheet"  href ="css/table.css">
<?php if($_SESSION['perm']==100){?>
<a href="addItem.php" style="float:right; margin-right: 1em;">Add Item</a>
<?php } ?>
<h3>Menu</h3>
<?php
if (isset($_GET['toggleNo'])&&$_SESSION['perm']==100) {
    // echo $_GET['toggleNo'];
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

    $sql = "UPDATE items SET available='no' WHERE item_id=".$_GET['toggleNo'].";";
    // echo $sql;
    $result = $conn->query($sql);

    $conn->close();
}
if (isset($_GET['toggleYes'])&&$_SESSION['perm']==100) {
    // echo $_GET['toggleYes'];
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

    $sql = "UPDATE items SET available='yes' WHERE item_id=".$_GET['toggleYes'].";";
    // echo $sql;
    $result = $conn->query($sql);

    $conn->close();
}
 ?>


<form action="submitOrder.php" method="post">
  <table id='menu'>
    <tr>
      <th>Picture</th>
      <th>Name</th>
      <th>Price</th>
      <th>Available</th>
      <th>Select</th>
    </tr>

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

    $sql = "SELECT * FROM items";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      echo "<tr>
      <td><img src = 'img/".$row['name'].".jpg' alt = 'Item Picture' class = 'pic'></td>
      <td class = 'name'>".str_replace('_', ' ', $row['name'])."</td>
      <td class = 'price'>".$row['price']."</td>";

      if($row['available']=='yes'){
        echo "<td><center><a href = 'menu.php?toggleNo=\"".$row['item_id']."\"'><div class='box green'></div></a></center></td>";
        echo "<td><input type = 'checkbox' name = 'item[]' class = 'select' onclick = 'quantity()' value='".$row['name']."'></td></tr>";
      }
      if($row['available']=='no'){
        echo "<td><center><a href = 'menu.php?toggleYes=\"".$row['item_id']."\"'><div class='box red'></div></a></center></td>";
        echo "<td><input type = 'checkbox' name = 'item[]'class = 'select' value='".$row['name']."' disabled></td></tr>";
      }

    }
    $conn->close();
     ?>
  </table>

  <center><button type="button" onclick="submitForm();">Submit</button></center>
</form>

<script type="text/javascript" defer>

function submitForm(){
  var cost = 0;
  var things = "none";
  for (var i = 0; i < $('.select').length; i++) {
    if($('.select')[i].checked){
      if(things=='none'){
        things='';
      }
      things += $('.name')[i].textContent+"\n";
      cost += Number($('.price')[i].textContent);
    }
  }


  if(confirm("Are you sure. It will cost $"+cost+".\n\nYou are ordering: \n"+things)){
    if(confirm("Thank you for your order. Please have your money ready.\n\n"
    + "Someone will come around to deliver your items. Until then, please check the status of your order on the View Orders page!")){
      document.getElementsByTagName('form')[0].submit();
    }
  }
  else{
    console.log('nah')
  }
}




function quantity(){
    for (var i = 0; i < $('.select').length; i++) {
      var resizeHeight = '10px'
      if($('.select')[i].checked&&$('.select')[i].parentElement.parentElement.style.height!=resizeHeight){

        $('.select')[i].parentElement.parentElement.style.height=resizeHeight;
        $('.pic')[i].style.height=resizeHeight;
        $('.select')[i].parentElement.parentElement.after($('.select')[i].parentElement.parentElement.cloneNode(true));
        $('.select')[i+1].checked=false;
        $('.pic')[i+1].style.height='auto';
        $('.select')[i+1].parentElement.parentElement.style.height='auto';
        i++;
      }
      else if(!$('.select')[i].checked&&$('.select')[i].parentElement.parentElement.style.height==resizeHeight){
        $('.pic')[i].style.height='auto';
        $('.select')[i].parentElement.parentElement.style.height='auto';
        var check = $('.select')[i].value;
        for (var i1 = i+1; i1 < $('.select').length; i1++) {

          if($('.select')[i1].value==check){
              $('.select')[i1].parentElement.parentElement.remove();
              i1--;
            }
        }
      }
    }
}
</script>
