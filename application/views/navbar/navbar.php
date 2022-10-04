<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user">&nbsp;</i><?php echo $this->session->userdata('alias'); ?> <i class="fas fa-caret-down"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $this->session->userdata('nm_pegawai'); ?></span>
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('/users/profile/'. getUserLogin()['nip']) ?>" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> User Profile 
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('login/logout') ?>" class="dropdown-item dropdown-footer" onClick="checker()">Logout <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <script> 
    function checker() {
      let result = confirm('Anda Yakin Akan Keluar Dari Laman Ini?');
      if (result == false) {
        event.preventDefault();
      }
    }
  </script>