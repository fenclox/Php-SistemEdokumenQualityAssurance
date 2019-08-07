<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Beranda
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="callout callout-info">
      <!--h4>Tip!</h4-->
      <center><b>APLIKASI E-DOCUMENT DEPARTEMENT QUALITY ASSURANCE</b></center>
      <?php
      $kd = $_SESSION['kd_staff'];
      include "../../connection/config.php";
      $sql = "select kd_staff,nm_staff from staff where kd_staff='".$kd."'";
      $query = mysql_query($sql);
      while($data = mysql_fetch_array($query)){
      echo "<p>Selamat datang, " . $data['nm_staff'] . " [" . $data['kd_staff'] . "]</p>";
      }
      ?>
    </div>
    <div class="row" style="margin-top: 100px">
      <div class="col-md-10 col-md-offset-1"><div class="box box-info">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-4">
              <img class="img-responsive" src="../../images/bintang2.jpg" height="150" width="150">
            </div>
            <div class="col-md-4"><h3><center>PT. FAJARINDO FALIMAN ZIPPER</center></h3>
            </div>
            <div class="col-md-4">
              <img class="img-responsive" src="../../images/logo.gif">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->