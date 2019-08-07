<?php
include "../../../../Connection/config.php";

//Proses Tambah
if(isset($_POST['tambah'])){
  $kd   = $_POST['kode'];
  $nm   = $_POST['nama'];
  //INSERT QUERY START
  $query1 = "insert into bagian values('".$kd."','".$nm."')";
  $sql1   = mysql_query($query1);
  if ($sql1) {
      header("Location: ../../index.php?hal=bg&tmb=success");
    } else {
      header("Location: ../../index.php?hal=bg&tmb=fail");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $kd = $_POST['kode'];
  $nm = $_POST['nama'];
  //UPDATE QUERY START
  $query1 = "update bagian set nm_bagian='$nm' where kd_bagian='$kd'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=bg&ubh=success");
  } else {
    header("Location: ../../index.php?hal=bg&ubh=fail");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $kode = $_POST['kode'];
  //DELETE QUERY START
  $query1 = "delete from bagian where kd_bagian='$kode'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=bg&hps=success");
  } else {
    header("Location: ../../index.php?hal=bg&hps=fail");
  }
  exit;
}
?>
