<?php
include "../../../../Connection/config.php";
//Proses Ubah
if(isset($_POST['ubahDokumen'])) {
  $kd   = $_POST['kode'];
  $nm   = $_POST['nama'];
  $berkas = $_FILES['berkas']['name'];
  $tmp    = $_FILES['berkas']['tmp_name'];
  // Rename nama filenya
  $berkasbaru = $kd.'.docx';
  // Set path folder tempat menyimpan file
  $path = "../../../../dokumen/".$berkasbaru;
  //-----------------------------------------------
  $fileExt = strtolower(pathinfo($berkas,PATHINFO_EXTENSION)); // get .* extension
  // valid pdf extensions
  $valid_extensions = array('doc','docx'); // valid extensions
  // allow valid pdf file formats
  if(in_array($fileExt, $valid_extensions)){
    // Jika syarat sudah terpenuhi
    if(move_uploaded_file($tmp, $path)){ // Cek apakah file berhasil diupload atau tidak
    // Proses simpan ke Database
    $query1 = "update dokumen set nama_dokumen='$nm', dokumen='$berkasbaru' where kd_dokumen='$kd'";
    $sql1   = mysql_query($query1);
      if ($sql1){
        header("Location: ../../index.php?hal=dok");
      }
    } else {
      // Jika file gagal diupload, Lakukan : 
      mysql_error();
      }
  } else {
    mysql_error();
    //header("Location: ../../index.php?hal=mmo&ubh=fail");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapusDokumen'])) {
  $kode = $_POST['kode'];
  //DELETE QUERY START
  $query1 = "delete from dokumen where kd_dokumen='$kode'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=dok");
  } else {
    header("Location: ../../index.php?hal=dok");
  }
  exit;
}
?>
