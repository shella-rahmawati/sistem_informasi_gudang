<?php $halaman = "tabel_barangmasuk"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-edit" aria-hidden="true"></i> Edit Data Produk Masuk</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Administrator</a></li>
          <li class="breadcrumb-item active">Produk Masuk</li>
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
    <form action="<?=base_url('user/proses_databarang_masuk_update')?>" role="form" method="post">

      <?php if(validation_errors()){ ?>
      <div class="alert alert-warning alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
     </div>
    <?php } ?>

      
        <?php foreach($data_barang_update as $d){ ?>
      <div class="form-group">
        <label for="id_transaksi" style="display:inline;">ID Transaksi</label>
        <input type="text" name="id_transaksi" style="margin-left:20px;width:89%;display:inline;" class="form-control" readonly="readonly" value="<?=$d->id_transaksi?>">
      </div>
      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Tanggal Masuk</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" name="tanggal" id="tanggal" class="form-control" readonly="readonly" value="<?=$d->tanggal?>">
          </div>
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label for="lokasi">Penginput</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-edit"></i></span>
            </div>
          <input type="text" name="petugas" id="petugas" class="form-control" readonly value="<?=$d->petugas?>" />
          </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label for="id_produk">Nama Barang</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-shopping-bag"></i></span>
              </div>
              <select class="form-control" name="id_produk">
                <?php foreach($list_produk as $s){?>
                  <?php if($d->id_produk == $s->id_produk){?>
                <option value="<?=$d->id_produk?>" selected=""><?php echo $s->nama_produk; ?></option>
                <?php }else{?>
                <option value="<?=$s->id_produk?>"><?=$s->nama_produk?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group" style="display:inline-block;">
          <label for="satuan" style="width:73%;margin-left:18px">Satuan</label>
          <select class="form-control" name="satuan" style="width:100%;margin-left:18px;margin-right:13px;">
            <?php foreach($list_satuan as $s){?>
              <?php if($d->satuan == $s->nama_satuan){?>
            <option value="<?=$d->satuan?>" selected=""><?=$d->satuan?></option>
            <?php }else{?>
            <option value="<?=$s->kode_satuan?>"><?=$s->nama_satuan?></option>
              <?php } ?>
              <?php } ?>
          </select>
      </div>
      <div class="form-group" style="display:inline-block;">
        <label for="jumlah" style="width:73%;margin-left:33px;">Jumlah</label>
        <input type="number" name="jumlah" style="width:100%;margin-left:34px;margin-right:18px;" class="form-control" id="jumlah" value="<?=$d->jumlah?>">
      </div>
    <?php } ?>
    </div><hr/> 
        <div class="row">
          <div class="col-sm-6">
          <a type="button" class="btn btn-danger" style="width:30%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a></div>
          <div class="col-sm-6">
          <button type="submit" style="width:30%;margin-left:70%;" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
          </div>
        </div>
      </form>
  </div>
  </div>
  </div><!--End col md 12-->
  </div><!--End Container-Fluid-->
  </section><!--End Section-->
</div><!--End Content Wrapper-->

<?php include 'footer.php'; ?>