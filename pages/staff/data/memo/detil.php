<?php
include "../../../../Connection/config.php";
$tampil2 = mysql_query("SELECT a.*, b.*, c.*, d.* from memo a, kepala_bagian b, jenis_dokumen c, bagian d where a.kd_kabag=b.kd_kabag and a.kd_jenis=c.kd_jenis and b.kd_bagian=d.kd_bagian and kd_memo='".$_GET['q']."'");
$r2 = mysql_fetch_array($tampil2);
?>
<div class="form-group">
  <label>Kode Memo</label>
  <input class="form-control" value="<?php echo $r2['kd_memo'];?>" readonly="">
</div>
<div class="form-group">
  <label>Bagian</label>
  <input class="form-control" value="<?php echo $r2['nm_bagian'];?>" readonly="">
</div>
<div class="form-group">
  <label>Tanggal Dibuat</label>
  <input class="form-control" value="<?php echo $r2['tgl_memo'];?>" readonly="">
</div>
<div class="form-group">
  <label>Status Pengajuan</label>
  <input class="form-control" style="text-transform: capitalize;" value="<?php echo $r2['status_pengajuan'];?>" readonly="">
</div>
<div class="form-group">
  <label>Jenis Dokumen</label>
  <input class="form-control" style="text-transform: capitalize;" value="<?php echo $r2['kd_jenis'].' - '.$r2['nm_dokumen'];?>" readonly="">
</div>