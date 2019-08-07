<?php
include "../../../../Connection/config.php";
session_start();
$p1=mysql_fetch_array(mysql_query("select password as 'pass' from kepala_bagian where kd_kabag='".$_SESSION['kd_kabag']."'"));
if($_POST['lama']==$p1['pass']){
  if($_POST['baru']==$_POST['baru1']){
    $ubah=mysql_query("update kepala_bagian set password='".$_POST['baru']."' where kd_kabag='".$_SESSION['kd_kabag']."'");
    if($ubah){
      header("Location: ../../index.php?hal=pfl&er=s");
    }
  }else{
    header("Location: ../../index.php?hal=pfl&er=0");
  }
}else{
  header("Location: ../../index.php?hal=pfl&er=1");
}
?>
