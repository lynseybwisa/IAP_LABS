<?php
     interface Authenticator{
     	public function hashPassword();
     	public function isPasswordCorrect($username, $password);
     	public function login();
     	public function logout();
     	public function createFormErrorSessions();
     }
?>