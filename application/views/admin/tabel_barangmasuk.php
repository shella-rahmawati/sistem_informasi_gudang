<?php $halaman = "tabel_barangmasuk"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-briefcase" aria-hidden="true"></i> Data Produk Masuk</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Staff Gudang</a></li>
        <li class="breadcrumb-item active">Data Produk Masuk</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

  <section class="content"><!--Start Main content -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
          <a href="<?=base_url('user/form_barangmasuk')?>" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Masuk</a>
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
                <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
            </div>
          <?php } ?>
          <?php if($this->session->flashdata('msg_berhasil_keluar')){ ?>
            <div class="alert alert-success alert-dismissible" style="width:100%">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_keluar');?>
           </div>
          <?php } ?>
          <table id="example1" class="table table-striped" width="100%">
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Id Transaksi</th>
              <th>Tanggal</th>
              <th>Nama Produk</th>
              <th>Satuan</th>
              <th>Jum</th>
              <th>Petugas</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <?php if(is_array($list_data)){ ?>
              <?php $no = 1;?>
              <?php foreach($list_data as $dd): ?>
                <td><?=$no?></td>
                <td><?=$dd->id_transaksi?></td>
                <td><?=$dd->tanggal?></td>
                <td><?=$dd->nama_produk?></td>
                <td><?=$dd->satuan?></td>
                <td><?=$dd->jumlah?></td>
                <td><?=$dd->petugas?></td>
                <td><div class="btn-group btn-group-sm">
                <a type="button" class="btn-xs btn-info "  href="<?=base_url('user/update_barang/'.$dd->id_transaksi)?>" name="btn_update" style="margin:auto;"><i class="fa fa-edit" aria-hidden="true"></i></a>
                <a type="button" class="btn-xs btn-danger btn-delete"  href="<?=base_url('user/delete_barang/'.$dd->id_transaksi)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <a type="button" class="btn-xs btn-success btn-barangkeluar"  href="<?=base_url('user/barang_keluar/'.$dd->id_transaksi)?>" name="btn_barangkeluar" style="margin:auto;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></div></td>
            </tr>
            <?php $no++; ?>
            <?php endforeach;?>
            <?php }else { ?>
                  <td colspan="7" align="center"><strong>Data Kosong</strong></td>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>

<?php include 'footer.php'; ?>