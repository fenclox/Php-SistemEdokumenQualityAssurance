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
    <div class="row">
      <div class="col-md-8">
        <?php
        if (isset($_GET['ubh'])) {
        if($_GET['ubh']=="success") {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Mengubah Data!
        </div>
        <?php } else if($_GET['ubh']=="fail"){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Mengubah Data!</h4>
        </div>
        <?php } 
        } ?>
      </div>
    </div>
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
              <th>KD_DOKUMEN</th>
              <th>NAMA DOKUMEN</th>
              <th style='text-align:center'>REVISI</th>
              <th style='text-align:center'>TANGGAL PENGESAHAN</th>
              <th style='text-align:center'>DOKUMEN</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.*, d.*, e.* from memo a, kepala_bagian b, bagian c, staff d, dokumen e where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and a.kd_memo=e.kd_memo and d.kd_staff='$staff' and status_dokumen='0' order by kd_dokumen desc";
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
              <a class="btn btn-success" href="../../dokumen/<?php echo $r['file'];?>" width="100" height="50"/><i class="glyphicon glyphicon-download-alt"></i></a>&nbsp;
              <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" value='<?php echo $r['kd_dokumen'];?>' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubahDokumen"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;
                <button type="button" class="btn btn-danger" value='<?php echo $r['kd_dokumen'];?>' onclick="hapusdata(this.value)" data-toggle="modal" data-target="#hapusDokumen"><i class="glyphicon glyphicon-trash"></i></button>
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
              <th>KD_DOKUMEN</th>
              <th>NAMA DOKUMEN</th>
              <th style='text-align:center'>REVISI</th>
              <th style='text-align:center'>TANGGAL PENGESAHAN</th>
              <th style='text-align:center'>DOKUMEN</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.*, d.*, e.* from memo a, kepala_bagian b, bagian c, staff d, dokumen e where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and a.kd_memo=e.kd_memo and d.kd_staff='$staff' and status_dokumen='1' order by tgl_pengesahan desc";
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
                <a class="button button-success" href="../../dokumen/<?php echo $r['file'];?>" width="100" height="50"/><i class="glyphicon glyphicon-download-alt"></i>
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
<!--////////////////////////////////////////// Modals //////////////////////////////////////////-->
<!--****************** Ubah ******************-->
<div class="modal fade" id="ubahDokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Dokumen</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
          <!-- form start -->
          <form role="form" method="POST" action="data/dokumen/proses.php" enctype="multipart/form-data">
            <div class="box-body">
              <!-- Ubah Data -->
              <span id="dub"></span>
              <!-- End Ubah Data -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button name="ubahDokumen" type="submit" class="btn btn-primary">Ubah</button>
            </div>
          </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--****************** Hapus ******************-->
<div class="modal fade" id="hapusDokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Dokumen</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
          <!-- form start -->
          <form role="form" method="POST" action="data/dokumen/proses.php">
            <div class="box-body">
              Yakin ingin menghapus data?
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" id="kd" name="id" value="">
              <button name="hapusDokumen" type="submit" class="btn btn-primary">Hapus</button>
            </div>
          </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
  <!--////////////////////////////////////////// End Modals //////////////////////////////////////////-->
<!-- Ubah & hapus data -->
<script>
function ubahdata(kd_dokumen){
    var ajaxbos = new XMLHttpRequest();
        ajaxbos.onreadystatechange= function(){
            if(ajaxbos.readyState==4 && ajaxbos.status==200){
                document.getElementById("dub").innerHTML= ajaxbos.responseText;
            }
        };
        ajaxbos.open("GET","data/dokumen/ubah.php?q="+kd_dokumen+"&s=#",true);
        ajaxbos.send();
    }
function hapusdata(kd_dokumen){
    document.getElementById('kd').value=kd_dokumen;
}
</script>
