<?php

//lab 2 part 2
     include_once 'DBConnector.php';
     include_once 'user.php';

     $con = new DBConnector;

     if (isset($_POST['btn_login'])){
     	$username = $_POST['username'];
     	$password = $_POST['password'];
     	//$instance = User::create();
     	//$instance->setPassword($password);
     	//$instance->setUsername($username);

     	//if($instance->isPasswordCorrect()){
     		//$instance->login();
     		//close database
     		//$con->closeDatabase();

     		//create a user session
     		//$instance->createUserSession();
     	//} else {
     		//$con->closeDatabase();
     		//header("Location:login.php");
     	//}
     //}

     if (User::isPasswordCorrect($username,$password)){
     	User::createUserSession($username);
     	header("Location:private_page.php");
     } else {
     	header("Location:login.php");
     }
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
    <form method="post" name="login" id="login"  action="<?php $_SERVER['PHP_SELF'] ?>">

      <table align="center">

        <tr>
          <td><input type="text" name="username" required placeholder="username"/></td>
        </tr>

        <tr>
          <td><input type="text" name="password" required placeholder="Password"/></td>
        </tr>

        <tr>
          <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
        </tr>


      </table>
    </form>
</body>
</html>