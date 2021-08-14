<?php $halaman = "tabel_gaji"; ?>
<?php include 'header.php'; ?>
<?php include 'aside.php'; ?>

<div class="content-wrapper"><!--Start Content Wrapper-->
  <div class="content-header"><!--Start Content Header -->
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3><i class="fas fa-columns" aria-hidden="true"></i> Gaji Karyawan</h3>
      </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a>Administrator</a></li>
        <li class="breadcrumb-item active">Gaji Karyawan</li>
      </ol>
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div><!-- /END content-header -->

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
  <div class="card card-solid">
  <div class="card-body pb-0">
  <div class="row">
    <?php if(is_array($join_karyawan)){ ?>
    <?php $no = 1;?>
    <?php foreach($join_karyawan as $dd): ?>
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
      <div class="card bg-light d-flex flex-fill card-danger card-outline">
        <div class="card-header text-muted border-bottom-0">
          <?=$dd->jabatan?>
        </div>
        <div class="card-body pt-0 ">
        <div class="row">
        <div class="col-7">
          <h2 class="lead"><b><?=$dd->nama?></b></h2>
          <p class="text-muted text-sm" hidden="true"><?=$no?></p><hr/>
          <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fas fa-book mr-1"></i></span> <?=$dd->jk?> | Agama <?=$dd->agama?></li>
            <li class="small"><span class="fa-li"></span> <?=$dd->pend?></li>
            <li class="small"><span class="fa-li"><i class="fas fa-home"></i></span> Alamat : <?=$dd->alamat?></li>
            <li class="small"><span class="fa-li"><i class="fas fa-phone"></i></span> <?=$dd->telp?></li>
          </ul><hr/>
          <p hidden="true"><?=$dd->gapok?><?=$dd->tukes?><?=$dd->uangmakan?><?=$dd->tutra?></p>
        </div>
        <div class="col-5 text-center">
          <img src="<?php echo base_url()?>assets/upload/user/img/<?= $dd->gambar?>" alt="user-avatar" class="img-circle img-fluid">
        </div>
        </div>
        </div>
        <h2 class="lead" style="margin-left:20px"><b>Rp. 
            <?php 
            $total = $dd->gapok+$dd->tukes+$dd->uangmakan+$dd->tutra;
            $this->load->helper('rupiah_helper');
            echo rupiah($total);?></b></h2>
        <div class="card-footer">
          <div class="text-right">
            <a href="#" class="btn btn-sm btn-warning">
              <i class="fas fa-eye"></i>  Detail Gaji
            </a>
          </div>
        </div>
      </div>
    </div>
      <?php $no++; ?>
      <?php endforeach;?>
      <?php }else { ?>
      <strong>Data Kosong</strong></td>
      <?php } ?>
    
    
  </div><!-- /.row -->
  </div><!-- /.card-body -->
  </div><!-- /.card -->
  </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<?php include 'footer.php'; ?>