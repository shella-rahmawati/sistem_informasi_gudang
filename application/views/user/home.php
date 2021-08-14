<div class="row"> 
  <div class="col-lg-3 col-6"><!-- Stok Barang Gudang -->
    <div class="small-box bg-gradient-danger">
      <div class="inner">
        <?php if(!empty($stokBarangMasuk)){ ?>
        <?php foreach($stokBarangMasuk as $d){ ?>
        <h3><?=$d->jumlah?></h3>
        <?php } ?>
        <?php }else{ ?>
        <h3>0</h3>
        <?php } ?>
        <p>Stok Produk Gudang</p>
      </div>
      <div class="icon">
        <i class="ion ion-pricetag"></i>
      </div>
      <a href="<?=base_url('user/tabel_barangmasuk')?>" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6"><!-- Stok Barang Gudang -->
    <!-- small box -->
    <div class="small-box bg-gradient-orange">
      <div class="inner">
        <?php if(!empty($stokBarangKeluar)){ ?>
     <?php foreach($stokBarangKeluar as $d){?>
      <h3><?=$d->jumlah?></h3>
     <?php } ?>
     <?php }else{?>
      <h3>0</h3>
     <?php } ?>
      <p>Stok Produk Keluar</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="<?=base_url('user/tabel_barangkeluar')?>" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-gradient-info">
      <div class="inner">
        <?php if(!empty($dataProduk)){ ?>
      <h3><?=$dataProduk?></h3>
        <?php } ?>
      <p>Produk CV. Greenlife</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="<?=base_url('user/users')?>" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-gradient-warning">
      <div class="inner">
        <?php if(!empty($dataKaryawan)){ ?>
      <h3><?=$dataKaryawan?></h3>
        <?php } ?>
        <p>Karyawan CV. Greenlife</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>


<!--ini copy -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-7">
    <!-- TO DO List -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">
          <i class="ion ion-clipboard mr-1"></i> Halaman Staff Gudang CV. Greenlife 
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <div class="text-center">
        <?php foreach($avatar as $a){ ?>
        <img class="profile-user-img img-responsive img-circle animation__shake" src="<?php echo base_url()?>assets/upload/user/img/<?= $a->nama_file?>" alt="User profile picture">
        <?php } ?>
      </div>
      <h3 class="profile-username text-center">Selamat datang <?=$this->session->userdata('namalengkap')?> <i class="ion ion-heart"></i></h3>
      <p class="text-muted text-center">Software Engineer</p>
      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <b>Login terakhir</b> <a class="float-right"><?=$this->session->userdata('last_login')?></a>
        </li>
        <li class="list-group-item">
          <b>Role ID</b> <a class="float-right">Staff Gudang</a>
        </li>
        <li class="nav-link">
          <center><font color="green"><b>CV. Greenlife Tirta Sentosa</b></font></center>
        </li>
      </ul>
      </div>
      <!-- /.card-body -->
    </div>
  <!-- /.card -->
  </section>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
  <section class="col-lg-5">
  <!-- Calendar -->
    <div class="card bg-gradient-secondary">
      <div class="card-header border-0">

        <h3 class="card-title">
          <i class="far fa-calendar-alt"></i>
          Kalender
        </h3>
        <!-- tools card -->
        <div class="card-tools">
          <button type="button" class="btn btn-secondary btn-sm" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-secondary btn-sm" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <!-- /. tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body pt-0">
        <!--The calendar -->
        <div id="calendar" style="width: 100%"></div>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- Map card -->
    <div class="card bg-gradient-primary">
    <!-- /.card-body-->
      <div class="card-footer bg-transparent">
        <div class="row">
          <div class="col-4 text-center">
            <div id="sparkline-1"></div>
            <div class="text-white">Website Admin</div>
          </div>
          <!-- ./col -->
          <div class="col-4 text-center">
            <div id="sparkline-2"></div>
            <div class="text-white">CV. Greenlife</div>
          </div>
          <!-- ./col -->
          <div class="col-4 text-center">
            <div id="sparkline-3"></div>
            <div class="text-white">Tirta Sentosa</div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    
  </section>
  <!-- right col -->
</div>