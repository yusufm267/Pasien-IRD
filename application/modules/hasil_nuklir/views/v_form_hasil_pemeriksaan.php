    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Catatan:</h5>
              Data Hasil Pemeriksaan Sudah Diinputkan, Periksa Kembali Data Yang Dimasukan Pastikan Sudah Benar !
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Instalasi Kedokteran Nuklir
                    <small class="float-right"><?php echo date('d-M-Y'); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>Data Pasien</strong><br>
                    Nama: <?= $pasien->NAMA ?><br>
                    Tanggal Lahir : <?= $pasien->TGL_LAHIR ?><br>
                    Umur: <?= $pasien->UMUR ?> Tahun<br>
                    Alamat : <?= $pasien->ALAMAT ?>
                  </address>
                </div>
                <!-- /.col -->
                <!-- <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div> -->
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>No Medrec #<?= $pasien->NO_MEDREC ?></b><br>
                  <br>
                  <!-- <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567 -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Tanggal Kunjungan:</b> <?= $tglKunjungan ?><br>
                  <!-- <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567 -->
                </div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>ID Jenis Layanan</th>
                      <th>Nama Hasil</th>
                      <th>Kadar Hasil</th>
                      <th>Kadar Normal</th>
                      <th>Jenis RF</th>
                      <th>Dosis RF</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($hasil as $hsl) { ?>
                      <tr>
                        <td><?= $hsl->ID_JNS_LAYANAN ?></td>
                        <td><?= $hsl->NM_HASIL ?></td>
                        <td><?= $hsl->KADAR_HASIL ?></td>
                        <td><?= $hsl->KADAR_NORMAL ?></td>
                        <td><?= $hsl->JENIS_RF ?></td>
                        <td><?= $hsl->DOSIS_RF ?></td>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row no-print">
                <div class="col-12">
                  <a href="<?=base_url('hasil_nuklir/cetakHasilPemeriksaanNuk/' . $pasien->NO_MEDREC . '/' . $tglKunjungan) ?>" rel="noopener" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                  <a href="<?=base_url('hasil_nuklir/view_insert_hasil_nuklir/') ?>" class="btn btn-danger"><i class="fas fa-redo-alt"></i> Back</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
