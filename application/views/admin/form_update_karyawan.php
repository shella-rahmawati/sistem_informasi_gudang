<?php $halaman = "tabel_karyawan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-edit" aria-hidden="true"></i> Edit Karyawan</h1>
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

    <!-- Main content -->
  <section class="content"><!--Start Section-->
  <div class="container-fluid"><!--Start Container-Fluid-->
  <div class="card">
  <div class="card-body">
  <div class="box-body">
    <form action="<?=base_url('admin/proses_karyawan_update')?>" role="form" method="post">
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
            <label>NIK</label>
            <input type="hidden" name="id_karyawan" value="<?=$d->id_karyawan?>">
            <input type="number" name="nik" id="nik" class="form-control" placeholder="Nomor Induk Kependudukan..." value="<?=$d->nik?>" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap..." value="<?=$d->nama?>" required>
            <input type="hidden" name="username" id="username" class="form-control" placeholder="Username..." value="<?=$d->username?>">
            <input type="hidden" name="password" id="password" class="form-control" placeholder="Password..." value="<?=$d->password?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat Lengkap..." value="<?=$d->alamat?>"><?php echo $d->alamat; ?></textarea>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control" ><?php echo $d->jk; ?>
            <option disabled>-Pilih Jenis Kelamin-</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>No. Telepon Aktif</label>
            <input type="number" name="telp" id="telp" class="form-control" placeholder="No. Telepon atau WhatsApp..." value="<?=$d->telp?>" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Agama</label>
            <select name="agama" class="form-control">
              <option value="<?php echo $d->agama; ?>" selected=""><?php echo $d->agama; ?></option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Hindu">Hindu</option>
              <option value="Budha">Budha</option>
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Pendidikan Terakhir</label>
            <input type="text" name="pend" id="pend" class="form-control" placeholder="SD/SMP/SMA/Diploma/Sarjana..." value="<?=$d->pend?>" required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control" name="id_jabatan">
              <?php foreach($list_jabatan as $s){?>
                <?php if($d->id_jabatan == $s->id_jabatan){?>
              <option value="<?=$d->id_jabatan?>" selected=""><?php echo $s->jabatan; ?></option>
              <?php }else{?>
              <option value="<?=$s->id_jabatan?>"><?=$s->jabatan?></option>
                <?php } ?>
                <?php } ?>
            </select>
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