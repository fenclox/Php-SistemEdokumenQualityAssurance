<?php error_reporting(0); ?>
<?php include"../../Connection/config.php";
session_start();
if(!isset($_SESSION['kd_staff'])){
    ?>
    <script >
        alert("Anda harus masuk terlebih dahulu");
        document.location="../login/index.php";
    </script>
    <?php
}
?>
<!-- Mengatur Tanggal Indonesia -->
<?php
  date_default_timezone_set('Asia/Jakarta');
  function tglIndonesia($str){
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman | Staff (QA)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- ////////////////// Onkeypress ////////////////// -->
  <script language="javascript">
    function isNumberKey(evt) //Number
    {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      console.log(charCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;

      return true;
    }
    function isUppercaseKey(evt) //Uppercase
    {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      console.log(charCode);
        if (charCode > 31 && (charCode < 65 || charCode > 90))
          return false;

      return true;
    }
    function isLowercaseKey(evt) //Lowercase
    {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      console.log(charCode);
        if (charCode > 31 && (charCode < 97 || charCode > 122))
          return false;

      return true;
    }
    function isAlphabetKey(evt) //Alphabet + spc
    {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      console.log(charCode);
        if (charCode > 32 && (charCode < 97 || charCode > 122))
          return false;

      return true;
    }
  </script>
  <!-- ////////////////// End Onkeypress ////////////////// -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="../../images/logo.gif" height="35" width="120"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="../../images/logo.gif" height="35" width="120"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php
            $kd = $_SESSION['kd_staff'];
            include "../../connection/config.php";
            $sql = "select kd_staff,nm_staff from staff where kd_staff='".$kd."'";
            $query = mysql_query($sql);
            while($data = mysql_fetch_array($query)){
              echo  "<br><p>" .$data['nm_staff']. "</b></p>";
            }
          ?>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <li><a href="index.php?hal=beranda"><i class="glyphicon glyphicon-home"></i> <span>Beranda</span></a></li>
        <li><a href="index.php?hal=jdok"><i class="glyphicon glyphicon-file"></i>
        <span>Jenis Dokumen</span></a></li>
        <li><a href="index.php?hal=bg"><i class="glyphicon glyphicon-briefcase"></i> <span>Bagian</span></a></li>
        <li><a href="index.php?hal=kabag"><i class="glyphicon glyphicon-user"></i> <span>Kepala Bagian</span></a></li>
        <li class="header">MENU LAINNYA</li>
        <li><a href="index.php?hal=mmo"><i class="glyphicon glyphicon-tags"></i> <span>Memo</span></a></li>
        <li><a href="index.php?hal=dok"><i class="glyphicon glyphicon-duplicate"></i> <span>Dokumen</span></a></li>
        <li><a href="index.php?hal=lap"><i class="glyphicon glyphicon-share-alt"></i> <span>Laporan Dokumen</span></a></li>
        <li class="header">MENU KELUAR</li>
        <li><a href="keluar.php"><i class="glyphicon glyphicon-off"></i> <span>Keluar</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
