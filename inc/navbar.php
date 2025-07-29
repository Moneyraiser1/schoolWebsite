<?php

if(isset($_SESSION['auth_user']['id'])){
$number = $db-> prepare("SELECT cOUNT(*) as num_products FROM cart WHERE user_id='".$_SESSION['auth_user']['id']."'");
$number-> execute();

$fetchData = $number->fetch(PDO::FETCH_OBJ);

  }


?>
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky sticky-top">
    <div class="container">
      <a class="navbar-brand head-logo " href="<?= APPURL?>/index.php"><img class="navimg" src="<?= APPURL?>/images/logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" class="text-dark" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-dark"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll justify-content-end" id="head-nav" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link text-dark" aria-current="page" href="<?= APPURL?>/index.php">Home</a>
            </li>
          
          <?php if(isset($_SESSION['auth_user']['username'])): ?>
            

          <li class="nav-item">
            <a class="nav-link text-dark" href="<?= APPURL?>/gallery/index.php">Gallery</a>
          </li>
            <li class="nav-item">
            <a class="nav-link text-dark" href="<?= APPURL?>/contact/contact.php">Contact</a>
          </li>
            <li class="nav-item">
            <a class="nav-link text-dark" href="<?= APPURL?>/shop/shop.php">Shop</a>
          </li>
         
         

          <li class="nav-item">
          <a class="nav-link text-dark" href="<?= APPURL?>/shop/shoppingCart.php"><span><i class="fa fa-shopping-cart"></i>(<?= $fetchData->num_products ?>)</span></a>
        </li>
           
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
            <?php echo $_SESSION['auth_user']['username']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">        
              <li><a class="dropdown-item" href="<?= APPURL?>/test/view_analysis.php">View Scores</a></li>
              <li><a class="dropdown-item" href="<?= APPURL?>/test/select_subjects.php">Take a test</a></li>
              <li><a class="dropdown-item" href="<?= APPURL?>/auth/logout.php">Log out</a></li>
            </ul>
          </li>
            
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-dark" href="<?= APPURL?>/auth/login.php">Login</a>
          </li>
                
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
