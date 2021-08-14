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

  
<section class="content"><!--Start Main content -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-6">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Input Produk Baru</button>
          <button type="button" class="btn btn-warning" href="<?=base_url('user/tabel_kat_barang')?>" name="btn_listsatuan"><i class="fa fa-table" aria-hidden="true"></i> Lihat Kategori Produk</button>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
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
      <font size="2"><table id="example1" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
          <th width="5%">No</th>
          <th>Kode</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Berat</th>
          <th>Brand</th>
          <th>Kategori</th>
          <th width="10%">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <?php if(is_array($join_produk)){ ?>
          <?php $no = 1;?>
          <?php foreach($join_produk as $dd): ?>
            <td><?=$no?></td>
            <td><?=$dd->id_produk?></td>
            <td><?=$dd->nama_produk?></td>
            <td>Rp. <?php $this->load->helper('rupiah_helper');echo rupiah($dd->harga);?></td>
            <td><?=$dd->berat?></td>
            <td><?=$dd->brand?></td>
            <td><?=$dd->kategori?></td>
            <td>
            <div class="btn-group btn-group-xs">
            <a type="button" class="btn btn-warning btn-detail btn-xs"  href="<?=base_url('user/detail_produk/'.$dd->id_produk)?>" name="btn_detail" style="margin:auto;"><i class="fas fa-eye" aria-hidden="true"></i></a>
            <a type="button" class="btn btn-primary btn-xs" href="<?=base_url('user/update_produk/'.$dd->id_produk)?>" name="btn_update" style="margin:auto;"><i class="fas fa-edit" aria-hidden="true"></i></a>
            <a type="button" class="btn btn-danger btn-delete btn-xs"  href="<?=base_url('user/delete_produk/'.$dd->id_produk)?>" name="btn_delete" style="margin:auto;"><i class="fas fa-trash" aria-hidden="true"></i></a>
            </div>
          </td>
        </tr>
      <?php $no++; ?>
      <?php endforeach;?>
      <?php }else { ?>
            <td colspan="7" align="center"><strong>Data Kosong</strong></td>
      <?php } ?>
        </tbody>
      </table></font>
    </div>
        <!-- /.col -->
      </div></div>
    </div>
  </section><!--End Main content -->
</div><!--End Content Wrapper-->

<div class="modal fade" id="modal-lg"><!--Modal Input-->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('user/proses_produk_insert')?>" role="form" method="post">
      <div class="modal-header">
        <h4 class="modal-title">Input Produk Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="id_produk" style="display:inline;">ID Produk</label>
          <input type="text" id="id_produk" style="margin-left:52px;width:80%;display:inline;" class="form-control" name="id_produk" class="form-control" readonly="readonly" value="GL-P<?=date("ymd");?><?=random_string('numeric', 2);?>">
        </div>
        <div class="form-group">
          <label for="nama_produk" style="display:inline;">Nama Produk</label>
          <input type="text" id="nama_produk" style="margin-left:26px;width:80%;display:inline;" class="form-control" name="nama_produk" class="form-control" placeholder="Nama Produk">
        </div>
        <div class="form-group">
          <label for="harga" style="display:inline;">Harga</label>
          <input type="number" id="harga" style="margin-left:80px;width:80%;display:inline;" class="form-control" name="harga" class="form-control" placeholder="Harga Produk">
        </div>
        <div class="form-group">
          <label for="brand" style="display:inline;">Brand</label>
          <input type="text" id="brand" style="margin-left:80px;width:80%;display:inline;" class="form-control" name="brand" class="form-control" placeholder="Brand Untuk Produk">
        </div>
        <div class="form-group">
          <label for="id_kategori" style="display:inline;">Kategori</label>
          <select class="form-control" name="id_kategori" style="margin-left:62px;width:80%;display:inline;">
            <option selected disabled>-Pilih Kategori-</option>
            <?php foreach($list_kat_barang as $s){ ?>
            <option value="<?=$s->id_kategori?>"><?=$s->kategori?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="berat" style="display:inline;">Berat</label>
          <input type="text" id="berat" style="margin-left:83px;width:80%;display:inline;" class="form-control" name="berat" class="form-control" placeholder="Keterangan Berat Produk">
        </div>
        <div class="form-group">
          <label for="gambar" style="display:inline;">Gambar</label>
          <input type="file" name="gambar" style="margin-left:65px;width:80%;display:inline;"  class="form-control" id="gambar">
        </div>
        <div class="form-group">
          <label for="deskripsi" style="margin-left:45%">Deskripsi</label>
          <textarea name="deskripsi" id="summernote">Ketik <em>deskripsi</em> <u>tentang</u> <strong>Produk</strong> disini...</textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Batal</button>
        <button type="reset" class="btn btn-warning" name="btn_reset"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Simpan</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /END modal INPUT-->

<!--<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-edit">
    <div class="modal-content">
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
      <?php foreach($list_data as $d){ ?>
        <div class="form-group">
          <label for="id_produk" style="display:inline;">ID Produk</label>
          <input type="text" id="id_produk" style="margin-left:50px;width:80%;display:inline;" class="form-control" name="id_produk" class="form-control" readonly="readonly" value="<?=$d->id_produk?>">
        </div>
        <div class="form-group">
          <label for="nama_produk" style="display:inline;">Nama Produk</label>
          <input type="text" id="nama_produk" style="margin-left:22px;width:80%;display:inline;" class="form-control" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?=$d->nama_produk?>">
        </div>
        <div class="form-group">
          <label for="harga" style="display:inline;">Harga</label>
          <input type="number" id="harga" style="margin-left:80px;width:80%;display:inline;" class="form-control" name="harga" class="form-control" placeholder="Harga Produk" value="<?=$d->harga?>">
        </div>
        <div class="form-group">
          <label for="brand" style="display:inline;">Brand</label>
          <input type="text" id="brand" style="margin-left:80px;width:80%;display:inline;" class="form-control" name="brand" class="form-control" placeholder="Brand Untuk Produk" value="<?=$d->brand?>">
        </div>
        <div class="form-group">
          <label for="id_kategori" style="display:inline;">Kategori</label>
          <select class="form-control" name="id_kategori" style="margin-left:60px;width:80%;display:inline;">
            <option selected disabled>-Pilih Kategori-</option>
            <?php foreach($list_kat_barang as $s){ ?>
            <option value="<?=$s->id_kategori?>"><?=$s->kategori?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="berat" style="display:inline;">Berat</label>
          <input type="text" id="berat" style="margin-left:83px;width:80%;display:inline;" class="form-control" name="berat" class="form-control" placeholder="Keterangan Berat Produk" value="<?=$d->berat?>">
        </div>
        <div class="form-group">
          <label for="gambar" style="display:inline;">Gambar</label>
          <input type="file" name="gambar" style="margin-left:65px;width:80%;display:inline;"  class="form-control" id="gambar">
        </div>
        <div class="form-group">
          <label for="deskripsi" style="margin-left:45%">Deskripsi</label>
          <textarea name="deskripsi" id="summernote">Ketik <em>deskripsi</em> <u>tentang</u> <strong>Produk</strong> disini...</textarea>
        </div>
    <?php } ?>
      </div>
  </div>
</div>-->
<?php include 'footer.php'; ?>