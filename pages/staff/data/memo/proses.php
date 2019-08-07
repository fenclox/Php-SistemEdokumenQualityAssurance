<?php
include "../../../../Connection/config.php";
//set timezone jakarta
date_default_timezone_set("Asia/Jakarta");

//Proses Ceklis
if(isset($_POST['ceklis'])){
  $mmo  = $_POST['memo'];
  $stf  = $_POST['staff'];
  $sts  = 'proses';
  //Ceklis
  $query1 = "update memo set status_memo='$sts', kd_staff='$stf' where kd_memo='$mmo'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../../index.php?hal=mmo");
  } else {
     mysql_error();
  }
}
//Proses baru
if(isset($_POST['baru'])){
  //menambil kode
  //$jenis= str_replace(' ', '', $_POST['kdj'].'.');
  $jns  = $_POST['kdj'].'.';
  $bg   = $_POST['kdb'].'.';
  $abs  = $jns.$bg;
  //Auto number
  $query = "select MAX(RIGHT(kd_dokumen,4)) as max_id from dokumen where SUBSTRING(kd_dokumen,1,9)='$abs' ORDER BY kd_dokumen";  
  $sql   = mysql_query($query);
  $hasil = mysql_fetch_array($sql);
  $maxid = 0;
  $maxid = $hasil['max_id'];
  $maxid++;
  switch (strlen($maxid)) {
    case 1 :
        $idfix = "000" . $maxid;
        break;
    case 2 :
        $idfix = "00" . $maxid;
        break;
    case 3 :
        $idfix = "0" . $maxid;
        break;
    default :
        $idfix = $maxid;
        break;
  };
  //variabel
  $kd   = $abs.$idfix;
  $nm   = $_POST['nama'];
  $tgl  = date("Y-m-d");
  $memo = $_POST['kdm'];
  $jns  = $_POST['kdj'];
  $sts  = 'aktif';
  $rvs  = '0';
  $berkas = $_FILES['berkas']['name'];
  $tmp    = $_FILES['berkas']['tmp_name'];
  // Rename nama filenya
  $berkasbaru =$kd.'.docx';
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
    $sql1 = mysql_query("INSERT INTO dokumen VALUES ('$kd', '$nm', '$tgl', '$berkasbaru', '0', '', '$memo')");
  
    if ($sql1){
      header("Location: ../../index.php?hal=mmo&br=success");
    }
    } else {
    // Jika file gagal diupload, Lakukan : 
    mysql_error();
    }
  } else {
    header("Location: ../../index.php?hal=mmo&br=fail");
  }
} else if(isset($_POST['revisi'])){
        // Ambil data berkas yang dipilih dari form
  $mmo  = $_POST['kdm'];
  $dok  = $_POST['dokumen'];
  $berkas = $_FILES['berkas']['name'];
  $tmp = $_FILES['berkas']['tmp_name'];
  // Set path folder tempat menyimpan berkasnya
  $path = "../../../../dokumen/".$berkas;
  //-----------------------------------------------
  $fileExt = strtolower(pathinfo($berkas,PATHINFO_EXTENSION)); // get .* extension
  // valid pdf extensions
  $valid_extensions = array('doc','docx'); // valid extensions
  // allow valid pdf file formats
  if(in_array($fileExt, $valid_extensions)){
        // Proses upload
        if(move_uploaded_file($tmp, $path)){ // Cek apakah berkas berhasil diupload atau tidak
            $query = mysql_query("SELECT * from dokumen where kd_dokumen='".$dok."'");
            $data = mysql_fetch_array($query); // Ambil data dari hasil eksekusi $query
            // Cek apakah file berkas sebelumnya ada di folder 
            if(file_exists("../../../../dokumen/".$data['file'])){ // Jika berkas ada
                unlink("../../../../dokumen/".$data['file']); // Hapus file sebelumnya yang ada di folder
              }
            // Proses ubah data ke Database
            $sql = mysql_query("UPDATE dokumen SET file='".$berkas."', status_revisi=status_revisi+1 WHERE kd_dokumen='".$dok."'");
            $query1 = mysql_query("UPDATE memo SET status_memo='selesai' WHERE kd_memo='".$mmo."'");

            if($sql && $query1){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :
                header("location: ../../index.php?hal=mmo&rvs=success"); // Redirect ke halaman
            }else{
                // Jika Gagal, Lakukan :
                header("location: ../../index.php?hal=mmo&rvs=fail");
            }
        }else{
            /*// Jika berkas gagal diupload, Lakukan :
            ?>
            <script >
                window.location=history.go(-1);
                document.write("Gagal upload berkas");
            </script>
            <?php*/
            die ('uploaded file false');
        }
    } else {
            header("location: ../../index.php?hal=mmo&vld=fail");
        }
} else if(isset($_POST['hapus'])){
        // Ambil data berkas yang dipilih dari form
  $mmo  = $_POST['kdm'];
  $dok  = $_POST['dokumen'];
  
            // Proses ubah data ke Database
            $sql = mysql_query("UPDATE dokumen SET status_dokumen='1' WHERE kd_dokumen='".$dok."'");
            $query1 = mysql_query("UPDATE memo SET status_memo='selesai' WHERE kd_memo='".$mmo."'");

            if($sql && $query1){ // Cek jika proses simpan ke database sukses atau tidak
                // Jika Sukses, Lakukan :
                header("location: ../../index.php?hal=mmo&hps=success"); // Redirect ke halaman
            }else{
                // Jika Gagal, Lakukan :
                header("location: ../../index.php?hal=mmo&hps=fail");
            }
    } else { mysql_error();}
?>
