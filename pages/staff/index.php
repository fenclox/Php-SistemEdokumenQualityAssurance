<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          case 'beranda'  : include 'beranda.php'; break;
          case 'jdok'     : include 'data/jenis_dokumen/jenis_dokumen.php'; break;
          case 'bg'       : include 'data/bagian/bagian.php'; break;
          case 'kabag'    : include 'data/kepala_bagian/kepala_bagian.php'; break;
          case 'mmo'      : include 'data/memo/memo.php'; break;
          case 'dok'      : include 'data/dokumen/dokumen.php'; break;
          case 'lap'      : include 'data/laporan/laporan.php'; break;

          default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>
