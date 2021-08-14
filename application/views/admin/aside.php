<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a class="brand-link">
    <span class="brand-text font-weight-light"> CV. Greenlife Tirta Sentosa</span>
  </a>

  <div class="sidebar"><!--start sidebar-->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php foreach($avatar as $a){ ?>
          <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
        </div>
        <div class="info">
          <a href="admin/profile" class="d-block"><?=$this->session->userdata('namalengkap')?></a>
        </div>
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item  ">
          <a href="<?php echo base_url('admin')?>" class="nav-link <?php echo activate_menu($halaman == "index")?>">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header  "><b>GUDANG</b></li>
        <li class="nav-item  ">
          <a href="<?php echo base_url('admin/tabel_produk')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_produk")?>">
          <i class="nav-icon fas fa-laptop"></i>
          <p>Produk</p>
          </a>
        </li>
        <!--<li class="nav-item">
          <a href="<?php echo base_url('admin/form_barangmasuk')?>" class="nav-link <?php echo activate_menu($halaman == "insert_barangmasuk")?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>Input Produk Masuk</p>
          </a>
        </li>-->
        <!--<li class="nav-item">
          <a href="<?php echo base_url('admin/tabel_barangmasuk')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_barangmasuk")?>">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>Produk Masuk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/tabel_barangkeluar')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_barangkeluar")?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Produk Keluar</p>
          </a>
        </li>
        <li class="nav-item   ">
            <a href="<?php echo base_url('admin/tabel_satuan')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_satuan")?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>Satuan Produk</p>
            </a>
          </li>-->
          <li class="nav-header  "><b>KARYAWAN</b></li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/tabel_karyawan')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_karyawan")?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Data Karyawan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/tabel_jabatan')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_jabatan")?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Data Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item  ">
            <a href="<?php echo base_url('admin/tabel_gaji')?>" class="nav-link <?php echo activate_menu($halaman == "tabel_gaji")?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gaji Karyawan
              </p>
            </a>
          </li>
          <li class="nav-header  "><b>SETTING</b></li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/profile')?>" class="nav-link <?php echo activate_menu($halaman == "profile")?>">
              <i class="nav-icon fas fa-wrench"></i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/users')?>" class="nav-link <?php echo activate_menu($halaman == "users")?>">
              <i class="nav-icon fas fa-user"></i>
              <p>Data User</p>
            </a>
          </li>
      </ul>
    </nav>
  </div><!--stop sidebar-->
</aside>