<?php
session_start();
require_once("../../Connection/config.php");
$kd     = $_POST['kd_staff'];
$pass   = $_POST['password'];
$level  = $_POST['level'];

$query = mysql_query("SELECT * FROM staff WHERE kd_staff='$kd' AND password='$pass'");
    if(mysql_num_rows($query) == 0){
      ?>
      <script type="text/javascript">
          alert("Login Gagal");
          document.location="index.php";
      </script>
      <?php
    } else{
      $row = mysql_fetch_array($query);

      if ($row['level'] == 0 && $level == 0){
        //Mengambil session staff super
        $_SESSION['kd_staff']=$kd;
        $_SESSION['level']='staff_sup';
        header("Location:../staff_sup/index.php");
      } else if($row['level'] == 1 && $level == 1){
        //Mengambil session staff
        $_SESSION['kd_staff']=$kd;
        $_SESSION['level']='staff';
        header("Location:../staff/index.php");
      } else{
        ?>
        <script type="text/javascript">
            alert("Login Gagal");
            document.location="index.php";
        </script>
        <?php
      }
    }
  //Login Kabag
  $query1 = mysql_query("SELECT * FROM kepala_bagian WHERE kd_kabag='$kd' AND password='$pass'");
  $hasil2 = mysql_fetch_array($query1);
  if(mysql_num_rows($query1) == 0){
  ?>
    <script type="text/javascript">
        alert("Login Gagal");
        document.location="index.php";
    </script>
    <?php
  } else {
      $row1 = mysql_fetch_array($query1);
      if ($level == 2){
        //Mengambil session kepala bagian
        $_SESSION['kd_kabag']=$kd;
        header("Location:../kabag/index.php");
      } else {
        ?>
        <script type="text/javascript">
            alert("Login Gagal");
            document.location="index.php";
        </script>
        <?php
      }
    }
?>
