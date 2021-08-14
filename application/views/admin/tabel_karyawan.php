<?php $halaman = "tabel_karyawan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-columns" aria-hidden="true"></i> Data Karyawan</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Administrator</a></li>
        <li class="breadcrumb-item active">Data Karyawan</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

  
<section class="content"><!--Start Main content -->
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
          <a href="<?= base_url('admin/form_karyawan')?>" type="button" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Karyawan Baru</a>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
    </div>
    <div class="card">
      <div class="card-body">
            <!-- /.box-header -->
    <div class="box-body">
      <?php if($this->session->flashdata('msg_berhasil')){ ?>
        <div class="alert alert-success alert-dismissible" style="width:100%">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
       </div>
      <?php } ?>
      <font size="3"><table id="example1" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
          <th width="5%">No</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>No. Telpon</th>
          <th>Alamat</th>
          <th width="10%">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <?php if(is_array($join_karyawan)){ ?>
          <?php $no = 1;?>
          <?php foreach($join_karyawan as $dd): ?>
            <td><?=$no?></td>
            <td><?=$dd->nama?></td>
            <td><?=$dd->jabatan?></td>
            <td><?=$dd->telp?></td>
            <td><?=$dd->alamat?></td>
            <td><div class="btn-group btn-group-sm">
            <a type="button" class="btn btn-warning btn-detail btn-xs"  href="<?=base_url('admin/detail_karyawan/'.$dd->id_karyawan)?>" name="btn_detail" style="margin:auto;"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a type="button" class="btn btn-primary btn-xs"  href="<?=base_url('admin/update_karyawan/'.$dd->id_karyawan)?>" name="btn_update" style="margin:auto;"><i class="fa fa-edit" aria-hidden="true"></i></a>
            <a type="button" class="btn btn-danger btn-delete btn-xs"  href="<?=base_url('admin/delete_karyawan/'.$dd->id_karyawan)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </div></td>
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

<?php include 'footer.php'; ?>