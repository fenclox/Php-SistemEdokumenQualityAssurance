<?php
  include "../../../../Connection/config.php";

  $tampil = mysql_query("SELECT * FROM kepala_bagian where kd_kabag='".$_GET['q']."'");
  $r = mysql_fetch_array($tampil);
  //Fungsi Cek\
  class selected{
      function cek($val,$sel,$tipe){
          if($val==$sel){
              switch($tipe){
                  case 'select' :echo "selected"; break;
                  case 'radio' :echo "checked"; break;
              }
          }else{
              echo "";
          }
      }
  }
  $ob = new selected();
?>
<div class="form-group">
  <label>Kode Kepala Bagian</label>
  <input name="kode" type="text" value="<?php echo $r['kd_kabag']?>" maxlength="4" onkeypress="return isNumberKey(event)" class="form-control" required="" readonly="">
</div>
<div class="form-group">
  <label>Nama Lengkap</label>
  <input name="nama" type="text" value="<?php echo $r['nm_kabag']?>" class="form-control" placeholder="Masukkan Nama Kepala Bagian" maxlength="50" required="" style='text-transform:capitalize' onkeypress='return isAlphabetKey(event)'>
</div>
<div class="form-group">
  <label>Alamat</label>
  <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat"><?php echo $r['alamat']?></textarea>
</div>
<div class="form-group">
  <label>Nomor Telepon</label>
  <input name="telp" type="text" value="<?php echo $r['no_telp']?>" class="form-control" placeholder="Masukkan Nomor Telepon" onkeypress="return isNumberKey(event)" maxlength="15" required="">
</div>
<div class="form-group">
  <label>Kata Sandi</label>
  <input name="pass" type="password" value="<?php echo $r['password']?>" class="form-control" placeholder="Masukkan Kata Sandi" required="">
</div>
<input name="kds" type="hidden" class="form-control" value="<?php echo $_SESSION['kd_staff']?>">
