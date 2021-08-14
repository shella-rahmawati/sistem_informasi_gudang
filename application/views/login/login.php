<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Form</title>
  <base href="<?php echo base_url() ?>">
  <link href="dist/img/logo1.png" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- icheck bootstrap -->
  <link href="<?php echo base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link href="<?php echo base_url() ?>dist/css/adminlte.min.css" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image:url('dist/img/bg1.png');background-repeat:no-repeat;background-size:cover;" >

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="dist/img/logo1.png" width="20%"><br>
      <a class="h1"><b>CV</b>Greenlife</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masukan username dan password anda</p>

  <form action="<?php echo base_url('login/proses_login')?>" method="post">
    <?php if($this->session->flashdata('msg')){ ?>
      <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Warning!</strong><br> <?php echo $this->session->flashdata('msg');?>
     </div>
    <?php } ?>
<div class="input-group mb-3">
  <input type="text" name="username" class="form-control" placeholder="Username" autofocus required="">
    <div class="input-group-append">
      <div class="input-group-text">
      <span class="fas fa-envelope"></span>
      </div>
    </div>
</div>
<div class="input-group mb-3">
  <input type="password" name="password" class="form-control" placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
      <span class="fas fa-lock"></span>
      </div>
    </div>
</div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingat saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Masuk</button>
          </div>
          <p class="mb-0">
        <?php if(isset($token_generate)){ ?>
    <input type="hidden" name="token" value="<?php echo $token_generate ?>">
    <?php }else {
      redirect(base_url());
    }?>
    <?php echo anchor(base_url('login/register'),'Buat akun baru') ?><br>
      </p>
          <!-- /.col -->
        </div>
  </form>
  <!-- <footer><a target="blank" href="http://unsadacoder.or.id">UnsadaCoder.or.id</a></footer> -->
    </div>
    <!-- /.card-body -->
  </div>
 
  <!-- /.card -->
</div>
<font size="2" face="Times New Roman" color="#ffffff">© 2021, Ferry & Shella, All Rights Reserved</font>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
</body>
</html>
