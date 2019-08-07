<?php
include "../../../../Connection/config.php";
//set timezone jakarta
date_default_timezone_set("Asia/Jakarta");
//mengambil tahun & bulan 2 digit
$ym    =  date('ym'); 
//menjadikan 4 digit pertama kode -> ym (tahun,tanggal) dan mereset kode setelah tahun atau dan bulan berganti
$query = "select MAX(RIGHT(kd_memo,3)) as max_id from memo where LEFT(kd_memo, 4)='$ym' ORDER BY kd_memo"; 
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
if(isset($_POST['baru'])){
  $kd     = $ym.$idfix;
  $tgl    = date("Y-m-d");
  $stsp   = $_POST['status'];
  $stsm   = 'tunggu';
  $stf    = $_POST['kds'];
  $kabag  = $_POST['kdk'];
  $jns    = $_POST['jenis'];

  $berkas = $_FILES['berkas']['name'];
  $tmp    = $_FILES['berkas']['tmp_name'];
  // Rename nama filenya
  $berkasbaru = $kd.'.docx';
  // Set path folder tempat menyimpan file
  $path = "../../../../memo/".$berkasbaru;
  //-----------------------------------------------
  $fileExt = strtolower(pathinfo($berkas,PATHINFO_EXTENSION)); // get .* extension
  // valid pdf extensions
  $valid_extensions = array('doc','docx'); // valid extensions
  // allow valid pdf file formats
  if(in_array($fileExt, $valid_extensions)){
    // Jika syarat sudah terpenuhi
    if(move_uploaded_file($tmp, $path)){ // Cek apakah file berhasil diupload atau tidak
    // Proses simpan ke Database
    $query1 = "insert into memo values('".$kd."','".$tgl."','".$stsp."','".$berkasbaru."','".$stsm."','".$stf."','".$kabag."','".$jns."')";
    $sql1   = mysql_query($query1);
      if ($sql1){
        header("Location: ../../index.php?hal=mb&tmb=success");
      }
    } else {
      // Jika file gagal diupload, Lakukan : 
      mysql_error();
      }
  } else {
    mysql_error();
    header("Location: ../../index.php?hal=mb&tmb=fail");
  }
}
//Proses Ubah
// $query1 = "update memo set kd_jenis='$jns', status_pengajuan='$sts', isi_memo='$isi' where kd_memo='$kd'";
else if(isset($_POST['ubah'])) {
  $kd   = $_POST['kode'];
  $jns  = $_POST['jenis'];
  $sts  = $_POST['status'];
  $berkas = $_FILES['berkas']['name'];
  $tmp    = $_FILES['berkas']['tmp_name'];
  // Rename nama filenya
  $berkasbaru = $kd.'.docx';
  // Set path folder tempat menyimpan file
  $path = "../../../../memo/".$berkasbaru;
  //-----------------------------------------------
  $fileExt = strtolower(pathinfo($berkas,PATHINFO_EXTENSION)); // get .* extension
  // valid pdf extensions
  $valid_extensions = array('doc','docx'); // valid extensions
  // allow valid pdf file formats
  if(in_array($fileExt, $valid_extensions)){
    // Jika syarat sudah terpenuhi
    if(move_uploaded_file($tmp, $path)){ // Cek apakah file berhasil diupload atau tidak
    // Proses simpan ke Database
    $query1 = "update memo set kd_jenis='$jns', status_pengajuan='$sts', isi_memo='$berkasbaru' where kd_memo='$kd'";
    $sql1   = mysql_query($query1);
      if ($sql1){
        header("Location: ../../index.php?hal=mmo&ubh=success");
      }
    } else {
      // Jika file gagal diupload, Lakukan : 
      mysql_error();
      }
  } else {
    mysql_error();
    header("Location: ../../index.php?hal=mmo&ubh=fail");
  }
//UPDATE QUERY END
}
/*
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
*/
?>
