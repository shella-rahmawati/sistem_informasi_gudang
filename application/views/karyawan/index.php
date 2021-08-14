<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Karyawan | CV Greenlife Tirta Sentosa</title>
  <base href="<?php echo base_url() ?>">
  <link href="dist/img/logo1.png" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-fixed layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="<?php echo base_url('karyawan')?>" class="navbar-brand">
        <?php foreach($avatar as $a){ ?>
        <img src="dist/img/logo1.png" class="brand-image img-circle elevation-3" alt="AdminLTE Logo">
        <?php } ?>
        <span class="brand-text font-weight-light">CV Greenlife Tirta Sentosa</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
      <i class="fas fa-th-large"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <span class="hidden-xs">
          <?php foreach($avatar as $a){ ?>
          <img class="img-circle animation__shake" src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" alt="AdminLTELogo" height="30" width="30">&nbsp;<b>&nbsp;<?=$this->session->userdata('namalengkap')?></b> <?php } ?></span>
      </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right card-danger card-outline">
          <a class="dropdown-item">
            <div class="media">
              <?php foreach($avatar as $a){ ?>
              <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" alt="User Avatar" class="img-size-50 mr-3 img-circle" width="10%">
              <?php } ?>
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <span class="hidden-xs"><b><?=$this->session->userdata('namalengkap')?></b></span>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <small><i class="far fa-clock mr-1"></i>Last Login : <?=$this->session->userdata('last_login')?>
              </small>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
            <center><a href="<?= base_url('karyawan/sigout'); ?>" class="btn-sm btn-danger btn-block"><i class="fa ion-log-out"></i><b> LOG OUT</b></a></center>
        </div>
      </li>
    </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><br/>
  <div class="content"><!-- Main content -->
  <div class="container">
  <div class="row">
    <div class="col-md-4">
    <div class="card card-primary card-outline"><!-- Profile Image -->
    <div class="card-body box-profile">
      <div class="text-center">
        <?php 
        $dd = $this->db->query("SELECT * FROM user JOIN tb_jabatan WHERE user.role=tb_jabatan.id_jabatan")->row();
        ?>
        <?php foreach($avatar as $a){ ?>
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url()?>assets/upload/user/img/<?= $a->nama_file?>" alt="User profile picture">
        <?php } ?>
      </div>
      <h3 class="profile-username text-center"><?=$this->session->userdata('namalengkap')?></h3>
      <p class="text-muted text-center">Software Engineer</p>
      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <b>Last Login</b> <a class="float-right"><?=$this->session->userdata('last_login')?></a>
        </li>
        <li class="list-group-item">
          <b>Role ID</b> <a class="float-right"><?=$dd->jabatan?></a>
        </li>
        <li class="nav-link">
          <br/><center><font color="green"><b>CV. Greenlife Tirta Sentosa</b></font></center>
        </li>
      </ul>
      <a href="<?= base_url('karyawan/sigout'); ?>" class="btn btn-danger btn-block"><b>LOGOUT</b></a>
    </div>
    </div><!-- Profile Image -->
  </div> 

  <div class="col-md-8"> <!-- MENU -->
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills ">
          <li class="nav-item "><a class="nav-link active" href="#info" data-toggle="tab">Informasi Gaji</a></li>
          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ganti Password</a></li>
          <li class="nav-item"><a class="nav-link" href="#picture" data-toggle="tab">Ganti Foto Profil</a></li>
        </ul>
      </div>
      <div class="card-body"><!-- CARD BODY -->
      <div class="tab-content">
        <?php if($this->session->flashdata('msg_berhasil_gambar')){ ?>
          <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success</strong><br> <?php echo $this->session->flashdata('msg_berhasil_gambar');?>
         </div>
        <?php } ?>

        <?php if($this->session->flashdata('msg_error_gambar')){ ?>
          <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Warning !</strong><br> <?php echo $this->session->flashdata('msg_error_gambar');?>
         </div>
        <?php } ?>

        <?php if(isset($pesan_error)){ ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong><br> <?php echo $pesan; ?>
        </div>
        <?php } ?>

      <div class="tab-pane" id="picture">
        <form class="form-horizontal" action="<?=base_url('karyawan/proses_gambar_upload')?>" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Upload Foto</label>
            <div class="col-sm-12">
              <input type="file" name="userpicture" class="form-control" id="username">
            </div>
            
          </div>
          <?php if(isset($token_generate)){ ?>
            <input type="hidden" name="token"  class="form-control" value="<?= $token_generate?>">
          <?php }else {
            redirect(base_url('karyawan/profile'));
          }?>

          <div class="form-group">
              <button type="submit" style="width:20%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Submit</button>
          </div>
        </form>
      </div>
      
      <div class="tab-pane active" id="info">
      <div class="col-md-12">
      <center><b>Karyawan (<?=$dd->jabatan?>)</b></center><br>
      <ul class="list-group list-group-unbordered mb-2">
        <li class="list-group-item">
          <b>Gaji Pokok</b> <a class="float-right">Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($dd->gapok);?></a>
        </li>
        <li class="list-group-item">
          <b>Tunjangan Kesehatan</b> <a class="float-right">Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($dd->tukes);?></a>
        </li>
        <li class="list-group-item">
          <b>Tunjangan Transport</b> <a class="float-right">Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($dd->tutra);?></a>
        </li>
        <li class="list-group-item">
          <b>Uang Makan</b> <a class="float-right">Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($dd->uangmakan);?></a>
        </li>
        <li class="list-group-item">
          <b>Total<a class="float-right"><font color="red">Rp. 
            <?php 
            $total = $dd->gapok+$dd->tukes+$dd->uangmakan+$dd->tutra;
            $this->load->helper('rupiah_helper');
            echo rupiah($total);?></a></b></font></center>
        </li>
        <li class="nav-link"></li>
      </ul>
      </div>
      </div>

      <div class="tab-pane" id="settings">
        <form class="form-horizontal" action="<?=base_url('karyawan/proses_new_password')?>" method="post">
          <?php if($this->session->flashdata('msg_berhasil')){ ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
           </div>
          <?php } ?>
          <?php if(validation_errors()){ ?>
          <div class="alert alert-warning alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
          </div>
          <?php } ?>
          <div class="form-group" style="display:inline-block;">
            <label for="username" style="width:87%;margin-left: 12px;">Username</label>
            <input type="text" name="username" style="width: 90%;margin-right: 67px;margin-left: 11px;" class="form-control" id="username" disabled="" value="<?= $this->session->userdata('name')?>">
          </div>
          <div class="form-group" style="display:inline-block;">
            <label for="email" style="width:73%;">Email</label>
            <input type="email" name="email" style="width:100%;margin-right: 150px;" class="form-control" id="email" value="<?=$this->session->userdata('email')?>">
          </div>
          <div class="form-group">
            <label for="namalengkap" class="col-sm-6 control-label">Nama Lengkap</label>
            <div class="col-sm-12">
              <input type="text" name="namalengkap" class="form-control" id="namalengkap" value="<?=$this->session->userdata('namalengkap')?>" placeholder="Nama Lengkap">
            </div>
          </div>
          <div class="form-group">
            <label for="new_password" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-12">
              <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
            </div>
          </div>
          <div class="form-group">
            <label for="confirm_new_password" class="col-sm-6 control-label">Confirm New Password</label>

            <div class="col-sm-12">
              <input type="password" name="confirm_new_password" class="form-control" id="confirm_new_password" placeholder="Confirm New Password">
            </div>
          </div>
          <?php if(isset($token_generate)){ ?>
            <input type="hidden" name="token"  class="form-control" value="<?= $token_generate?>">
          <?php }else {
            redirect(base_url('karyawan/profile'));
          }?>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" style="width:30%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Submit</button>
            </div>
          </div>
        </form>
      </div>
      </div>
      </div><!-- CARD BODY -->
    </div>
    </div> <!-- MENU -->  
          
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<footer class="main-footer navbar-light navbar-dark">
  <strong>Copyright &copy; 2021,</strong>
    Ferry & Shella. All rights reserved
  <div class="float-right d-none d-sm-inline-block">
  <b>Version</b> 1.0.5
  </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>dist/js/demo.js"></script>
</body>
</html>
