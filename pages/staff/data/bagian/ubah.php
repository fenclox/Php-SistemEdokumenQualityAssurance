<?php
  include "../../../../Connection/config.php";
  
  $tampil = mysql_query("SELECT * FROM bagian where kd_bagian='".$_GET['q']."'");
  $r = mysql_fetch_array($tampil);
?>
<div class="form-group">
  <label>Kode Bagian</label>
  <input name="kode" type="text" value="<?php echo $r['kd_bagian'];?>" class="form-control" placeholder="Masukkan Kode Bagian" readonly="">
</div>
<div class="form-group">
  <label>Nama Bagian</label>
  <input name="nama" type="text" value="<?php echo $r['nm_bagian'];?>" class="form-control" placeholder="Masukkan Nama Bagian" maxlength="50" required="" style='text-transform:capitalize' onkeypress='return isAlphabetKey(event)'>
</div>
