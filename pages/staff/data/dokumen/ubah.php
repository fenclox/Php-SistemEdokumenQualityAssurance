<?php
include "../../../../Connection/config.php";
$tampil2 = mysql_query("SELECT * from dokumen where kd_dokumen='".$_GET['q']."'");
$r2 = mysql_fetch_array($tampil2);
?>
<div class="form-group">
  <label>Kode Dokumen</label>
  <input name="kode" class="form-control" value="<?php echo $r2['kd_dokumen'];?>" readonly="">
</div>
<div class="form-group">
  <label>Nama Dokumen</label>
  <input type="text" name="nama" class="form-control" value="<?php echo $r2['nama_dokumen']?>" style='text-transform:capitalize' placeholder='Masukkan Nama Dokumen'>
</div>
<div class="form-group">
  <label>File</label>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="ubah_file" value="true"> Ceklis jika ingin mengubah file<br><br>
      <input type="file" name="file" class="btn btn-default" style="margin-left: -20px">
    </label>
  </div>
</div>