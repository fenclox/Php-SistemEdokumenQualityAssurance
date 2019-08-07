<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman | Masuk</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../cdnjs/ajax/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../cdnjs/ajax/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../../https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="../../https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-body">
                <div class="row">
                    <center><h2  class="text-blue">PT. FAJARINDO FALIMAN ZIPPER</h2></center>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ********************************** Login Pegawai ********************************** -->
        <div class="login-box" style="margin-top: 0">
          <!-- /.login-logo -->
          <div class="login-box-body">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/avatar.png" alt="User profile picture"><br>
            </div>
            <!-- /.box-profile -->
            <form action="proses_staff.php" method="post">
              <div class="form-group has-feedback">
                <input type="text" name="kd_staff" class="form-control" placeholder="Masukkan Kode" maxlength="6" required="">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Sandi" maxlength="15" required="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <select name="level" class="form-control" required="">
                  <option value="">Level</option>
                  <option value="2">Kepala Bagian</option>
                  <option value="1">Staff QA</option>
                  <option value="0">Manager QA</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <button type="submit" name="masuk" class="btn btn-success btn-block btn-flat">Masuk</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
      </div>
    </div>
    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function () {
    $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
    });
    });
    </script>
  </body>
</html>