<!-- <?php
  if ($this->session->userdata('message'))
  {
    echo "<script>showSwal('".($this->session->userdata('message')['type'])."','".($this->session->userdata('message')['message'])."','".($this->session->userdata('message')['head'])."');</script>";
  }
?> -->
<!-- <?php var_dump($data_hasil_jenis_nuklir) ?> -->
<!-- general form elements -->
<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title">Update Users Nuklir</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="<?php echo base_url("hasil_nuklir/update/" . $data_hasil_jenis_nuklir->ID_JENIS) ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA HASIL</label>
                        <input type="text" class="form-control" name="NM_HASIL" value="<?php echo $data_hasil_jenis_nuklir->NM_HASIL; ?>" >
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">KADAR NORMAL</label>
                        <input type="text" class="form-control" name="KADAR_NORMAL" value="<?php echo $data_hasil_jenis_nuklir->KADAR_NORMAL; ?>" >
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">SATUAN</label>
                        <input type="text" class="form-control" name="SATUAN" value="<?php echo $data_hasil_jenis_nuklir->SATUAN; ?>" >
                    </div>
                </div>
            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update Data</button>
    </div>
    </form>
</div>
<!-- /.card -->

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>