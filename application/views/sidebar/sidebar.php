<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=base_url()?>assets/img/logo-site2.png" alt="RSHS Logo" class="brand-image img-circle elevation-8" style="opacity: .8">
      <span class="brand-text font-weight-light">Kelola Nuklir</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>assets/img/user_logo.png" class="img-circle elevation-2" alt="<?php echo $this->session->userdata('nm_pegawai') ?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('nm_pegawai') ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul id=nav class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">KELOLA ADMIN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('dashboard') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Utama</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($this->session->userdata('akses')=="1") { ?>
          <!--Start Sidebar Menu User -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("/users/") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("/users/dataDokter") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Dokter</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- END Sidebar Menu User -->
        <?php } ?>

        <?php if ($this->session->userdata('akses')=="1" OR $this->session->userdata('akses')=="2" ) { ?>
          <!-- Start Sidebar Menu Jenis Hasil Nuklir -->
          <li class="nav-header">KELOLA NUKLIR</li>
          <li class="nav-item">
            <a href="<?php echo base_url('/hasil_nuklir/view_insert_hasil_nuklir/') ?>" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Input Hasil Nuklir</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-flask"></i>
              <p>
                Daftar Hasil Nuklir
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("/hasil_nuklir/") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Master Jenis Hasil Nuklir</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("/hasil_nuklir/jenis_rf") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Master Jenis Radiofarma</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("/hasil_nuklir/pemeriksaan_nuklir")?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Pemeriksaan Nuklir</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- END Sidebar Menu Jenis Hasil Nuklir -->
        <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<script type="text/javascript">

  /** add active class and stay opened when selected **/
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function(){
    return this.href == url;
  }).addClass('active');

  // for treeview
  $('ul.nav-treeview a').filter(function(){
    return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
  
</script>