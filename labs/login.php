<?php

//lab 2 part 2
     include_once 'DBConnector.php';
     include_once 'User.php';


      if (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create();
        $instance->setPassword($password);
        $instance->setUsername($username);

         if ($instance->isPasswordCorrect($username,$password)) {
            
            $instance->login();
            // $conn->closeDatabase();
            $instance->createUserSession($username);
        }

    }

    ?>

    <!doctype html>
<html lang="en">
<head>


<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

<!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    


    <style>
       body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      }
      main {
      flex: 1 0 auto;
      }
  body {
      background: #fff;
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="POST" name="login" id="login" action="<?= $_SERVER['PHP_SELF']?>">
    <div class="container">
    <div class="row">
    <div class="section"></div>
   <main>
    <center>
     <div class="container">
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE;">
        <div class="section"></div>
<div class="section"></div>
    
      <div class="section"><i class="mdi-alert-error red-text"></i></div>
      <h1>Login</h1>
  
            <div class='row'>
           
              <div class='input-field col s12'>
                <input class='validate' type="text" name='username' id='email' required />
                <label for='email'>Username</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col m12'>
                <input class='validate' type='password' name='password' id='password' required />
                <label for='password'>Password</label>
              </div>
              <label style='float: right;'>
              <a><b style="color: #F5F5F5;">Forgot Password?</b></a>
              </label>
            </div>
            <br/>
            <center>
              <div class='row'>
                <!-- <button style="margin-left:65px;"  type='submit' name='btn_login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button> -->
                <button name="btn-login"  style="margin-left:65px;" class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1' type="submit">Sign in</button>
                <!-- <button name="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->
       
              </div>
            </center>
     
        </div>
       </div>
      </center>
      </main>
  
    </div>
</div>
         
    </form>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

</body>
</html>
