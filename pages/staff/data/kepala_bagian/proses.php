<?php
include "../../../../Connection/config.php";

$bg    = $_POST['bagian'];

$query = "select MAX(RIGHT(kd_kabag,1)) as max_id from kepala_bagian where kd_bagian='$bg' ORDER BY kd_kabag" or die (mysql_error());
$sql   = mysql_query($query);
$hasil = mysql_fetch_array($sql);
$maxid = 0;
$maxid = $hasil['max_id'];
$maxid++;
//Proses Tambah
if(isset($_POST['tambah'])){
  $kd    = $bg.$maxid;
  $nm    = $_POST['nama'];
  $alm   = $_POST['alamat'];
  $telp  = $_POST['telp'];
  $pass  = "test";
  $kds = $_POST['kds'];
  //INSERT QUERY START
  $query1 = "insert into kepala_bagian values('".$kd."','".$nm."','".$alm."','".$telp."','".$pass."','".$bg."','".$kds."')";
  $sql1   = mysql_query($query1);
  if ($sql1) {
      header("Location: ../../index.php?hal=kabag&tmb=success");
    } else {
      die (mysql_error());
      header("Location: ../../index.php?hal=kabag&tmb=fail");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $kd    = $_POST['kode'];
  $nm    = $_POST['nama'];
  $alm   = $_POST['alamat'];
  $telp  = $_POST['telp'];
  $pass  = $_POST['pass'];
  $kds   = $_POST['kds'];
  //UPDATE QUERY START
  $query1 = "update kepala_bagian set nm_kabag='$nm', alamat='$alm', no_telp='$telp', password='$pass' where kd_kabag='$kd'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=kabag&ubh=success");
  } else {
    header("Location: ../../index.php?hal=kabag&ubh=fail");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $kode = $_POST['kode'];
  //DELETE QUERY START
  $query1 = "delete from kepala_bagian where kd_kabag='$kode'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=kabag&hps=success");
  } else {
    header("Location: ../../index.php?hal=kabag&hps=fail");
  }
  exit;
}
?>
