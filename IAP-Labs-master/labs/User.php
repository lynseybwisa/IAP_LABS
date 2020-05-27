<?php
  include 'Crud.php';
  include "authenticator.php"; //include the authentcation file for lab 2 part 2
  include_once 'DBConnector.php';

  /**
   *
   */
  class User implements Crud,Authenticator
  {
    //add new variables for lab 2 part 2
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;

    //use class contructor to instantiate our variables as they're private for lab 2 part 2
    function __construct($first_name, $last_name, $city_name, $username, $password)
    {
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->city_name = $city_name;
      //add for lab 2 part 2
      $this->username = $username;
      $this->password = $password;
    }

      //make a static constructor to access the details initialized above for lab 2 part 2
    public static function create(){
      $instance = new self();
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
      $con = new DBConnector();
    //add for lab 2 part 2 to save username and password
      $uname = $this->username;
      $this->hashPassword();
      $pass = $this->password;


      $res = mysqli_query($con->conn ,"INSERT INTO user(first_name, last_name, user_city, username, password) VALUES('$fn', '$ln', '$city', '$uname', '$pass')") or die("Error: ". mysqli_error($con->conn));
      return $res;
      $con->closeDatabase();
    }

    public function readUnique()
    {
      return null;
    }

    public function readAll()
    {
      $con = new DBConnector();
      $data = mysqli_query($con->conn, "SELECT * FROM users");
      return $data;
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
      $fn = $this->first_name;
      $ln = $this->last_name;
      $city = $this->city_name;

      if($fn =="" || $ln == "" || $city == ""){
        return false;
      } else {
        return true;
      }
    }

    public function createFormErrorSessions(){
      session_start();
      $_SESSION['form_errors'] = "All fields are required";
    }

   //lab 2 part 2 methods added
    //function that hashes password
    public function hashPassword(){
     $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect($username, $password){
      $con = new DBConnector;
      $found = false;
      $res = mysqli_query($con->conn, "SELECT * FROM users") or die ("Error" .mysql_error());
      

      while ($row = $res->fetch_assoc()) {
        if (password_verify($password, $row['password'] && $username == $row['username'])){
          $found = true;
        }
      }

      //close db connection on lab 2 part 2
      $con->closeDatabase();
      return $found;
    }

    public function login(){
      if ($this->isPasswordCorrect()){
        //password correct so load page
        header("Location:private_page.php");
      }
    }

    public function createUserSession($username){
      session_start();
      $_SESSION['username'] = $username;
    }

    public function logout(){
      session_start();
      unset($_SESSION['username']);
      session_destroy();
      header("Location:lab1.php");
    }
  }


 ?>
