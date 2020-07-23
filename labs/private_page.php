<?php
    
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
        // exit();
    }

    include_once "DBConnector.php";
    $con = new DBConnector();

    $username = $_SESSION['username'];

    $sql = "SELECT id FROM user WHERE username = '$username'";
    // $res = $conn->getConnection()->query($sql) or die("Error:".$conn->getConnection()->error);
    $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
    while($row = $res->fetch_array()){
      $_SESSION['id'] = $row['id'];
    }

    function fetchUserApiKey(){
      $id = $_SESSION['id'];
      $con = new DBConnector();
      // $id = $_SESSION['id'];
      $sql = "SELECT api_key FROM api_keys WHERE user_id='$id'";
      $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
      if ($res->num_rows <= 0) {
          return 'Please Generate an API Key';
      }else{
        while($row = $res->fetch_array()){
          $api_key = $row['api_key'];
        }
        // $_SESSION['api_key'] = $api_key;
        return $api_key;
      }
     
   }
  //  echo ("API KEY:".$_SESSION['api_key']);

   
    
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Trevor Saudi">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Private Page</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/cover/">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="js/apikey.js"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="css/cover.css" rel="stylesheet">
</head>

<body class="text-center">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">Private Page</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link active" href="logout.php">Logout</a>
        </nav>
      </div>
    </header>

    <main role="main" class="inner cover">
      <h1 class="cover-heading">Welcome, <?= $_SESSION['username']?></h1>
      <p class="lead">Here, we will create an API that will allow Users/Developer to order items from the external
        systems.
        We now put this feature of allowing users to generate an API key. Click the button to generate an API Key.
      </p>
      <p class="lead">
        <?php $feedback = fetchUserApiKey();
      echo ($feedback==='Please Generate an API Key') ? 
        '<button class="btn btn-light" id="api-key-btn">Generate API Key</button>' : 
        '<button class="btn btn-light" id="api-key-btn" disabled>Generate API Key</button>';?>
      </p>
      <br><br>
      <div class="input-group apikey">
        <div class="input-group-prepend">
          <span class="input-group-text">Your API Key</span>
        </div>
        <textarea id="api-key" class="form-control area-api" aria-label="With textarea">
          <?php echo fetchUserApiKey();?>
        </textarea>
      </div>
      <br><br><br>
      <p class="lead"><b>Service Description:</b> We have a service API that allows external
        application to to order food and also pull an order status by using order id. Lets do it.</p>
    </main>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <!-- <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p> -->
      </div>
    </footer>
  </div>


</body>

</html>