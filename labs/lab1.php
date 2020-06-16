<?php
    include_once 'User.php';
    include_once 'DBConnector.php';
    include_once 'fileUploader.php';
    $first_name = '';
    $last_name = '';
    $city = '';
    $uname = '';
    $pass = '';
    $data = '';

$user = new User($first_name,$last_name,$city,$uname,$pass,$data);
    $conn = new DBConnector();

    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $data = $_FILES['filetoUpload'];

    //Creating a new user object
        $user = new User($first_name,$last_name,$city,$username,$password,$data);
        //Create the object for File Uploader
        $uploader = new FileUploader($data);

    if (!$user->validateForm()) {
            $user->createFormErrorSessions();
            header("Refresh:0");
            return;
        }else if($user->isUserExists($username)){
            $user->createUsernameErrorSessions();
            header("Refresh:0");
            return;
        }else{
            $res = $user->save();
        }

     $file_upload_response = $uploader->uploadFile();

     //Check if the operation occured succesfully
        if ($res && $file_upload_response === TRUE) {
            $message = "Save Operation Was Succesful";
        }else{
            $message = "Save Operation Was Not Succesful";
        }
        $conn->closeDatabase();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab 1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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
    <link href="css/floating-labels.css" rel="stylesheet">
    <script src="js/validate.js"></script>
    
</head>
<body>

<form class="form-signin" method="post" style="margin-left:100px;margin-right:200px;" 
        name="user_details" id="user_details" onsubmit="return validateForm()" 
            action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">

        <div class="text-center"> 
        
        <div id="form-errors">
            <?php
                session_start();
                if(!empty($_SESSION['form_errors'])){
                    echo " ".$_SESSION['form_errors']."<br/><br/>";
    
                    unset($_SESSION['form_errors']);
                }
            ?>
        </div>

    </div>


<div class="form-label-group">
        <label for="inputEmail">First Name</label>
            <input name="first_name" type="text" id="inputEmail" class="form-control" placeholder="First Name" autofocus>
           
        </div>

        <div class="form-label-group">
        <label for="inputLastname">Last Name</label>
            <input name="last_name" type="text" id="inputLastname" class="form-control" placeholder="Last Name">
        
        </div>

        <div class="form-label-group">
        <label for="inputPassword">City Name</label>
            <input name="city_name" type="text" id="inputPassword" class="form-control" placeholder="City Name">
           
        </div>

        <div class="form-label-group">
        <label for="inputUsername">Username</label>
            <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username">
        
        </div>

        <div class="form-label-group">
        <label for="inputPassword1">Password</label>
            <input name="password" type="password" id="inputPassword1" class="form-control" placeholder="Password">
            
        </div>
        <br>

        <div class="form-label-group">
            <input type="file" name="filetoUpload" class="form-control-file" id="exampleFormControlFile1">        
        </div>
        <br>

        
        <button name="btn-save" class="btn btn-primary" type="submit">SAVE</button>
        <a class="btn btn-primary" href="login.php" role="button">LOGIN</a>

    </form>

<div>
    <div id="form-error">
        <?php
            if (isset($message)) {
                echo
                '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
            }
        ?>
    </div> 

<table id="example" style="padding-left:-100px;" class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">City Name</th>
                <th scope="col">Username</th>
            </tr> 
            </thead>
            <tbody>
                <?php
                    $result = $user->readAll();
                    if($result->num_rows > 0){
                        while($row = $result->fetch_array()){
                            echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['user_city'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>

</table>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="js/timezone.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>