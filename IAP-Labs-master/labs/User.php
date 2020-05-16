<?php
  include 'Crud.php';
  include_once 'DBConnector.php';

  /**
   *
   */
  class User implements Crud
  {

    function __construct($first_name, $last_name, $city_name)
    {
      $this->first_name = $first_name;
      $this->last_name = $last_name;
      $this->city_name = $city_name;

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



      $res = mysqli_query($con->conn ,"INSERT INTO user(first_name, last_name, user_city) VALUES('$fn', '$ln', '$city')") or die("Error: ". mysqli_error($con->conn));
      return $res;
    }

    public function readUnique()
    {
      return null;
    }

    public function readAll()
    {
      $con = new DBConnector();
      $data = mysqli_query($con->conn, "SELECT * FROM userme");
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

  }


 ?>
