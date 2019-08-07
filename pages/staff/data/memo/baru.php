<?php
include "../../../../Connection/config.php";
$tampil2 = mysql_query("SELECT a.*, b.*, c.*, d.* from memo a, kepala_bagian b, jenis_dokumen c, bagian d where a.kd_kabag=b.kd_kabag and a.kd_jenis=c.kd_jenis and b.kd_bagian=d.kd_bagian and kd_memo='".$_GET['q']."'");
$r2 = mysql_fetch_array($tampil2);
?>
<div class="form-group">
  <label>Kode Memo</label>
  <input class="form-control"  name='kdm' value="<?php echo $r2['kd_memo'];?>" readonly="">
</div>
<div class="form-group">
  <label>Nama Dokumen</label>
  <input class="form-control" type="text"  name='nama' onkeypress="return isAlphabetKey(event)" maxlength="50" required="">
</div>
  <input class="form-control" type="hidden" name='kdj' value="<?php echo $r2['kd_jenis'];?>" readonly="">
  <input class="form-control" type="hidden" name='kdb' value="<?php echo $r2['kd_bagian'];?>" readonly="">
<div class="form-group">
  <label>File</label>
  <input name="berkas" type="file" required="" class="btn btn-default">
</div>