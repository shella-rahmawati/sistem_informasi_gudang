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
      <p class="login-box-msg">Daftarkan data diri anda</p>

  <form action="<?= base_url('register/proses_register')?>" method="post">

    <?php if($this->session->flashdata('msg')){ ?>
      <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Warning!</strong><br> <?php echo $this->session->flashdata('msg');?>
     </div>
    <?php } ?>

    <?php if($this->session->flashdata('msg_terdaftar')){ ?>
      <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success</strong><br> <?php echo $this->session->flashdata('msg_terdaftar');?>
     </div>
    <?php } ?>

    <?php if(validation_errors()){ ?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
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
  <input type="email" name="email" class="form-control" placeholder="Email" autofocus required="">
    <div class="input-group-append">
      <div class="input-group-text">
      <span class="fas fa-user"></span>
      </div>
    </div>
</div>

<div class="input-group mb-3">
  <input type="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap" autofocus required="">
    <div class="input-group-append">
      <div class="input-group-text">
      <span class="fas fa-heart"></span>
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

<div class="input-group mb-3">
  <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
    <div class="input-group-append">
      <div class="input-group-text">
      <span class="fas fa-key"></span>
      </div>
    </div>
</div>
<div class="row">
  <div class="col-8">
    <label for="remember">
      Sudah Punya Akun? 
    </label>
    <?php echo anchor(base_url('login'),'Log In') ?>
  </div>
  <div class="col-4">
    <button type="submit" class="btn btn-success btn-block">Register 
    </button>
  </div>
</div>

  </form>
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
