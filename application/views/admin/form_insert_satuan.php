<?php $halaman = "tabel_satuan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Input Satuan Produk</h1>
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

<section class="content"><!--Start Section-->
  <div class="container-fluid"><!--Start Container-Fluid-->
  <div class="card">
  <div class="card-body">
  <div class="box-body">
    <form action="<?=base_url('admin/proses_satuan_insert')?>" role="form" method="post">

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
        <div class="form-group" style="display:inline-block;">
          <label for="kode_satuan" style="width:87%;margin-left: 12px;">Kode Satuan</label>
          <input type="text" name="kode_satuan" style="width: 90%;margin-right: 67px;margin-left: 11px;" class="form-control" id="kode_satuan" placeholder="Kode Satuan">
        </div>
        <div class="form-group" style="display:inline-block;">
          <label for="nama_satuan" style="width:73%;">Nama Satuan</label>
          <input type="text" name="nama_satuan" style="width:90%;margin-right: 67px;" class="form-control" id="nama_satuan" placeholder="Nama Satuan">
      </div>
      <div class="form-group" style="display:inline-block;">
        <button type="reset" class="btn btn-warning swalDefaultWarning" name="btn_reset" style="width:100px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
      </div>
      <hr/>
      <div class="box-body">
        <a type="button" class="btn btn-danger" style="width:15%;margin-right:20%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
        <a type="button" class="btn btn-info swalDefaultInfo" style="width:29%;margin-right:20%" href="<?=base_url('admin/tabel_satuan')?>" name="btn_listsatuan"><i class="fa fa-table" aria-hidden="true"></i> Lihat List Satuan</a>
        <button type="submit" style="width:15%" class="btn btn-success swalDefaultSuccess"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
      </div>
    </form>
</div>
  </div>
  </div><!--End col md 12-->
  </div><!--End Container-Fluid-->
  </section><!--End Section-->
</div><!--End Content Wrapper-->

<?php include 'footer.php'; ?>