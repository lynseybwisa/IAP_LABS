<?php

  /**
   * All the methods to be implemented
   */
  interface Crud
  {
    public function save();
    public function readAll();
    public function readUnique();
    public function search();
    public function update();
    public function removeOne();
    public function removeAll();

    //we added these methods for lab 2 
    public function validateForm();
    public function createFormErrorSessions();
   // public function createUsernameErrorSessions();
  }


 ?>
