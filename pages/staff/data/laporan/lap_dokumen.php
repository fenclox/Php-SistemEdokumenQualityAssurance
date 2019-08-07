<?php
  include('../../../../connection/config.php');
  session_start(); //Mendapatkan Session

  date_default_timezone_set('Asia/Jakarta');
  function tglIndonesia($str){
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }

  ob_start();
  
  $staff = $_SESSION['kd_staff'];
  $bagian    = $_POST['bagian'];
  //Menampilkan bagian
  $q1 = "select * from bagian where kd_bagian='$bagian'";
  $q2 = mysql_query($q1);
  while($data = mysql_fetch_array($q2)){
    $bg = $data['nm_bagian'];
  };
  $tgl = $_POST['tanggal'];
  $dari = substr($tgl, 0,10);
  $sampai = substr($tgl, -10);
  $u_dari = date("Y-m-d", strtotime($dari));
  $u_sampai = date("Y-m-d", strtotime($sampai));

  $v_dari = tglIndonesia(date(" d F Y", strtotime($u_dari)));
  $v_sampai = tglIndonesia(date(" d F Y", strtotime($u_sampai)));
  //Report
  require ("../../../../html2pdf/html2pdf.class.php");
  $content = ob_get_clean();
  $content.= "
  <table border='1'>
  <tr>
    <td width='230'><h4 align='center'>PT. FAJARINDO FALIMAN ZIPPER</h4></td>
    <td width='500'><h4 align='center'>Laporan List Dokumen Per-bagian</h4></td>
  </tr>
  </table> <br>
  <table>
  <tr>
    <td width='365'><h5 align='left'> Dept. / Unit / Bagian : &nbsp; $bg</h5></td>
    <td width='370'><h5 align='right'>Tanggal : &nbsp; $v_dari &nbsp; s/d &nbsp; $v_sampai</h5></td>
  </tr>
  </table>
 
        <p align='center'>
        <table cellpadding='0' cellspacing='1' style='width: 210mm;' border=0.5>
          <tr bgcolor='#CCCCCC'>
            <th style='width: 30px; height: 20px'>#</th>
            <th style='width: 120px;'>Kd_dokumen</th>
            <th style='width: 415px;'>Nama Dokumen</th>
            <th style='width: 50px;'>Revisi</th>
            <th style='width: 120px;'>Tgl. Pengesahan</th>
          </tr>";
          // Menampilkan data
            $query = "SELECT a.kd_dokumen, a.tgl_pengesahan, a.nama_dokumen, a.status_revisi, a.tgl_pengesahan from dokumen a, bagian b  where SUBSTRING(kd_dokumen,-9,4)='$bagian' and tgl_pengesahan between '$u_dari' and '$u_sampai' GROUP by kd_dokumen asc";
            $tampil = mysql_query($query);
            $no = 1; // nomor baris
            while ($r = mysql_fetch_array($tampil)) {
              $content.="<tr bgcolor='#FFFFFF'>
                <td>$no</td>
                <td>$r[kd_dokumen]</td>
                <td style='text-transform:capitalize'>$r[nama_dokumen]</td>
                <td style='text-align:center'>$r[status_revisi]</td>
                <td style='text-align:center'>$r[tgl_pengesahan]</td>
              </tr>";
              $no++;
            }
          $content.="</table></p><br><br>";

  $filename="Pembayaran-".$bulan."-".$tahun.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya

  ob_end_clean();
  // conversion HTML => PDF
  try
  {
    $html2pdf = new HTML2PDF('P', 'A4','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->pdf->IncludeJS('print(TRUE)');
    $html2pdf->Output($filename);
  }
  catch(HTML2PDF_exception $e) { echo $e; }
?>

