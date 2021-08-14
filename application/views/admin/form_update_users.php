<?php $halaman = "users"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Update Users Data</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Administrator</a></li>
          <li class="breadcrumb-item active">User Admin</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

    <!-- Main content -->
<section class="content"><!--Start Section-->
  <div class="container-fluid"><!--Start Container-Fluid-->
  <div class="card">
  <div class="card-body">
  <div class="box-body">
    <form action="<?=base_url('admin/proses_update_user')?>" role="form" method="post">

      <?php if($this->session->flashdata('msg_berhasil')){ ?>
        <div class="alert alert-success alert-dismissible" style="width:91%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
       </div>
      <?php } ?>

      <?php if(validation_errors()){ ?>
      <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
     </div>
    <?php } ?>

      <div class="box-body">
        <?php foreach($list_data as $d){ ?>
          <input type="hidden" name="id" value="<?=$d->id?>">
        <div class="form-group" style="display:block;">
          <label for="username" style="width:87%;margin-left: 0px;">Username</label>
          <input type="text" name="username" style="width: 30%;margin-right: 67px;margin-left: 0px;"  required="" class="form-control" id="username" value="<?=$d->username?>">
        </div>
        <div class="form-group" style="display:block;">
          <label for="email" style="width:73%;">Email</label>
          <input type="email" name="email" style="width:30%;margin-right: 67px;" class="form-control" id="email" required="" value="<?=$d->email?>">
        </div>
        <div class="form-group" style="display:block;">
          <label for="namalengkap" style="width:87%;margin-left: 0px;">Nama Lengkap</label>
          <input type="text" name="namalengkap" style="width: 30%;margin-right: 67px;margin-left: 0px;"  required="" class="form-control" id="namalengkap" value="<?=$d->namalengkap?>">
        </div>
      <div class="form-group" style="display:block;">
        <label for="role" style="width:73%;">Role</label>
        <select class="form-control" name="role" style="width:30%;margin-right: 18px;">
          <?php if($d->role == 1){ ?>
          <option value="1" selected="">User Admin</option>
          <option value="0">User Staff Gudang</option>
          <option value="">Karyawan</option>
          <?php }else{ ?>
          <option value="1">Administrator</option>
          <option value="0" selected="">User Staff Gudang</option>
          <option value="">Karyawan</option>
          <?php } ?>
        </select>
    </div>
    <?php } ?>
      <!-- /.box-body -->
      <?php if(isset($token_generate)){ ?>
        <input type="hidden" name="token"  class="form-control" value="<?= $token_generate?>">
      <?php }else {
        redirect(base_url('admin/update_user'));
      }?>
      <div class="box-body">
        <a type="button" class="btn btn-danger" style="width:15%;margin-right:20%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
        <a type="button" class="btn btn-info" style="width:29%;margin-right:20%" href="<?=base_url('admin/users')?>" name="btn_listusers"><i class="fa fa-table" aria-hidden="true"></i> Lihat List Satuan</a>
        <button type="submit" style="width:15%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
      </div>
    </form>
  </div>
  </div>
  </div><!--End col md 12-->
  </div><!--End Container-Fluid-->
  </section><!--End Section-->
</div><!--End Content Wrapper-->

<?php include 'footer.php'; ?>