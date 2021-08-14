<?php $halaman = "tabel_barangkeluar"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Input Produk Keluar</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Administrator</a></li>
          <li class="breadcrumb-item active">Produk Keluar</li>
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
  <form action="<?=base_url('admin/proses_data_keluar')?>" role="form" method="post">

    <?php if(validation_errors()){ ?>
    <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
   </div>
  <?php } ?>

    
      <?php foreach($list_data as $d){ ?>
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
          <label>Tanggal Keluar</label>
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" name="tanggal_keluar" id="tanggal_keluar"  class="form-control form_datetime" placeholder="Klik Disini...">
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="lokasi">Lokasi</label>
          <input type="hidden" name="petugas" id="petugas" class="form-control" readonly value="<?=$this->session->userdata('namalengkap')?>"/>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-plane"></i></span>
            </div>
          <select class="form-control" name="lokasi">
          <option value="Jawa Tengah">Jawa Timur</option>
          <option value="Jawa Timur">Jawa Tengah</option>
          <option value="Jawa Barat">Jawa Barat</option>
          <option value="Yogyakarta">Yogyakarta</option>
        </select>  
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
        <select class="form-control" name="id_produk" readonly="readonly">
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
      <div class="col-sm-6">
        <div class="form-group">
        <label for="satuan">Satuan</label>
        <select class="form-control" name="satuan" readonly="readonly">
          <?php foreach($list_satuan as $s){?>
            <?php if($d->satuan == $s->nama_satuan){?>
          <option value="<?=$d->satuan?>" selected=""><?=$d->satuan?></option>
          <?php }else{?>
          <option value="<?=$s->kode_satuan?>"><?=$s->nama_satuan?></option>
            <?php } ?>
            <?php } ?>
        </select>
      </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
        <label for="jumlah" >Jumlah <font color="red">(max <?=$d->jumlah?>)</font></label>
        <input type="number" name="jumlah"  class="form-control" id="jumlah" >
        </div>
      </div>
  <?php } ?>
    </div>
    <!-- /.box-body --><hr/>
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