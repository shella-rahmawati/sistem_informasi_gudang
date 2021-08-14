<?php $halaman = "tabel_produk"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-columns" aria-hidden="true"></i> Data Produk</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Staff Gudang</a></li>
        <li class="breadcrumb-item active">Data Produk</li>
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
    <form action="<?=base_url('user/proses_produk_update')?>" role="form" method="post">
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
    
    <div class="row">
      <?php foreach($list_data as $d){ ?>
      <div class="col-sm-6">
        <div class="form-group">
          <label>ID Produk</label>
          <input type="text" id="id_produk" class="form-control" name="id_produk" class="form-control" readonly="readonly" value="<?=$d->id_produk?>">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" id="nama_produk" class="form-control" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?=$d->nama_produk?>">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Harga</label>
          <input type="number" id="harga" class="form-control" name="harga" class="form-control" placeholder="Harga Produk" value="<?=$d->harga?>">
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Brand</label>
          <input type="text" id="brand" class="form-control" name="brand" class="form-control" placeholder="Brand Untuk Produk" value="<?=$d->brand?>">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Kategori</label>
          <select class="form-control" name="id_kategori">
            <?php foreach($list_kat_barang as $s){?>
            <?php if($d->id_kategori == $s->id_kategori){?>
            <option value="<?=$d->id_kategori?>" selected=""><?php echo $s->kategori; ?></option>
            <?php }else{?>
            <option value="<?=$s->id_kategori?>"><?=$s->kategori?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Berat</label>
          <input type="text" id="berat" class="form-control" name="berat" class="form-control" placeholder="Keterangan Berat Produk" value="<?=$d->berat?>">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control" id="gambar" value="<?=$d->gambar?>">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" id="summernote"><?php echo $d->deskripsi; ?></textarea>
        </div>
      </div>
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