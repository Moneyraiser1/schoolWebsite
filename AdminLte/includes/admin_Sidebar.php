<aside class="main-sidebar" style="position: fixed; top: 0px;height: 100vh; overflow-y: auto; ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

        </div>
        <div class="pull-left info">


        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= isset($_GET['aDashboard']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?aDashboard">
            <i class="fa fa-dashboard text-white"></i> <span>Dashboard</span>
          </a>
          
        </li>
        
        <li class="<?= isset($_GET['category']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?category">
            <i class="fa fa-list-alt text-white"></i> <span>Category</span>
          </a>
        </li>
        <li class="<?= isset($_GET['product']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?product">
            <i class="fa fa-edit text-white"></i> <span>Product</span>
           
          </a>
        </li>
        <li class="<?= isset($_GET['order']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?order">
            <i class="fa fa-list text-white"></i> <span>Order-list</span>
          </a>
        </li>
        <li class="<?= isset($_GET['contact']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?contact">
            <i class="fa fa-phone text-white"></i> <span>Contact</span>
        
          </a>
        </li>
        <li class="<?= isset($_GET['gallery']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?gallery">
            <i class="fa fa-camera text-white"></i> <span>Gallery</span>
        
          </a>
        </li>
        <li class="<?= isset($_GET['register']) ? 'active' : '' ?>">
          <a href="adminDashboard.php?register">
            <i class="fa fa-registered text-primary"></i> <span>Register</span>

          </a>
        </li>
        <li class="">
          <a href="../auth/logout.php">
            <i class="fa fa-power-off text-danger"></i> <span>Logout</span>
    
          </a>
        </li>

  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>