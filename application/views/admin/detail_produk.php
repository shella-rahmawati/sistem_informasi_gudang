<?php $halaman = "tabel_produk"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-eye" aria-hidden="true"></i> Detail Produk</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Administrator</a></li>
        <li class="breadcrumb-item active">Detail Produk</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

    <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
  <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
        <?php foreach($list_data as $d){ ?>
        <img src="<?php echo base_url()?>assets/upload/produk/img/<?= $d->gambar?>" class="product-image" alt="Product Image">
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <h3 class="my-3"><?=$d->nama_produk?></h3>
      <a><small><u>Kode Produk <?=$d->id_produk?></u> | <u>Brand <?=$d->brand?></u></small></a>
      <p style="text-align: justify;"><?=$d->deskripsi?></p>
      <hr>
      <div class="bg-teal py-1 px-3 mt-1">
        <h2 class="mb-0">
          Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($d->harga);?>
        </h2>
        <h4 class="mt-0">
          <small>Isi : <?=$d->berat?></small>
        </h4>
      </div>
      <br><a type="button" class="btn btn-danger" style="width:100%;" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
    </div>
  </div>
  </div>
  </div>
  </div>
  <?php } ?>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php'; ?>