<?php
//lab 2 part 2
    //check if the session is set
     session_start();

     //if session is not set direct user to login page
     if(!isset($_SESSION['username'])){
     	header("Location:login.php");
     }
?>

<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title goes here</title>
  
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">

	</head>

	<body>
		<p>This is a private page</p>
		<p>We want to project it</p>
		<p><a href = "logout.php">Logout</a></p>
	</body>
</html>