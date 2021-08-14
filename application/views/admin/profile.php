<?php $halaman = "profile"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pengaturan Profil</h1>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Administrator</a></li>
        <li class="breadcrumb-item active">Profil</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

  <section class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-3">
    <div class="card card-primary card-outline"><!-- Profile Image -->
    <div class="card-body box-profile">
      <div class="text-center">
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
          <b>Role ID</b> <a class="float-right">User Admin</a>
        </li>
        <li class="list-group-item">
          <center><font color="green"><b>CV. Greenlife Tirta Sentosa</b></font></center>
        </li>
      </ul>
      <a href="<?= base_url('admin/sigout'); ?>" class="btn btn-danger btn-block"><b>LOGOUT</b></a>
    </div>
    </div><!-- Profile Image -->
  </div>

    <div class="col-md-9"> <!-- MENU -->
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Ganti Password</a></li>
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
        <form class="form-horizontal" action="<?=base_url('admin/proses_gambar_upload')?>" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Upload Foto</label>
            <div class="col-sm-12">
              <input type="file" name="userpicture" class="form-control" id="username">
            </div>
            
          </div>
          <?php if(isset($token_generate)){ ?>
            <input type="hidden" name="token"  class="form-control" value="<?= $token_generate?>">
          <?php }else {
            redirect(base_url('admin/profile'));
          }?>

          <div class="form-group">
              <button type="submit" style="width:20%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Submit</button>
          </div>
        </form>
      </div>
      
      <div class="tab-pane active" id="settings">
        <form class="form-horizontal" action="<?=base_url('admin/proses_new_password')?>" method="post">
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
            <label for="new_password" class="col-sm-2 control-label">New Password</label>
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
            redirect(base_url('admin/profile'));
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
  </div>
  </div>
  </div>
  </section>
</div><!--End Content Wrapper-->
<?php include 'footer.php'; ?>