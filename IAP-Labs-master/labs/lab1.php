<?php
  include_once 'DBConnector.php';
  include_once 'User.php';

  $con = new DBConnector;

  if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

//create a user object
    $user = new User($first_name, $last_name, $city_name, $username, $password);

//lab 2
    if(!$user->validateForm()){
      $user->createFormErrorSessions();
      header("Refresh:0");
      die();
    }


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
    <title>Title goes here</title>
  
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">

</head>
<body>
    <form class="" method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?php $_SERVER['PHP_SELF'] ?>">

      <table align="center">

        <tr>
          <td>
            <div id = "form-errors">
              <?php
              session_start();
              if(!empty($_SESSION['form_errors'])){
                echo "" . $_SESSION['form_errors'];
                unset($_SESSION['form_errors']);
              }
              ?>
            </div>
          </td>
        </tr>

        <tr>
          <td><input type="text" name="first_name" required placeholder="First name"/></td>
        </tr>

        <tr>
          <td><input type="text" name="last_name" required placeholder="Last name"/></td>
        </tr>

        <tr>
          <td><input type="text" name="city_name" required placeholder="City"/></td>
        </tr>

        <!-- lab 2 part 2 -->
        <tr>
          <td><input type="text" name="username" required placeholder="username"/></td>
        </tr>

        <tr>
          <td><input type="text" name="password" required placeholder="Password"/></td>
        </tr>

        <tr>
          <td><button type="submit" name="btn-save" required placeholder = "Submit">Add Records</button><a href = "login.php"></a></td>
        </tr>

       <!-- <tr>
          <td><a href = "login.php">Login</a></td>
        </tr> -->

      </table>
    </form>
</body>
</html>
