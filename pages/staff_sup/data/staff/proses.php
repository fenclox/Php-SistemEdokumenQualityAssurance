<?php
include "../../../../Connection/config.php";

$bg    = '023';
$query = "select MAX(RIGHT(kd_staff,3)) as max_id from staff ORDER BY kd_staff";
$sql   = mysql_query($query);
$hasil = mysql_fetch_array($sql);
$maxid = 0;
$maxid = $hasil['max_id'];
$maxid++;
switch (strlen($maxid)) {
  case 1 :
      $idfix = "00" . $maxid;
      break;
  case 2 :
      $idfix = "0" . $maxid;
      break;
  default :
      $idfix = $maxid;
      break;
};
//Proses Tambah
if(isset($_POST['tambah'])){
  $kd   = $bg . $idfix;
  $nm   = $_POST['nama'];
  $pass = "test";
  $lvl  = 1;
  //INSERT QUERY START
  $query1 = "insert into staff values('".$kd."','".$nm."','".$pass."','".$lvl."')";
  $sql1   = mysql_query($query1);
  if ($sql1) {
      header("Location: ../../index.php?hal=stf&tmb=success");
    } else {
      header("Location: ../../index.php?hal=stf&tmb=fail");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $kd = $_POST['kode'];
  $nm = $_POST['nama'];
  $pass = $_POST['password'];
  //UPDATE QUERY START
  $query1 = "update staff set nm_staff='$nm',password='$pass'where kd_staff='$kd'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=stf&ubh=success");
  } else {
    header("Location: ../../index.php?hal=stf&ubh=fail");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $kode = $_POST['kode'];
  //DELETE QUERY START
  $query1 = "delete from staff where kd_staff='$kode'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=stf&hps=success");
  } else {
    header("Location: ../../index.php?hal=stf&hps=fail");
  }
  exit;
}
?>
