<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img src="<?php base_url()?>../../assets/img/user_logo.png" class="profile-user-img img-fluid img-circle" 
          type="image/png" alt="foto <?php echo $data_profile->NM_PEGAWAI;?>">
    </div>

        <h3 class="profile-username text-center"><?php echo $data_profile->NM_PEGAWAI; ?></h3>

          <p class="text-muted text-center"><?php echo $data_profile->NIP; ?> / <?php echo $data_profile->NIP2 ?></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Status</b> <p class="float-right"><?php echo $data_profile->STATUS; ?></p>
              </li>
              <li class="list-group-item">
                <b>Nama Alias</b> <p class="float-right"><?php echo $data_profile->ALIAS; ?></p>
              </li>
              <?php if ($data_profile->AKSES==1) { ?>
                <li class="list-group-item">
                <b>Akses</b> <p class="float-right">ADMIN</p>
              </li>
              <?php } else { ?>
              <li class="list-group-item">
                <b>Akses</b> <p class="float-right">USER</p>
              </li>
              <?php } ?>
            </ul>
            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
  </div>
              <!-- /.card-body -->
</div>
            <!-- /.card -->