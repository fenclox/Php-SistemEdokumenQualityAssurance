<?php
  include "../../../../Connection/config.php";
  
  $tampil = mysql_query("SELECT * FROM staff where kd_staff='".$_GET['q']."'");
  $r = mysql_fetch_array($tampil);
?>
<div class="form-group">
  <label>Kode Staff</label>
  <input name="kode" type="text" value="<?php echo $r['kd_staff'];?>" class="form-control" placeholder="Kode Otomatis" readonly="">
</div>
<div class="form-group">
  <label>Nama Lengkap</label>
  <input name="nama" type="text" value="<?php echo $r['nm_staff'];?>" class="form-control" placeholder="Masukkan Nama Lengkap" maxlength="50" required="" onkeypress="return isAlphabetKey(event)" style='text-transform:capitalize'>
</div>
<div class="form-group">
  <label>Kata Sandi</label>
  <input name="password" type="password" value="<?php echo $r['password'];?>" class="form-control" placeholder="Masukkan Kata Sandi"  maxlength="15" required="">
</div>
