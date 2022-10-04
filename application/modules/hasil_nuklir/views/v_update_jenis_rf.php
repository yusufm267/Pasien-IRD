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
        <h3 class="card-title">Update Jenis RF</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">JENIS HASIL</label>
                        <input type="text" class="form-control" name="JENIS_RF" value="<?php echo $data_jenis_rf->JENIS_RF; ?>" >
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