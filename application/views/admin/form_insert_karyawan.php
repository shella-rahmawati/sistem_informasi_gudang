<?php $halaman = "tabel_karyawan"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><i class="fas fa-archive" aria-hidden="true"></i> Input Karyawan Baru</h1>
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

  <section class="content"><!--Start Section-->
  <div class="container-fluid"><!--Start Container-Fluid-->
  <div class="row">
  <div class="col-md-12">
  <div class="card card-primary">
    <form action="<?=base_url('admin/proses_karyawan_insert')?>" role="form" method="post">
    <div class="card-body">
      <?php if($this->session->flashdata('msg_berhasil')){ ?>
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Berhasil!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
      </div>
      <?php } ?>
      <?php if(validation_errors()){ ?>
      <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Peringatan!</strong><br> <?php echo validation_errors(); ?>
      </div>
      <?php } ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>NIK</label>
            <input type="number" name="nik" id="nik" class="form-control" placeholder="Nomor Induk Kependudukan..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" id="password" class="form-control" placeholder="Password..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat Lengkap..."></textarea>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control">
            <option selected disabled>-Pilih Jenis Kelamin-</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>No. Telepon Aktif</label>
            <input type="number" name="telp" id="telp" class="form-control" placeholder="No. Telepon atau WhatsApp..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Agama</label>
            <select name="agama" class="form-control">
              <option selected disabled>-Pilih Agama-</option>
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
            <input type="text" name="pend" id="pend" class="form-control" placeholder="SD/SMP/SMA/Diploma/Sarjana..." required>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control" name="id_jabatan">
              <option selected disabled>-Pilih Jabatan-</option>
              <?php foreach($list_jabatan as $s){ ?>
              <option value="<?=$s->id_jabatan?>"><?=$s->jabatan?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      
      <!-- /.box-body --><hr/>
      <div class="box-body">
        <a type="button" class="btn btn-danger" style="width:15%;margin-right:20%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Kembali</a>
        <button type="reset" class="btn btn-warning" name="btn_reset" style="width:29%;margin-right:20%"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Reset</b></button>
        <button type="submit" style="width:15%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
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