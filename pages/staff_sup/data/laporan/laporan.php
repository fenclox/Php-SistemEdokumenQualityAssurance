<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Laporan Dokumen
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <form method="post" action="data/laporan/lap_dokumen.php">
          <div class="box-body">
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tanggal" type="text" class="form-control pull-right" id="reservation">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Proses</button>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Bagian</label>
                <select class="form-control select2" style="width: 100%;" name="bagian">
                  <?php
                  $query = mysql_query("select kd_bagian, nm_bagian from bagian ORDER by nm_bagian asc");
                  while ($row = mysql_fetch_array($query)){
                  echo "<option value=$row[kd_bagian]>$row[nm_bagian]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <!-- /.input group -->
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->