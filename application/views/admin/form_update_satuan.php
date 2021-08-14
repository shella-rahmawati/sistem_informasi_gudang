<?php $halaman = "tabel_satuan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Edit Satuan Produk</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Administrator</a></li>
          <li class="breadcrumb-item active">Satuan Produk</li>
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
    <form action="<?=base_url('admin/proses_satuan_update')?>" role="form" method="post">
    <?php if(validation_errors()){ ?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
    </div>
    <?php } ?>
        <?php foreach($data_satuan as $d){ ?>
        <div class="form-group" style="display:inline-block;">
          <input type="hidden" name="id_satuan" value="<?=$d->id_satuan?>">
          <label for="kode_satuan" style="width:87%;margin-left: 12px;">Kode Satuan</label>
          <input type="text" required name="kode_satuan" style="width: 90%;margin-right: 67px;margin-left: 11px;" class="form-control" id="kode_satuan" placeholder="Kode Satuan" value="<?=$d->kode_satuan?>">
        </div>
        <div class="form-group" style="display:inline-block;">
          <label for="nama_satuan" style="width:73%;">Nama Satuan</label>
          <input type="text" required name="nama_satuan" style="width:90%;margin-right: 67px;" class="form-control" id="nama_satuan" placeholder="Nama Satuan" value="<?=$d->nama_satuan?>">
        </div>
        <div class="form-group" style="display:inline-block;margin-left:5%">
          <button type="reset" class="btn btn-warning" name="btn_reset" style="width:100px;margin-left:-70px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
        </div>
        <?php } ?><hr/>
      <div class="box-body">
        <a type="button" class="btn btn-danger" style="width:15%;margin-right:20%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
        <a type="button" class="btn btn-info" style="width:29%;margin-right:20%" href="<?=base_url('admin/tabel_satuan')?>" name="btn_listbarang"><i class="fa fa-table" aria-hidden="true"></i> Lihat List Satuan</a>
        <button type="submit" style="width:15%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
      </div>
      </form>
  </div>
  </div>
  </div><!--End col md 12-->
  </div><!--End Container-Fluid-->
  </section><!--End Section-->
</div><!--End Content Wrapper-->

  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>