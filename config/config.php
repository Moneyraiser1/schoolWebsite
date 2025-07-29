<?php

try{
    
    $db = new PDO('mysql:host=localhost;dbname=flcs;','root','');

}

catch(Exception $e){
    echo "Connection Failed" . $e->getMessage(); 
}