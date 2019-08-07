<?php
include "../../../../Connection/config.php";
$tampil2 = mysql_query("SELECT a.*, b.*, c.*, d.* from memo a, kepala_bagian b, jenis_dokumen c, bagian d where a.kd_kabag=b.kd_kabag and a.kd_jenis=c.kd_jenis and b.kd_bagian=d.kd_bagian and kd_memo='".$_GET['q']."'");
$r2 = mysql_fetch_array($tampil2);
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
  <label>Kode Memo</label>
  <input name="kode" class="form-control" value="<?php echo $r2['kd_memo'];?>" readonly="">
</div>
<div class="form-group">
  <label>Jenis Dokumen</label>
  <?php
  echo '<select class="form-control select2" name="jenis" style="width:100%;" required="">';
    $query=mysql_query("SELECT * FROM jenis_dokumen");
    while($row=mysql_fetch_array($query)){
    echo "<option"; if($row['kd_jenis']==$r2['kd_jenis']){echo " selected=selected";}
    echo " value='".$row['kd_jenis']."'>".$row['kd_jenis'].' - '.$row['nm_dokumen']."</option>";
    }
  echo "</select>";
  ?>
</div>
<!-- radio -->
<div class="form-group">
  <label>Status Pengajuan Dokumen</label>
  <div class="radio">
    <label>
      <input type="radio" name="status" id="optionsRadios1" value="baru" <?php $ob->cek("baru",$r2['status_pengajuan'],"radio") ?>>
      Pembuatan Dokumen
    </label>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="status" id="optionsRadios1" value="revisi"<?php $ob->cek("revisi",$r2['status_pengajuan'],"radio") ?>>
      Perubahan Dokumen
    </label>
  </div>
  <div class="radio">
    <label>
      <input type="radio" name="status" id="optionsRadios1" value="hapus"<?php $ob->cek("hapus",$r2['status_pengajuan'],"radio") ?>>
      Penghapusan Dokumen
    </label>
  </div>
  <div class="form-group">
    <label>Isi Memo</label>
    <textarea name="isi" class="form-control" rows="3" placeholder="Masukkan Isi Memo" required=""><?php echo $r2['isi_memo'];?></textarea>
  </div>
  <!-- /.box-body -->