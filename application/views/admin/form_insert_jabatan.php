<?php $halaman = "tabel_jabatan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Input Jabatan Baru</h1>
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

  <section class="content"><!--Start Section-->
  <div class="container-fluid"><!--Start Container-Fluid-->
  <div class="card">
  <div class="card-body">
  <div class="box-body">
    <form action="<?=base_url('admin/proses_jabatan_insert')?>" role="form" method="post">
      <?php if($this->session->flashdata('msg_berhasil')){ ?>
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
      </div>
      <?php } ?>
      <?php if(validation_errors()){ ?>
      <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
      </div>
      <?php } ?>
      <div class="form-group">
        <label for="jabatan" style="margin-left:300px;display:inline;">Jabatan Baru</label>
        <input type="text" name="jabatan" style="margin-left:37px;width:20%;display:inline;" class="form-control" placeholder="Jabatan Baru" required>
      </div><br/>
      <div class="form-group" style="display:inline-block;">
        <label for="gapok" style="width:100%;margin-left:1px;">Gaji Pokok</label>
        <input type="number" name="gapok" style="width:100%;margin-right:1px;margin-left:1px;" class="form-control" id="gapok" placeholder="Gaji Pokok" required>
      </div>
      <div class="form-group" style="display:inline-block;">
        <label for="tukes" style="width:90%;margin-right:20px;margin-left:20px;">Tunjangan Kesehatan</label>
        <input type="number" name="tukes" style="width:90%;margin-right:20px;margin-left:20px;" class="form-control" id="tukes" placeholder="Tun. Kesehatan" required>
      </div>
      <div class="form-group" style="display:inline-block;">
        <label for="uangmakan" style="width:100%;margin-left:10px;">Uang Makan</label>
        <input type="number" name="uangmakan" style="width:100%;margin-right:10px;margin-left:10px;" class="form-control" id="uangmakan" placeholder="Uang Makan" required></input>
      </div>
      <div class="form-group" style="display:inline-block;">
          <label for="tutra" style="width:90%;margin-left:25px;">Tunjangan Transport</label>
          <input type="number" name="tutra" style="width:90%;margin-right:20px;margin-left:25px;" class="form-control" id="tutra" placeholder="Tun. Transport" required>
      </div>
      <div class="form-group" style="display:inline-block;">
        <button type="reset" class="btn-sm btn-warning" name="btn_reset" style="width:100%;margin-right:1px;margin-left:1px;"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Reset</b></button>
      </div>
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