<?php 
  session_start();
  ob_start();
  define('APPURL', 'http://localhost/schoolWebsite');

  require __DIR__ . '/../config/config.php';
  require __DIR__ . '/../inc/functions.php'; 

   if(!isset($_SESSION['auth_user']['user_Id'])){
        header('Location: ../auth/login.php');
   } elseif ($_SESSION['role_as'] == 1) {
        header("Location: ../AdminLte/adminDashboard.php?aDashboard");
        exit();
  }
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FLCS</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Bootstrap  & CSS -->
  <link rel="stylesheet" href="<?= APPURL?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= APPURL?>/css/custom.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
 
<script src="<?= APPURL?>/jquery/jquery.min.js"></script>
<script src="<?= APPURL?>/js/bootstrap.min.js"></script>

<script src="<?= APPURL?>/alert/alertify.min.js"></script>
<link rel="stylesheet" href="<?= APPURL?>/css/alertify.min.css"/>
<link rel="stylesheet" href="<?= APPURL?>/css/default.min.css"/>


  <style>
    body{
      font-family: cursive;
    }
  
  </style>

  <?php include 'navbar.php' ?>
