<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Memo / Data Memo
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- /////////////////////////////////////// Box Memo /////////////////////////////////////// -->
    <div class="box box-info">
      <div class="box-header">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <?php
            if (isset($_GET['ubh'])) {
            if($_GET['ubh']=="success") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Mengubah Data!</h4>
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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Memo</th>
              <th>Tgl Dibuat</th>
              <th>Status</th>
              <th>Kode Jenis</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $kabag = $_SESSION['kd_kabag'];
            $query = "SELECT * from memo where kd_kabag='$kabag' order by kd_memo desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[kd_memo]</td>
              <td>$r[tgl_memo]</td>
              <td style='text-transform:capitalize'>$r[status_memo]</td>
              <td>$r[kd_jenis]</td>
              <td> "; ?>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" value='<?php echo $r['kd_memo'];?>' onclick="lihatdata(this.value)" data-toggle="modal" data-target="#detil"><i class="glyphicon glyphicon-eye-open"></i></button>&nbsp;
                <button type="button" class="btn btn-primary" value='<?php echo $r['kd_memo'];?>' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;
                <a href="../../memo/<?php echo $r['isi_memo'];?>" width="100" height="50" class="btn btn-success"/><i class="glyphicon glyphicon-download-alt"></i>
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--**************************************** Modals ****************************************-->
<!--****************** Detil ******************-->
<div class="modal fade" id="detil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detil Memo</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
        <!-- form start -->
        <form role="form">
          <div class="box-body">
            <span id="ddtl"></span>
          </div>
          <!-- /.box-body -->
        </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--****************** Ubah ******************-->
<div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Memo</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
        <!-- form start -->
        <form role="form" method="post" action="data/memo/proses.php" enctype="multipart/form-data">
          <div class="box-body">
            <!-- Ubah Data -->
            <span id="dub"></span>
            <!-- End Ubah Data -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button name="ubah" type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--****************** Hapus ******************-->
<!--div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Hapus Bagian</h4>
    </div>
    <div class="modal-body">
      <!-- general form elements -->
      <!-- form start -->
      <!--form role="form" method="POST" action="data/bagian/proses.php">
      <div class="box-body">
        Yakin ingin menghapus data?
      </div>
      <!-- /.box-body -->
      <!--div class="box-footer">
      <input type="hidden" id="kbg" name="kode" value="">
      <button name="hapus" type="submit" class="btn btn-primary">Hapus</button>
    </div>
  </form>
  <!-- /.box -->
  <!--/div>
</div>
</div>
</div>
<!--**************************************** /Modals ****************************************-->
<!-- lihat & ubah data -->
<script>
function lihatdata(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("ddtl").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/detil.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
function ubahdata(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("dub").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/ubah.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
//function hapusdata(kd_memo){
//document.getElementById('km').value=kd_memo;
//}
</script>