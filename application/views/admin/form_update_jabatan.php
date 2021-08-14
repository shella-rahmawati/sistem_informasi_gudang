<?php $halaman = "tabel_jabatan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-edit" aria-hidden="true"></i> Edit Jabatan Karyawan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Administrator</a></li>
          <li class="breadcrumb-item active">Jabatan Karyawan</li>
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
    <form action="<?=base_url('admin/proses_jabatan_update')?>" role="form" method="post">
    <?php if($this->session->flashdata('msg_berhasil')){ ?>
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
    </div>
    <?php } ?>
    <?php if(validation_errors()){ ?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
    </div>
    <?php } ?>
    <?php foreach($data_jabatan as $d){ ?>
    <div class="form-group">
      <input type="hidden" name="id_jabatan" value="<?=$d->id_jabatan?>">
      <label for="jabatan" style="margin-left:300px;display:inline;">Jabatan Baru</label>
      <input type="text" required name="jabatan" style="margin-left:37px;width:20%;display:inline;" class="form-control" placeholder="Jabatan Baru" id="jabatan" placeholder="Jabatan" value="<?=$d->jabatan?>">
    </div><br/>
    <div class="form-group" style="display:inline-block;">
      <label for="gapok" style="width:100%;margin-left:1px;">Gaji Pokok</label>
      <input type="number" name="gapok" style="width:100%;margin-right:1px;margin-left:1px;" class="form-control" id="gapok" placeholder="Gaji Pokok" required value="<?=$d->gapok?>">
    </div>
    <div class="form-group" style="display:inline-block;">
      <label for="tukes" style="width:90%;margin-right:20px;margin-left:20px;">Tunjangan Kesehatan</label>
      <input type="number" name="tukes" style="width:90%;margin-right:20px;margin-left:20px;" class="form-control" id="tukes" placeholder="Tun. Kesehatan" value="<?=$d->tukes?>">
    </div>
    <div class="form-group" style="display:inline-block;">
      <label for="uangmakan" style="width:100%;margin-left:10px;">Uang Makan</label>
      <input type="number" name="uangmakan" style="width:100%;margin-right:10px;margin-left:10px;" class="form-control" id="uangmakan" placeholder="Uang Makan" required value="<?=$d->uangmakan?>"></input>
    </div>
    <div class="form-group" style="display:inline-block;">
        <label for="tutra" style="width:90%;margin-left:25px;">Tunjangan Transport</label>
        <input type="number" name="tutra" style="width:90%;margin-right:20px;margin-left:25px;" class="form-control" id="tutra" placeholder="Tun. Transport" value="<?=$d->tutra?>">
    </div>
    <div class="form-group" style="display:inline-block;">
      <button type="reset" class="btn-sm btn-warning" name="btn_reset" style="width:100%;margin-right:1px;margin-left:1px;"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Reset</b></button>
    </div>
    <?php } ?>
    <!-- /.box-body --><hr/>
    <div class="box-body">
      <a type="button" class="btn btn-danger" style="width:15%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
      <button type="submit" style="width:15%;" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
    </div>
    </form>
  </div>
  </div>
  </div><!--End col md 12-->
  </div><!--End Container-Fluid-->
  </section><!--End Section-->
</div><!--End Content Wrapper-->

<?php include 'footer.php'; ?>