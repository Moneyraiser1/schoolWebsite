<?php

    interface UserInterface{
        public function Login($userEmail, $userPassword);
        public function register($username, $userEmail, $userPassword, $role);
        public function Logout();


    }