<div class="content-header">
    <div class="container">
        <!-- <div class="content">
          hahha
        </div> -->
    </div>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?=$subtitle?></h3>
                </div>
                  <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="datatable1" style="width:100%" >
                      <thead>
                        <tr>
                          <th class="bg-default">NO</th>
                          <th class="bg-default">NO IRD</th>
                          <th class="bg-default">NAMA PASIEN</th>
                          <th class="bg-default">TANGGAL KUJUNGAN</th>
                          <th class="bg-default">TANGGAL SELESAI</th>
                          <th class="bg-default">DURASI IRD</th>
                        </tr>
                     </thead>
                     <tbody> 
                            <?php
                            $no=1;
                            foreach ($pasien_ird as $data) {
                              ?>
                        <tr>
                          <td class=""><?=$no++;?></td>
                          <td class=""><?=$data->NO_IRD;?></td>
                          <td class=""><?=$data->NAMARD;?></td>
                          <td class=""><?=$data->TGLKUNJRD;?></td>
                          <td class=""></td>
                          <td class=""></td>
                          </td>
                        </tr>
                              <?php
                            }
                            ?>
                     </tbody>
                    </table>
                    </div>
                    </div>
                    <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<script>
    $(function () {
    $("#datatable1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
  });
</script>