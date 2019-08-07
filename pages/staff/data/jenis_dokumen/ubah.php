<?php
  include "../../../../Connection/config.php";
  
  $tampil = mysql_query("SELECT * FROM jenis_dokumen where kd_jenis='".$_GET['q']."'");
  $r = mysql_fetch_array($tampil);
?>
<div class="form-group">
  <label>Kode Dokumen</label>
  <input name="kode" type="text" value="<?php echo $r['kd_jenis'];?>" class="form-control" placeholder="Masukkan Kode Dokumen" readonly="">
</div>
<div class="form-group">
  <label>Nama Dokumen</label>
  <input name="nama" type="text" value="<?php echo $r['nm_dokumen'];?>" class="form-control" placeholder="Masukkan Nama Dokumen" maxlength="50" required="" style='text-transform:capitalize' onkeypress='return isAlphabetKey(event)'>
</div>
