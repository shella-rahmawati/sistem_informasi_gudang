<?php $halaman = "tabel_barangkeluar"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-briefcase" aria-hidden="true"></i> Data Produk Keluar</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Staff Gudang</a></li>
        <li class="breadcrumb-item active">Data Produk Keluar</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

  <section class="content"><!--Start Main content -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-6">
          <a href="<?=base_url('user/tabel_barangmasuk')?>" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Keluar</a>
          <!--<a href="<?=base_url('report/barangKeluarManual')?>" type="button" class="btn btn-warning" name="laporan_data"><i class="fa fa-print" aria-hidden="true"></i>  Laporan Manual</a>-->
          <a href="<?=base_url('report/lap_produkkeluar')?>" type="button" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i> <?=date("d/m/Y");?></a>
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

              <font size="3">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Transaksi</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                  <th>Lokasi</th>
                  <th>Produk</th>
                  <th>Satuan</th>
                  <th>Jum</th>
                  <th>Cetak</th>
                  <!-- <th></th> -->
                </tr>
                </thead></font>
                <tbody>
                <tr>
                  <?php if(is_array($list_data)){ ?>
                  <?php $no = 1;?>
                  <?php foreach($list_data as $dd): ?>
                    <td><?=$no?></td>
                    <td><?=$dd->id_transaksi?></td>
                    <td><?=$dd->tanggal_masuk?></td>
                    <td><?=$dd->tanggal_keluar?></td>
                    <td><?=$dd->lokasi?></td>
                    <td><?=$dd->nama_produk?></td>
                    <td><?=$dd->satuan?></td>
                    <td><?=$dd->jumlah?></td>
                    <td><div class="btn-group btn-group-sm">
<a type="button" class="btn-sm btn-danger btn-report"  href="<?=base_url('report/transaksikeluar/'.$dd->id_transaksi)?>" name="btn_report" style="margin:auto;"><i class="fa fa-print" aria-hidden="true"></i></a></div></td>
                </tr>
              <?php $no++; ?>
              <?php endforeach;?>
              <?php }else { ?>
                    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
              <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>


        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include 'footer.php'; ?>