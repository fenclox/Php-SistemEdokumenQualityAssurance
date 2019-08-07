<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          case 'beranda'  : include 'beranda.php'; break;
          case 'pfl'     : include 'data/profil/profil.php'; break;

          case 'mmo'      : include 'data/memo/memo.php'; break;
          case 'mb'      : include 'data/memo/buat.php'; break;
          case 'mrvs'      : include 'data/memo/revisi.php'; break;
          case 'mhps'      : include 'data/memo/hapus.php'; break;

          case 'dok'      : include 'data/dokumen/dokumen.php'; break;

          default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>
