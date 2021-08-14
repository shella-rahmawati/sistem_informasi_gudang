<?php $halaman = "insert_barangmasuk"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Input Produk Masuk</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a>Staff Gudang</a></li>
          <li class="breadcrumb-item active">Produk Masuk</li>
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
    <form action="<?=base_url('user/proses_databarang_masuk_insert')?>" role="form" method="post">
      <?php if($this->session->flashdata('msg_berhasil')){ ?>
      <div class="alert alert-success alert-dismissible">
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
      <div class="form-group">
        <label for="id_transaksi" style="display:inline;">ID Transaksi</label>
        <input type="text" name="id_transaksi" style="margin-left:20px;width:89%;display:inline;" class="form-control" readonly="readonly" value="GL-T<?=date("ymd");?><?=random_string('numeric', 2);?>">
      </div>
      <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
        <label>Tanggal Masuk</label> 
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
          </div>
        <input type="text" name="tanggal" class="form-control form_datetime" placeholder="Klik Disini"/>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="petugas">Penginput</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-edit"></i></span>
            </div>
        <input type="text" name="petugas" id="petugas" class="form-control" readonly value="<?=$this->session->userdata('namalengkap')?>" />
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
                <option value="" selected disabled>-Pilih Produk-</option>
                <?php foreach($list_produk as $s){?>
                <option value="<?=$s->id_produk?>"><?=$s->nama_produk?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
        </div>
      <div class="form-group" style="display:inline-block;">
          <label for="satuan" style="width:73%;margin-left:15px">Satuan</label>
          <select class="form-control" name="satuan" style="width:100%;margin-left:15px;margin-right:30px;">
          <option value="" selected disabled>-Pilih Satuan-</option>
          <?php foreach($list_satuan as $s){ ?>
          <option value="<?=$s->kode_satuan?>"><?=$s->nama_satuan?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group" style="display:inline">
        <label for="jumlah" style="width:73%;margin-left:33px;">Jumlah</label>
        <input type="number" name="jumlah" style="width:50%;margin-left:34px;margin-right:18px;" class="form-control" id="jumlah">
      </div>
      <div class="form-group" style="display:inline;">
        <button type="reset" class="btn btn-warning" name="btn_reset" style="width:100px;margin-left:-60px;margin-top:80%;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
      </div>
    </div>
      <!-- /.box-body --><hr/>
      <div class="box-body">
        <a type="button" class="btn btn-danger" style="width:15%;margin-right:20%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
        <a type="button" class="btn btn-info" style="width:29%;margin-right:20%" href="<?=base_url('user/tabel_barangmasuk')?>" name="btn_listbarang"><i class="fa fa-table" aria-hidden="true"></i> Lihat List Barang</a>
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