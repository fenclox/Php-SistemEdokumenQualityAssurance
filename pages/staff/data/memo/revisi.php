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
  <label>Dokumen</label>
  <select class="form-control select2" style="width: 100%;" name="dokumen" required="">
    <?php
    $query = mysql_query("select * from dokumen where status_dokumen='0' ORDER by kd_dokumen desc ");
    while ($row = mysql_fetch_array($query)){
    echo "<option value=$row[kd_dokumen]>$row[kd_dokumen] - $row[nama_dokumen]</option>";
    }
    ?>
  </select>
</div>
<div class="form-group">
  <label>File</label>
  <input name="berkas" type="file" required="" class="btn btn-default">
</div>