<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Memo / Buat Memo
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <?php
            if (isset($_GET['tmb'])) {
            if($_GET['tmb']=="success") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Menambahkan Data!
            </div>
            <?php } else { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Mengubah Data, Gunakan File .doc atau .docx !</h4>
            </div>
            <?php }
            }
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <form role="form" method="POST" action="data/memo/proses.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label>Bagian</label>
                  <?php 
                  $kd = $_SESSION['kd_kabag'];
                  $query= mysql_query("select a.*, b.* from bagian a, kepala_bagian b where a.kd_bagian=b.kd_bagian and kd_kabag='$kd'");
                  $r  = mysql_fetch_array($query);
                  ?>
                  <input name="bagian" class="form-control" value="<?php echo $r['nm_bagian'];?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label>Jenis Dokumen</label>
                  <select class="form-control select2" style="width: 100%;" name="jenis">
                    <?php
                      $query = mysql_query("select * from jenis_dokumen");
                      while ($row = mysql_fetch_array($query)){
                        echo "<option value=$row[kd_jenis]>$row[kd_jenis] - $row[nm_dokumen]</option>";
                      }
                    ?>
                  </select>
                </div>
                <!-- radio -->
                <div class="form-group">
                  <label>Status Pengajuan Dokumen</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="baru" checked>
                      Pembuatan Dokumen
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="revisi">
                      Perubahan Dokumen
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" id="optionsRadios1" value="hapus">
                      Penghapusan Dokumen
                    </label>
                  </div>
                  <div class="form-group">
                    <label>File</label>
                    <input name="berkas" type="file" required="" class="btn btn-default">
                  </div>
                  <input name="kds" type="hidden" class="form-control" value="023000">
                  <input name="kdk" type="hidden" class="form-control" value="<?php echo $_SESSION['kd_kabag']?>">
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button name="baru" type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->