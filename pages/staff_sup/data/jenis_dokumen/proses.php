<?php
include "../../../../Connection/config.php";

//Proses Tambah
if(isset($_POST['tambah'])){
  $kd   = $_POST['kode'];
  $nm   = $_POST['nama'];
  //INSERT QUERY START
  $query1 = "insert into jenis_dokumen values('".$kd."','".$nm."')";
  $sql1   = mysql_query($query1);
  if ($sql1) {
      header("Location: ../../index.php?hal=jdok&tmb=success");
    } else {
      header("Location: ../../index.php?hal=jdok&tmb=fail");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $kd = $_POST['kode'];
  $nm = $_POST['nama'];
  //UPDATE QUERY START
  $query1 = "update jenis_dokumen set nm_dokumen='$nm' where kd_jenis='$kd'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=jdok&ubh=success");
  } else {
    header("Location: ../../index.php?hal=jdok&ubh=fail");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $kode = $_POST['kode'];
  //DELETE QUERY START
  $query1 = "delete from jenis_dokumen where kd_jenis='$kode'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=jdok&hps=success");
  } else {
    header("Location: ../../index.php?hal=jdok&hps=fail");
  }
  exit;
}
?>
