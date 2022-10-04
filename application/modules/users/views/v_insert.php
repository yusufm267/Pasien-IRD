<!-- <?php var_dump($data_users_nuklir) ?> -->
<!-- general form elements -->
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Users Nuklir</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="<?php echo base_url("users/insert_user") ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                          <label for="inputError">NIP</label>
                          <input type="text" class="form-control <?=form_error('NIP') ? 'is-invalid' : null ?>" name="NIP" placeholder="Masukan NIP" value="<?=set_value('NIP'); ?>">
                          <?=form_error('NIP'); ?>
                      </div>
                </div>
                <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                          <label for="exampleInputEmail1">ALIAS</label>
                          <input type="text" class="form-control <?=form_error('ALIAS') ? 'is-invalid' : null ?>" name="ALIAS" placeholder="Masukan ALIAS" value="<?=set_value('ALIAS'); ?>">
                          <?=form_error('ALIAS'); ?>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKSES</label>
                        <select class="form-control select"  name="AKSES">
                            <option value="">-- SELECT AKSES --</option> 
                            <option value=1>ADMIN</option>
                            <option value=2>STAFF</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKTIF</label>           
                        <select class="form-control select" name="AKTIF">
                            <option value="">-- SELECT AKTIF --</option>
                            <option value=1>AKTIF</option>
                            <option value=0>TIDAK AKTIF</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STATUS</label>
                        <input type="text" class="form-control" name="STATUS" placeholder="Contoh : Dokter">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STAF</label>
                        <select class="form-control select" name="STAF">
                            <option value="">-- SELECT STAF --</option>
                            <option value="Y">YA</option>
                            <option value="N">TIDAK</option>    
                        </select>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Insert Data</button>
        <button type="reset" class="btn btn-default">Reset</button>
            <div class="float-right">
                <a href="<?php echo base_url(). 'users/'?>" type="button" id="btn_to_action" class="btn btn-danger"><b>Back</b></a>
            </div>
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