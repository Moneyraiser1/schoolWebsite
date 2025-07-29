<?php 
  session_start();
  ob_start();
  define('APPURL', 'http://localhost/schoolWebsite');

  require 'config/config.php';
  require 'inc/functions.php'; 
  if(isset($_SESSION['role_as'])){
    
  if($_SESSION['role_as'] == 1){
      $_SESSION['msg'] = "Page inaccessible";
      $_SESSION['msg_type'] = 'error';
      header('Location: http://localhost/schoolWebsite/error.php');
  }elseif ($_SESSION['role_as'] == 1) {
        header("Location: ../AdminLte/adminDashboard.php?aDashboard");
        exit();
  }
  
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
    #main-banner{
    background-image: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.9)), url(images/3.jpeg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    height: 100vh;
    
    }
    #banner1{
    background-image: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.9)), url(images/2.jpeg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    height: 100vh;
    
}
#banner2{
    background-image: linear-gradient(rgba(0,0,0,0.9), rgba(0,0,0,0.9)), url(images/3.jpeg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    height: 100vh;
    
}
.navimg{
    width: 10%;
}
    .services-box{
    
    width: 100%;
    }
  </style>

  <?php include 'inc/navbar.php' ?>
  <?php require 'inc/alertify.php'; 
?>

<style>
  
</style>
<main class="main">


    <!-- Hero Section -->
    <section id="hero" >

            <!-- Carousel -->
      <div id="demo" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>

      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container-fluid  text-center" id="main-banner" data-aos="zoom-out" data-aos-delay="100">
              <div class="row justify-content-center align-items-center d-flex">
                <div class="col-lg-8 p-5">
                  <h2 class="p-5 mt-5 text-light">Talented Future Leaders Children School</h2>
                  <p class="text-light">The front-runners .</p>
                  <a href="#services" class="btn btn-get-started btn-success">See our Services</a>
                </div>
              </div>
            </div>
          
        </div>

        <div class="carousel-item">
        <div class="container-fluid text-center" id="banner1" data-aos="zoom-out" data-aos-delay="100">
              <div class="row justify-content-center align-items-center d-flex">
                <div class="col-lg-8 p-5">
                  <h2 class="p-5 mt-5 text-light">Talented Future Leaders Children School</h2>
                  <p class="text-light">The home of high quality teachers.</p>
                  <a href="#services" class="btn btn-get-started btn-success">See our Services</a>
                </div>
              </div>
            </div>
          
        </div>

        <div class="carousel-item">
        <div class="container-fluid  text-center" id="banner2" data-aos="zoom-out" data-aos-delay="100">
              <div class="row justify-content-center align-items-center d-flex">
                <div class="col-lg-8 p-5">
                  <h2 class="p-5 mt-5 text-light">Talented Future Leaders Children School</h2>
                  <p class="text-light">Front runners of Tech services .</p>
                  <a href="#services" class="btn btn-get-started btn-success">See our Services</a>
                </div>
              </div>
            </div>
          
        </div>


      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
      </div>

     

    </section><!-- /Hero Section -->

  </main>

  <section id="services">
    <div class="container">
    <div class="row justify-content-center align-items-center d-flex">
      <div class="col-md-12">
           <div class="col-lg-12 p-5">
              <h2 class=" text-mute text-center">WHY CHOOSE US</h2>
          </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="rounded services-box bg-primary text-center">
                    <span class="display-1 text-light mt-5 p-2"><i class="fas fa-brain fa-cog "></i></span>
                    <h3 class=" text-light my-2">Expert Faculty</h3>
                    <h5 class="text-light p-2">Our experienced teachers are passionate about their subjects and dedicated to inspiring curiosity</h5>
                  </div>
                </div>
                <div class="col-md-4">
                <div class="rounded services-box bg-primary text-center">
                    <span class="display-1 text-light mt-5 p-2"><i class="fas fa-eye "></i></span>
                    <h3 class=" text-light my-2">Personalized Attention</h3>
                    <h5 class="text-light p-2">Our small class sizes ensures each students receives tailored guidance and support</h5>
                  </div>
                </div>
                <div class="col-md-4">
                <div class="rounded services-box bg-primary text-center">
                    <span class="display-1 text-light mt-5 p-2"><i class="fas fa-star-and-crescent "></i></span>
                    <h3 class=" text-light my-2">Moral guidance</h3>
                    <h5 class="text-light p-2">Our experienced teachers provide mentorship and promote core values like Honesty, Patience and etc.</h5>
                  </div>  
                </div>
            </div>
          </div>
        </div>
    </div>
  </section>


  <?php require 'inc/footer.php'; ?>