<?php 

interface AdminInterface{
   
    public function register($userid, $username, $phone, $userPassword, $class);
    public function Logout();
    
    public function showUsers();
    public function remove($id);
}