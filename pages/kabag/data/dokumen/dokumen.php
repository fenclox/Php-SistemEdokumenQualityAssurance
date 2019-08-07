<?php
$kabag = $_SESSION['kd_kabag'];
$q = mysql_query("select a.kd_kabag, b.kd_bagian from kepala_bagian a, bagian b where a.kd_bagian=b.kd_bagian and a.kd_kabag='$kabag'");
$r = mysql_fetch_array($q);
$bagian= $r['kd_bagian'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Dokumen
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- /////////////////////////////////////// Box 1 /////////////////////////////////////// -->
    <div class="box box-info">
      <div class="box-header">
      <h3 class="box-title">Dokumen - Aktif</h3>
      <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>DEPT./UNIT</th>
              <th>NO.FORM</th>
              <th>NAMA DOKUMEN</th>
              <th style='text-align:center'>REVISI</th>
              <th style='text-align:center'>TANGGAL PENGESAHAN</th>
              <th style='text-align:center'>DOKUMEN</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT a.*, b.*, c.*, d.*, e.* from memo a, kepala_bagian b, bagian c, kepala_bagian d, dokumen e where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and a.kd_memo=e.kd_memo and c.kd_bagian='$bagian' and status_dokumen='0' group by kd_dokumen order by tgl_pengesahan desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[nm_bagian]</td>
              <td>$r[kd_dokumen]</td>
              <td style='text-transform:capitalize'>$r[nama_dokumen]</td>
              <td style='text-align:center'>$r[status_revisi]</td>
              <td style='text-align:center'>$r[tgl_pengesahan]</td>
              <td style='text-align:center'>"?>
              <a href="../../dokumen/<?php echo $r['file'];?>" width="100" height="50"/><i class="glyphicon glyphicon-download-alt"></i>
            </td>
          </tr>
          <?php
          $no++;}
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
  <!-- /////////////////////////////////////// Box 2 /////////////////////////////////////// -->
    <div class="box box-danger">
      <div class="box-header">
      <h3 class="box-title">Dokumen - Tidak Aktif</h3>
      <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>DEPT./UNIT</th>
              <th>NO.FORM</th>
              <th>NAMA DOKUMEN</th>
              <th style='text-align:center'>REVISI</th>
              <th style='text-align:center'>TANGGAL PENGESAHAN</th>
              <th style='text-align:center'>DOKUMEN</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.*, d.*, e.* from memo a, kepala_bagian b, bagian c, kepala_bagian d, dokumen e where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and a.kd_memo=e.kd_memo and c.kd_bagian='$bagian' and status_dokumen='1' group by kd_dokumen order by tgl_pengesahan desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[nm_bagian]</td>
              <td>$r[kd_dokumen]</td>
              <td style='text-transform:capitalize'>$r[nama_dokumen]</td>
              <td style='text-align:center'>$r[status_revisi]</td>
              <td style='text-align:center'>$r[tgl_pengesahan]</td>
              <td style='text-align:center'>"?>
              <a href="../../dokumen/<?php echo $r['file'];?>" width="100" height="50"/><i class="glyphicon glyphicon-download-alt"></i>
            </td>
          </tr>
          <?php
          $no++;}
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
  <!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->