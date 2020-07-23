<?php
include_once 'DBConnector.php';
include_once 'user.php';
$con = new DBConnector;
$user = new User('','','','','');

$res=$user->readAll();


    ?>


    <!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Labs IAP</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">trevorsaudi</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="lab1.php">Input Table</a></li>
        <li><a href="display.php">Display Table</a></li>
      </ul>
    </div>
  </nav>

  <table class="highlight centered">
        <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>City</th>
          </tr>
        </thead>
<?php
        while($row=mysqli_fetch_array($res)){
?>
        <tbody>
          <tr>
            <td><?php echo $row["first_name"] ?></td> 
            <td><?php echo $row["last_name"] ?></td> 
            <td><?php echo $row["user_city"] ?></td>
          </tr>

          <?php
        }
        ?>
        </tbody>
      </table>

  



<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>