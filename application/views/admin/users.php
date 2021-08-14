<?php $halaman = "users"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fa fa-fw fa-users" aria-hidden="true"></i> Users Data</h1>
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
 <section class="content"><!--Start Main content -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
    <!--<div class="col-md-4">
      <a href="<?=base_url('admin/form_user')?>" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah User Baru</a>
    </div>-->
    </div>
    <div class="card">
      <div class="card-body">
        <div class="box-body">
          <?php if($this->session->flashdata('msg_berhasil')){ ?>
            <div class="alert alert-success alert-dismissible" style="width:100%">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
            </div>
          <?php } ?>
      <table id="example1" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
          <th width="5%">No</th>
          <th >Username</th>
          <th >Email</th>
          <th >Role</th>
          <th >Nama Lengkap</th>
          <th >Last Login</th>
          <th width="">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <?php if(is_array($list_users)){ ?>
            <?php $no = 1;?>
          <?php foreach($list_users as $dd): ?>
            <td><?=$no?></td>
            <td><?=$dd->username?></td>
            <td><?=$dd->email?></td>
            <?php if($dd->role == 1){ ?>
              <td>User Admin</td>
            <?php }else if($dd->role == 0){?>
              <td>User Staff Gudang</td>
            <?php }else {?>
              <td>User Karyawan</td>
            <?php }?>
            <td><?=$dd->namalengkap?></td>
            <td><?=$dd->last_login?></td>
            <td><div class="btn-group btn-group-sm">
              <a type="button" class="btn btn-info"  href="<?=base_url('admin/update_user/'.$dd->id)?>" name="btn_update" style="margin:auto;"><i class="fa fa-edit" aria-hidden="true"></i></a>
            <a type="button" class="btn btn-danger btn-delete"  href="<?=base_url('admin/proses_delete_user/'.$dd->id)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></div></td>
        </tr>
        <?php $no++; ?>
      <?php endforeach;?>
      <?php }else { ?>
            <td colspan="7" align="center"><strong>Data Kosong</strong></td>
      <?php } ?>
        </tbody>
      </table>
</div>
        <!-- /.col -->
      </div></div>
    </div>
  </section><!--End Main content -->
</div><!--End Content Wrapper-->

<?php include 'footer.php'; ?>