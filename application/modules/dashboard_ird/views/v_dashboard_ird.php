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
                    <form action="" method="get">
                      <div class="float-sm-right col-md-2">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                      </div>
                      <div class="float-sm-right col-md-2">
                        <select class="form-control" name="year" id="tahun">
                          <option value="0">Tahun</option>
                          <?php foreach ($tahun_tanggal_kunjungan as $data) { ?>
                          <?php 
                            $selected = ''; 
                            if ($data->TAHUN == $year) {
                              $selected = 'selected';
                            } 
                          ?>
                          <option <?= $selected ?> value="<?=$data->TAHUN?>"><?=$data->TAHUN?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="float-sm-right col-md-2">
                        <select class="form-control" name="month" id="bulan">
                          <option value="0">Bulan</option>
                          <?php foreach ($bulan_tanggal_kunjungan as $number => $data) { ?>
                          <?php 
                            $selected = ''; 
                            if ($number == $month) {
                              $selected = 'selected';
                            } 
                          ?>
                          <option <?= $selected ?> value="<?=$number?>"><?=$data?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </form>
                </div>
                  <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="datatable1" style="width:100%" >
                      <thead>
                        <tr>
                          <th class="bg-default">NO</th>
                          <th class="bg-default">NO IRD</th>
                          <th class="bg-default">NAMA PASIEN</th>
                          <!-- <th class="bg-default">CARA KUNJUNGAN</th> -->
                          <th class="bg-default">JENIS KUNJUNGAN</th>
                          <th class="bg-default">CARA BAYAR</th>
                          <th class="bg-default">NAMA KONTRAKTOR</th>
                          <th class="bg-default">WAKTU KUJUNGAN</th>
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
                          <!-- <td class=""><?=$data->CARA_KUNJ;?></td> -->
                          <td class=""><?=$data->JENISKUNJRD;?></td>
                          <td class=""><?=$data->CARABAYARRD;?></td>
                          <td class=""><?=$data->NMKONTRAKTOR;?></td>
                          <td class=""><?=$data->TGLKUNJRD;?> | <?=$data->WAKTU;?></td>
                          <!-- <td class="">
                            <?php if ($data->TGLPJASA == NULL ) { ?>
                              <?php echo"BELUM BAYAR / DATA TIDAK TERSEDIA" ?>
                            <?php } else { ?>
                            <?php echo $data->TGLPJASA;?> | <?php echo $data->WAKTU_BAYAR;?>  
                              <?php } ?>
                          </td> -->
                          <td class="">
                            <?=substr($data->TIMEDIFF,'8','2') ?> Hari<br>
                            <?=substr($data->TIMEDIFF,'11','2') ?> Jam
                            <?=substr($data->TIMEDIFF,'14','2') ?> Menit
                            <?=substr($data->TIMEDIFF,'17','2') ?> Detik
                            (<?=substr($data->TIMEDIFF,'11','8') ?>)
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
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Dashboard Durasi Pasien IRD</h3>
                  </div>
                  <div class="card-body">
                    <h4 style="text-align:center;">Perbandingan Durasi Rawat Pasien IRD</h4>
                    <canvas id="donutChart" style="min-height: 250px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                    <?php
                    //Inisialisasi nilai variabel awal
                    foreach ($status_durasi as $data)
                    {
                        $data->DURASI;
                        $data->JUMLAH;
                    }
                    ?>
                  </div>
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
      "fixedHeader":true, "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
  });

  var durasi;
  var labels_durasi = new Array();
  var data_durasi = new Array();

  $(document).ready(function(){
    $("#tahun").change(function(){
      let a = $(this).val();
      console.log(a);
    });
    
    durasi = <?php echo json_encode($status_durasi) ?>;
    // console.log(durasi);
    for(i=0; i<durasi.length; i++){
      labels_durasi.push(durasi[i].DURASI);
    }
    for(i=0; i<durasi.length; i++){
      data_durasi.push(durasi[i].JUMLAH);
    }
    console.log(data_durasi);
  });



  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.\
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: 
          labels_durasi
      ,
      datasets: [
        {
          data: data_durasi,
          backgroundColor : ['#4CBB17', '#D2042D'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

  
</script>