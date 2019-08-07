<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Memo / Daftar Memo
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
            if (isset($_GET['br'])) {
            if($_GET['br']=="success") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Memproses Data!
            </div>
            <?php } else { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Memproses Data, Gunakan File .doc atau .docx !</h4>
            </div>
            <?php }
            } else if (isset($_GET['rvs'])) {
            if($_GET['rvs']=="success") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Merevisi Data!</h4>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Merevisi Data!</h4>
            </div>
            <?php }
            } else if (isset($_GET['vld'])) {
            if($_GET['vld']=="fail") {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Merevisi Data, Gunakan File .doc atau .docx !</h4>
            </div>
            <?php }
            } else if (isset($_GET['hps'])) {
            if($_GET['hps']=="success") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Berhasil Menghapus Data!</h4>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Gagal Menghapus Data!</h4>
            </div>
            <?php }
            }
            ?>
          </div>
        </div>
    <!-- /////////////////////////////////////// Box Memo 1 /////////////////////////////////////// -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Memo - Tunggu</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="hidesrc4" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Memo</th>
              <th>Tgl Dibuat</th>
              <th>Status</th>
              <th>Kode Jenis</th>
              <th>Bagian</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $kabag = $_SESSION['kd_kabag'];
            $query = "SELECT a.*, b.*, c.* from memo a, kepala_bagian b, bagian c where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and status_memo='tunggu' and a.kd_staff=023000 order by kd_memo desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {?>
            <tr>
              <form action="data/memo/proses.php?<?php echo 'kd_memo='.$_GET['kd_memo']?>" method="post">
                <input type="hidden" name="memo" value="<?php echo $r['kd_memo']; ?>">
                <input type="hidden" name="staff" value="<?php echo $_SESSION['kd_staff']; ?>">
                <?php
                echo"
                <td>$no</td>
                <td>$r[kd_memo]</td>
                <td>$r[tgl_memo]</td>
                <td style='text-transform:capitalize'>$r[status_memo]</td>
                <td>$r[kd_jenis]</td>
                <td>$r[nm_bagian]</td>
                <td> ";?>
                  <button type="submit" name="ceklis" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i></button>&nbsp;
                  <button type="button" class="btn btn-warning" value='<?php echo $r['kd_memo'];?>' onclick="lihatdata(this.value)" data-toggle="modal" data-target="#detil"><i class="glyphicon glyphicon-eye-open"></i></button>
                </td>
              </form>
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
    <div class="row">
    <!-- /////////////////////////////////////// Box Memo 2-1 /////////////////////////////////////// -->
    <div class="col-md-4">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Memo - Proses (Baru)</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="hidesrc" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Kode Memo</th>
              <th width="50%"><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.* from memo a, kepala_bagian b, bagian c, staff d where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and status_memo='proses' and status_pengajuan='baru' and a.kd_staff='$staff' and d.kd_staff='$staff' order by kd_memo desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {?>
            <tr>
              <form action="data/memo/proses.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="memo" value="<?php echo $r['kd_memo']; ?>">
                <?php
                echo"
                <td>$no</td>
                <td width='20%'>$r[kd_memo]</td>
                <td width='35%'>"; ?>
                  <button type="button" class="btn btn-primary" value='<?php echo $r['kd_memo'];?>' onclick="baru(this.value)" data-toggle="modal" data-target="#baru"><i class="fa fa-upload"></i></button>
                &nbsp;
                  <button type="button" class="btn btn-warning" value='<?php echo $r['kd_memo'];?>' onclick="lihatdata(this.value)" data-toggle="modal" data-target="#detil"><i class="glyphicon glyphicon-eye-open"></i></button> &nbsp;
                  <a href="../../memo/<?php echo $r['isi_memo'];?>" width="100" height="50" class="btn btn-success"/><i class="glyphicon glyphicon-download-alt"></i>
                </td>
              </form>
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
    </div>
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
    <!-- /////////////////////////////////////// Box Memo 2-2 /////////////////////////////////////// -->
    <div class="col-md-4">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Memo - Proses (Revisi)</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="hidesrc2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Kode Memo</th>
              <th width="50%"><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.* from memo a, kepala_bagian b, bagian c, staff d where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and status_memo='proses' and status_pengajuan='revisi' and a.kd_staff='$staff' and d.kd_staff='$staff' order by kd_memo desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {?>
            <tr>
              <form action="data/memo/proses.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="memo" value="<?php echo $r['kd_memo']; ?>">
                <?php
                echo"
                <td>$no</td>
                <td width='20%'>$r[kd_memo]</td>
                <td width='35%'>"; ?>
                  <button type="button" class="btn btn-primary" value='<?php echo $r['kd_memo'];?>' onclick="revisi(this.value)" data-toggle="modal" data-target="#revisi"><i class="fa fa-edit"></i></button>
                &nbsp;
                  <button type="button" class="btn btn-warning" value='<?php echo $r['kd_memo'];?>' onclick="lihatdata(this.value)" data-toggle="modal" data-target="#detil"><i class="glyphicon glyphicon-eye-open"></i></button> &nbsp;
                  <a href="../../memo/<?php echo $r['isi_memo'];?>" width="100" height="50" class="btn btn-success"/><i class="glyphicon glyphicon-download-alt"></i>
                </td>
              </form>
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
    </div>
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
    <!-- /////////////////////////////////////// Box Memo 2-3 /////////////////////////////////////// -->
    <div class="col-md-4">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Memo - Proses (Hapus)</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="hidesrc3" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Kode Memo</th>
              <th width="50%"><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.* from memo a, kepala_bagian b, bagian c, staff d where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and status_memo='proses' and status_pengajuan='hapus' and a.kd_staff='$staff' and d.kd_staff='$staff' order by kd_memo desc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {?>
            <tr>
              <form action="data/memo/proses.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="memo" value="<?php echo $r['kd_memo']; ?>">
                <?php
                echo"
                <td>$no</td>
                <td width='20%'>$r[kd_memo]</td>
                <td width='35%'>"; ?>
                  <button type="button" class="btn btn-danger" value='<?php echo $r['kd_memo'];?>' onclick="hapus(this.value)" data-toggle="modal" data-target="#hapus"><i class="glyphicon glyphicon-remove"></i></button>
                &nbsp;
                  <button type="button" class="btn btn-warning" value='<?php echo $r['kd_memo'];?>' onclick="lihatdata(this.value)" data-toggle="modal" data-target="#detil"><i class="glyphicon glyphicon-eye-open"></i></button>  &nbsp;
                  <a href="../../memo/<?php echo $r['isi_memo'];?>" width="100" height="50" class="btn btn-success"/><i class="glyphicon glyphicon-download-alt"></i>
                </td>
              </form>
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
    </div>
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
    </div>
    <!-- /////////////////////////////////////// Box Memo 3 /////////////////////////////////////// -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Memo - Selesai</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example3" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Memo</th>
              <th>Tgl Dibuat</th>
              <th>Status</th>
              <th>Kode Jenis</th>
              <th>Bagian</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $staff = $_SESSION['kd_staff'];
            $query = "SELECT a.*, b.*, c.* from memo a, kepala_bagian b, bagian c, staff d where a.kd_kabag=b.kd_kabag and b.kd_bagian=c.kd_bagian and status_memo='selesai' and a.kd_staff='$staff' and d.kd_staff='$staff' order by kd_memo desc";
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
              <td>$r[nm_bagian]</td>
            </tr>
            ";
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
<!--****************** baru ******************-->
<div class="modal fade" id="baru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Unggah Dokumen</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
        <!-- form start -->
        <form role="form" method="post" action="data/memo/proses.php" enctype="multipart/form-data">
          <div class="box-body">
            <!-- Data -->
            <span id="br"></span>
            <!-- End Data -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button name="baru" type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--****************** revisi ******************-->
<div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Revisi Dokumen</h4>
      </div>
      <div class="modal-body">
        <!-- general form elements -->
        <!-- form start -->
        <form role="form" method="post" action="data/memo/proses.php" enctype="multipart/form-data">
          <div class="box-body">
            <!-- Data -->
            <span id="rvs"></span>
            <!-- End Data -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button name="revisi" type="submit" class="btn btn-primary">Revisi</button>
          </div>
        </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--****************** hapus ******************-->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        <form role="form" method="post" action="data/memo/proses.php">
          <div class="box-body">
            <!-- Data -->
            <span id="hps"></span>
            <!-- End Data -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button name="hapus" type="submit" class="btn btn-primary">Hapus</button>
          </div>
        </form>
        <!-- /.box -->
      </div>
    </div>
  </div>
</div>
<!--**************************************** /Modals ****************************************-->
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
function ceklisdata(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("ckl").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/memo.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
function baru(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("br").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/baru.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
function revisi(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("rvs").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/revisi.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
function hapus(kd_memo){
var ajaxbos = new XMLHttpRequest();
ajaxbos.onreadystatechange= function(){
if(ajaxbos.readyState==4 && ajaxbos.status==200){
document.getElementById("hps").innerHTML= ajaxbos.responseText;
}
};
ajaxbos.open("GET","data/memo/hapus.php?q="+kd_memo+"&s=#",true);
ajaxbos.send();
}
</script>