<?php
  include 'Crud.php';
  include "authenticator.php"; //include the authentcation file for lab 2 part 2
  include_once 'DBConnector.php';

  /**
   *
   */
  class User implements Crud
  {
    //add new variables for lab 2 part 2
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;
    private $conn;

    //use class contructor to instantiate our variables as they're private for lab 2 part 2
    function __construct($first_name, $last_name, $city_name, $username, $password)
    {
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->city_name = $city_name;
      //add for lab 2 part 2
      $this->username = $username;
      $this->password = $password;
      $this->con = new DBConnector();
    }

      //make a static constructor to access the details initialized above for lab 2 part 2
    public static function create(){
      $instance = new self(null,null,null,null,null);
      return $instance;
    }


    //username setter and getter for lab 2 part2 
    public function setUsername($username){
      $this->username = $username;
    }
    public function getUsername(){
      return $this->username = $username;
    }

    ////password setter and getter for lab 2 part 2
    public function setPassword($password){
      $this->password = $password;
    }
    public function getPassword(){
      return $this->password = $password;
    }

    //use_id setter
    public function setUserId($user_id)
    {
      $this->$user_id = $user_id;
    }

    public function getUserId()
    {
      return $this->$user_id;
    }

    public function save()
    {

      $fn = $this->first_name;
      $ln = $this->last_name;
      $city = $this->city_name;
    
    //add for lab 2 part 2 to save username and password
      $uname = $this->username;
      $this->hashPassword();
      $pass = $this->password;


      $sql = "INSERT INTO user(first_name, last_name, user_city, username, password) VALUES('$fn', '$ln', '$city', '$uname', '$pass')"; 

      $res=mysqli_query($this->con->conn,$sql) or die("Error: ". mysqli_error($con->conn));

      return $res;
      
    }

    public function readUnique()
    {
      return null;
    }

    public function readAll()
    {
      $sql= "SELECT * FROM user";
      $res = mysqli_query($this->$con->conn, $sql) or die("Error: ". mysqli_error($con->conn));

    
      return $res;
    }

    public function search()
    {
      return null;
    }
    public function update()
    {
      return null;
    }

    public function removeOne()
    {
      return null;
    }


    public function removeAll()
    {
      return null;
    }

    //lab 2 phase 1
    public function validateForm(){
      //return true if the values are not empty
      $fname = $this->first_name;
      $lname = $this->last_name;
      $city = $this->city_name;

      if($fname =="" || $lname == "" || $city == ""){
        return false;
      } 
        return true;
      }
    

   public function createFormErrorSessions(){
      session_start();
      $_SESSION['form_errors'] = "All fields are required";
    }

    public function createUsernameErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "Username Exists";
        }

   //lab 2 part 2 methods added
    //function that hashes password
    public function hashPassword(){
     $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect(){
      $found = false;
      $sql= "SELECT * FROM user";
      $res = mysqli_query($this->$con->conn, $sql) or die("Error: ". mysqli_error($con->conn));

      while ($row = $res->fetch_array()) {
        if (password_verify($this->getPassword(), $row['password']) && ($this->getUsername() == $row['username'])){
          $found = true;
        }
      }

      print_r($found);
      return $found;

    }

    public function login(){
      if ($this->isPasswordCorrect()){
        //password correct so load page
        header("Location:private_page.php");
      }
    }

    public function createUserSession(){
      session_start();
      $_SESSION['username'] = $this->getUsername();
    }

    public function logout(){
      session_start();
      unset($_SESSION['username']);
      unset($_SESSION['id']);
      session_destroy();
      header("Location:lab1.php");
    }
  

//check if username exists
  public function isUserExists($username){
    $sql = "SELECT * FROM user where username='$username'";
    $res = mysqli_query($this->con->conn,$sql) or die("Error " .mysqli_error($con->conn));

    if($res->num_rows > 0){
      return true;
    }
    return false;
  }
}


 ?>
