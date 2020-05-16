<?php
  include_once 'DBConnector.php';
  include_once 'User.php';



  if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];

    $user = new User($first_name, $last_name, $city_name);

    $res = $user->save();



    if ($res) {
      echo "Save operation was successful";
    }else{
      echo "An error occured";
    }

    $data = $user->readAll();

  


  }


 ?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title gees here</title>
</head>
<body>
    <form class="" action="" method="post">
      <table align="center">
        <tr>
          <td><input type="text" name="first_name" required placeholder="First name"/></td>
        </tr>
        <tr>
          <td><input type="text" name="last_name" required placeholder="Last name"/></td>
        </tr>
        <tr>
          <td><input type="text" name="city_name" required placeholder="City"/></td>
        </tr>
        <tr>
          <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
        </tr>
      </table>
    </form>
</body>
</html>
