<?php
include "../../../../Connection/config.php";
//Proses Ubah
if(isset($_POST['ubahDokumen'])) {
  $kd   = $_POST['kode'];
  $nm   = $_POST['nama'];
// Cek apakah user ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_file'])){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
// Ambil data foto yang dipilih dari form
  $file = $_FILES['file']['name'];
  $tmp  = $_FILES['file']['tmp_name'];
  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $berkasbaru = $kd.'.docx';
  // Set path folder tempat menyimpan fotonya
  $path = "../../../../dokumen/".$berkasbaru;
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
  // Query untuk menampilkan data spv berdasarkan NIS yang dikirim
  $query =  mysql_query("SELECT * from dokumen where kd_dokumen='$kd'");
  $data = mysql_fetch_array($query); // Ambil data dari hasil eksekusi $query
  // Cek apakah file file sebelumnya ada di folder file
  //if(file_exists("../../../../dokumen/".$data['file'])){ // Jika file ada
  //unlink("../../../../dokumen/".$data['file']); // Hapus file file sebelumnya yang ada di folder file
  //}
  // Proses ubah data ke Database
  $query =  mysql_query("update dokumen set nama_dokumen='$nm', file='$berkasbaru' where kd_dokumen='$kd'");
  if($query){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  header("location: ../../index.php?hal=dok&ubh=success"); // Redirect ke halaman
  }else{
  // Jika Gagal, Lakukan :
  //header("location: ../../index.php?hal=spv&tmb=fail");
  mysql_error();
  }
  }else{
  /*// Jika gambar gagal diupload, Lakukan :
  ?>
  <script >
  window.location=history.go(-1);
  document.write("Gagal upload gambar");
  </script>
  <?php*/
  die ('uploaded file false');
  }
  }else{ // Jika user tidak menceklis checkbox yang ada di form ubah, lakukan :
  // Proses ubah data ke Database
  $sql =  mysql_query("update dokumen set nama_dokumen='$nm' where kd_dokumen='$kd'");
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: ../../index.php?hal=dok&ubh=success"); // Redirect ke halaman
      // Jika Gagal, Lakukan :
      ?>
      <script >
      window.location=history.go(-1);
      </script>
      <?php
    }
  }
}

//Proses Hapus
else if(isset($_POST['hapusDokumen'])) {
  $kode = $_POST['id'];

  //DELETE QUERY START
  $query =  mysql_query("SELECT * from dokumen where kd_dokumen='$kode'");
  $data = mysql_fetch_array($query); // Ambil data dari hasil eksekusi $query
  // Cek apakah file file sebelumnya ada di folder file
  if(file_exists("../../../../dokumen/".$data['file'])){ // Jika file ada
  unlink("../../../../dokumen/".$data['file']); // Hapus file file sebelumnya yang ada di folder file
  }

  $query1 = "delete from dokumen where kd_dokumen='$kode'";
  unlink("../../../../dokumen/".$data['file']); // Hapus file file sebelumnya yang ada di folder file
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=dok");
  } else {
    header("Location: ../../index.php?hal=dok");
  }
  exit;
}
?>
