<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
		parent::__construct();
    $this->load->model('M_admin');
    $this->load->library('upload');
	}
 
  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1){
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['stokBarangMasuk'] = $this->M_admin->sum('tb_barang_masuk','jumlah');
      $data['stokBarangKeluar'] = $this->M_admin->sum('tb_barang_keluar','jumlah');      
      $data['dataProduk'] = $this->M_admin->numrows('tb_produk');
      $data['dataKaryawan'] = $this->M_admin->numrows('tb_karyawan');
      $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
      $this->load->view('admin/index',$data);
    }else {
      $this->load->view('login/login');
    }
  }

  public function sigout(){
    session_destroy();
    redirect('login');
  }

  ####################################
              // Profile
  ####################################

  public function profile()
  {
    $data['join_users'] = $this->M_admin->join_tbusers()->result();
    $data['token_generate'] = $this->token_generate();
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/profile',$data);
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('namalengkap','Nama Lengkap','required');
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('new_password','New Password','required');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $namalengkap = $this->input->post('namalengkap');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
            'namalengkap' => $namalengkap,
            'email'       => $email,
            'password'    => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_admin->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('admin/profile'));
      }
    }else {
      $this->load->view('admin/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
                   'upload_path'     => "./assets/upload/user/img/",
                   'allowed_types'   => "gif|jpg|png|jpeg",
                   'encrypt_name'    => False, //
                   'max_size'        => "50000",  // ukuran file gambar
                   'max_height'      => "9680",
                   'max_width'       => "9024"
                 );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if( ! $this->upload->do_upload('userpicture'))
      {
        $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
        $this->load->view('admin/profile',$data);
      }else{
        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];
        $ukuran_file = $upload_data['file_size'];

        //resize img + thumb Img -- Optional
        $config['image_library']     = 'gd2';
				$config['source_image']      = $upload_data['full_path'];
				$config['create_thumb']      = FALSE;
				$config['maintain_ratio']    = TRUE;
				$config['width']             = 150;
				$config['height']            = 150;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
				if (!$this->image_lib->resize())
        {
          $data['pesan_error'] = $this->image_lib->display_errors();
          $this->load->view('admin/profile',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_admin->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
        redirect(base_url('admin/profile'));
      }
  }

  ####################################
           // End Profile
  ####################################



  ####################################
              // Users
  ####################################
  public function users()
  {
    $data['list_users'] = $this->M_admin->kecuali('user',$this->session->userdata('name'));
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $this->session->set_userdata($data);
    $this->load->view('admin/users',$data);
  }

  public function form_user()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_insert_users',$data);
  }

  public function update_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $data['token_generate'] = $this->token_generate();
    $data['list_data'] = $this->M_admin->get_data('user',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_update_users',$data);
  }

  public function proses_delete_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $this->M_admin->delete('user',$where);
    $this->session->set_flashdata('msg_berhasil','User Behasil Di Delete');
    redirect(base_url('admin/users'));

  }

  public function proses_tambah_user()
  {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('email','Email','required|valid_email');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('confirm_password','Confirm password','required|matches[password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {

        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $namalengkap  = $this->input->post('namalengkap',TRUE);
        $password     = $this->input->post('password',TRUE);
        $role         = $this->input->post('role',TRUE);

        $data = array(
              'username'     => $username,
              'email'        => $email,
              'namalengkap'  => $namalengkap,
              'password'     => $this->hash_password($password),
              'role'         => $role,
        );
        $this->M_admin->insert('user',$data);

        $this->session->set_flashdata('msg_berhasil','User Berhasil Ditambahkan');
        redirect(base_url('admin/form_user'));
        }
      }else {
        $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
        $this->load->view('admin/form_users/form_insert',$data);
    }
  }

  public function proses_update_user()
  {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('namalengkap','Nama Lengkap','required');
    $this->form_validation->set_rules('email','Email','required|valid_email');

    
    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $id           = $this->input->post('id',TRUE);        
        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $namalengkap  = $this->input->post('namalengkap',TRUE);
        $role         = $this->input->post('role',TRUE);

        $where = array('id' => $id);
        $data = array(
              'username'     => $username,
              'email'        => $email,
              'namalengkap'  => $namalengkap,
              'role'         => $role,
        );
        $this->M_admin->update('user',$data,$where);
        $this->session->set_flashdata('msg_berhasil','Data User Berhasil Diupdate');
        redirect(base_url('admin/users'));
       }
    }else{
        $this->load->view('admin/form_users/form_update');
    }
  }


  ####################################
           // End Users
  ####################################



  ####################################
        // DATA BARANG MASUK
  ####################################

  public function form_barangmasuk()
  {
    $data['list_satuan'] = $this->M_admin->join_tbmasuk()->result();
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['list_produk'] = $this->M_admin->select('tb_produk');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_insert_barangmasuk',$data);
  }

  public function tabel_barangmasuk()
  {
    $data['list_data'] = $this->M_admin->join_tbmasuk()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_barangmasuk',$data);
  }

  public function update_barang($id_transaksi)
  {
    $where = array('id_transaksi' => $id_transaksi);
    $data['data_barang_update'] = $this->M_admin->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['list_produk'] = $this->M_admin->select('tb_produk');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_update_barangmasuk',$data);
  }

  public function delete_barang($id_transaksi)
  {
    $where = array('id_transaksi' => $id_transaksi);
    $this->M_admin->delete('tb_barang_masuk',$where);
    redirect(base_url('admin/tabel_barangmasuk'));
  }

  public function proses_databarang_masuk_insert()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->form_validation->set_rules('id_produk','Kode Barang','required');
    $this->form_validation->set_rules('jumlah','Jumlah','required');

    if($this->form_validation->run() == TRUE)
    {
      $id_transaksi = $this->input->post('id_transaksi',TRUE);
      $tanggal      = $this->input->post('tanggal',TRUE);
      $petugas       = $this->input->post('petugas',TRUE);
      $id_produk    = $this->input->post('id_produk',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $jumlah       = $this->input->post('jumlah',TRUE);

      $data = array(
            'id_transaksi' => $id_transaksi,
            'tanggal'      => $tanggal,
            'petugas'       => $petugas,
            'id_produk'    => $id_produk,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->M_admin->insert('tb_barang_masuk',$data);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_barangmasuk'));
    }else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $data['list_produk'] = $this->M_admin->select('tb_produk');
      $this->load->view('admin/tabel_barangmasuk',$data);
    }
  }

  public function proses_databarang_masuk_update()
  {
    $this->form_validation->set_rules('petugas','Petugas','required');
    $this->form_validation->set_rules('id_produk','Id Produk','required');
    $this->form_validation->set_rules('jumlah','Jumlah','required');

    if($this->form_validation->run() == TRUE)
    {
      $id_transaksi = $this->input->post('id_transaksi',TRUE);
      $tanggal      = $this->input->post('tanggal',TRUE);
      $petugas       = $this->input->post('petugas',TRUE);
      $id_produk  = $this->input->post('id_produk',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $jumlah       = $this->input->post('jumlah',TRUE);

      $where = array('id_transaksi' => $id_transaksi);
      $data = array(
            'id_transaksi' => $id_transaksi,
            'tanggal'      => $tanggal,
            'petugas'       => $petugas,
            'id_produk'    => $id_produk,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->M_admin->update('tb_barang_masuk',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Diupdate');
      redirect(base_url('admin/tabel_barangmasuk'));
    }else{
      $data['list_produk'] = $this->M_admin->select('tb_produk');
      $this->load->view('admin/form_update_barangmasuk');
    }
  }
  ####################################
      // END DATA BARANG MASUK
  ####################################


  ####################################
              // SATUAN
  ####################################

  public function form_satuan()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_insert_satuan',$data);
  }

  public function tabel_satuan()
  {
    $data['list_data'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_satuan',$data);
  }

  public function update_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $data['data_satuan'] = $this->M_admin->get_data('tb_satuan',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_update_satuan',$data);
  }

  public function delete_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $this->M_admin->delete('tb_satuan',$where);
    redirect(base_url('admin/tabel_satuan'));
  }

  public function proses_satuan_insert()
  {
    $this->form_validation->set_rules('kode_satuan','Kode Satuan','trim|required|max_length[100]');
    $this->form_validation->set_rules('nama_satuan','Nama Satuan','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $kode_satuan = $this->input->post('kode_satuan' ,TRUE);
      $nama_satuan = $this->input->post('nama_satuan' ,TRUE);

      $data = array(
            'kode_satuan' => $kode_satuan,
            'nama_satuan' => $nama_satuan
      );
      $this->M_admin->insert('tb_satuan',$data);

      $this->session->set_flashdata('msg_berhasil','Data satuan Berhasil Ditambahkan');
      redirect(base_url('admin/form_satuan'));
    }else {
      $this->load->view('admin/form_satuan/form_insert');
    }
  }

  public function proses_satuan_update()
  {
    $this->form_validation->set_rules('kode_satuan','Kode Satuan','trim|required|max_length[100]');
    $this->form_validation->set_rules('nama_satuan','Nama Satuan','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_satuan   = $this->input->post('id_satuan' ,TRUE);
      $kode_satuan = $this->input->post('kode_satuan' ,TRUE);
      $nama_satuan = $this->input->post('nama_satuan' ,TRUE);

      $where = array(
            'id_satuan' => $id_satuan
      );

      $data = array(
            'kode_satuan' => $kode_satuan,
            'nama_satuan' => $nama_satuan
      );
      $this->M_admin->update('tb_satuan',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data satuan Berhasil Di Update');
      redirect(base_url('admin/tabel_satuan'));
    }else {
      $this->load->view('admin/form_satuan/form_update');
    }
  }

  ####################################
            // END SATUAN
  ####################################


  ####################################
     // DATA MASUK KE DATA KELUAR
  ####################################

  public function barang_keluar()
  {
    $uri = $this->uri->segment(3);
    $where = array( 'id_transaksi' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['list_produk'] = $this->M_admin->select('tb_produk');
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/barang_keluar',$data);
  }

  public function proses_data_keluar()
  {
    $this->form_validation->set_rules('tanggal_keluar','Tanggal Keluar','trim|required');
    if($this->form_validation->run() === TRUE)
    {
      $id_transaksi   = $this->input->post('id_transaksi',TRUE);
      $tanggal_masuk  = $this->input->post('tanggal',TRUE);
      $tanggal_keluar = $this->input->post('tanggal_keluar',TRUE);
      $lokasi         = $this->input->post('lokasi',TRUE);
      $petugas         = $this->input->post('petugas',TRUE);
      $id_produk    = $this->input->post('id_produk',TRUE);
      $satuan         = $this->input->post('satuan',TRUE);
      $jumlah         = $this->input->post('jumlah',TRUE);

      $where = array( 'id_transaksi' => $id_transaksi);
      $data = array(
              'id_transaksi' => $id_transaksi,
              'tanggal_masuk' => $tanggal_masuk,
              'tanggal_keluar' => $tanggal_keluar,
              'petugas' => $petugas,
              'lokasi' => $lokasi,
              'id_produk' => $id_produk,
              'satuan' => $satuan,
              'jumlah' => $jumlah
      );
        $this->M_admin->insert('tb_barang_keluar',$data);
        $this->session->set_flashdata('msg_berhasil_keluar','Data Berhasil Keluar');
        redirect(base_url('admin/tabel_barangkeluar'));
    }else {
      $this->load->view('admin/tabel_barangkeluar'.$id_transaksi);
    }

  }
  ####################################
    // END DATA MASUK KE DATA KELUAR
  ####################################


  ####################################
        // DATA BARANG KELUAR
  ####################################

  public function tabel_barangkeluar()
  {
    $data['list_data'] = $this->M_admin->join_tbkeluar()->result();
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_barangkeluar',$data);
  }

  ####################################
    // END DATA BARANG KELUAR
  ####################################


  ####################################
  // DATA KARYAWAN
  ####################################
  public function form_karyawan()
  {
    $data['list_jabatan'] = $this->M_admin->select('tb_jabatan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_insert_karyawan',$data);
  }

  public function tabel_karyawan()
  {
    $data['join_karyawan'] = $this->M_admin->join2table()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_karyawan',$data);
  }

  public function update_karyawan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_karyawan' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_karyawan',$where);
    $data['list_jabatan'] = $this->M_admin->select('tb_jabatan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_update_karyawan',$data);
  }

  public function delete_karyawan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_karyawan' => $uri);
    $this->M_admin->delete('tb_karyawan',$where);
    redirect(base_url('admin/tabel_karyawan'));
  }

  public function proses_karyawan_insert()
  {
    $this->form_validation->set_rules('nik','Nomor Induk Kependudukan','required');
    $this->form_validation->set_rules('nama','Nama Karyawan','required');
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('password','Password','required');

    if($this->form_validation->run() ==  TRUE)
    {
      $nik = $this->input->post('nik' ,TRUE);
      $username = $this->input->post('username' ,TRUE);
      $password = $this->input->post('password' ,TRUE);
      $nama = $this->input->post('nama' ,TRUE);
      $alamat = $this->input->post('alamat' ,TRUE);
      $telp = $this->input->post('telp' ,TRUE);
      $jk = $this->input->post('jk' ,TRUE);
      $agama = $this->input->post('agama' ,TRUE);
      $pend = $this->input->post('pend' ,TRUE);
      $id_jabatan = $this->input->post('id_jabatan' ,TRUE);

      $data = array(
            'nik' => $nik,
            'username' => $username,
            'password' => $this->hash_password($password),
            'nama' => $nama,
            'alamat' => $alamat,
            'telp' => $telp,
            'jk' => $jk,
            'agama' => $agama,
            'pend' => $pend,
            'id_jabatan' => $id_jabatan
      );

      $dataUpload1 = array(
              'id'     => '',
              'username' => $username,
              'email' => 'cvgreenlife@gmail.com',
              'password' => $this->hash_password($password),
              'role' => $id_jabatan,
              'namalengkap' => $nama
        );

      $dataUpload2 = array(
              'id'     => '',
              'username_user' => $username,
              'nama_file' => 'cv.png',
              'ukuran_file' => '22.7'
        );

      $this->M_admin->insert('tb_karyawan',$data);
      $this->M_admin->insert('user',$dataUpload1);
      $this->M_admin->insert('tb_upload_gambar_user',$dataUpload2);
      $this->session->set_flashdata('msg_berhasil','Data karyawan Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_karyawan'));
    }else {
      $data['list_jabatan'] = $this->M_admin->select('tb_jabatan');
      $this->load->view('admin/form_insert_karyawan');
    }
  }

  public function proses_karyawan_update()
  {
    $this->form_validation->set_rules('nik','Nomor Induk Kependudukan','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_karyawan   = $this->input->post('id_karyawan' ,TRUE);
      $nik = $this->input->post('nik' ,TRUE);
      $nama = $this->input->post('nama' ,TRUE);
      $alamat = $this->input->post('alamat' ,TRUE);
      $telp = $this->input->post('telp' ,TRUE);
      $jk = $this->input->post('jk' ,TRUE);
      $agama = $this->input->post('agama' ,TRUE);
      $pend = $this->input->post('pend' ,TRUE);
      $id_jabatan = $this->input->post('id_jabatan' ,TRUE);

      $where = array(
            'id_karyawan' => $id_karyawan
      );

      $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'alamat' => $alamat,
            'telp' => $telp,
            'jk' => $jk,
            'agama' => $agama,
            'pend' => $pend,
            'id_jabatan' => $id_jabatan
      );
      $this->M_admin->update('tb_karyawan',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Karyawan Berhasil Di Update');
      redirect(base_url('admin/tabel_karyawan'));
    }else {
      $data['list_jabatan'] = $this->M_admin->select('tb_jabatan');
      $this->load->view('admin/form_update_karyawan');
    }
  }

  ####################################
            // END KARYAWAN
  ####################################


  ####################################
          // DATA JABATAN
  ####################################

  public function form_jabatan()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_insert_jabatan',$data);
  }

  public function tabel_jabatan()
  {
    $data['list_data'] = $this->M_admin->select('tb_jabatan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_jabatan',$data);
  }

  public function update_jabatan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_jabatan' => $uri);
    $data['data_jabatan'] = $this->M_admin->get_data('tb_jabatan',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_update_jabatan',$data);
  }

  public function delete_jabatan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_jabatan' => $uri);
    $this->M_admin->delete('tb_jabatan',$where);
    redirect(base_url('admin/tabel_jabatan'));
  }

  public function proses_jabatan_insert()
  {
    $this->form_validation->set_rules('jabatan','Jabatan','required');
    $this->form_validation->set_rules('gapok','Gaji Pokok','required');
    $this->form_validation->set_rules('tukes','Tunjangan Kesehatan','required');
    $this->form_validation->set_rules('uangmakan','Uang Makan','required');
    $this->form_validation->set_rules('tutra','Tunjangan Transport','required');

    if($this->form_validation->run() ==  TRUE)
    {
      $jabatan = $this->input->post('jabatan' ,TRUE);
      $gapok = $this->input->post('gapok' ,TRUE);
      $tukes = $this->input->post('tukes' ,TRUE);
      $uangmakan = $this->input->post('uangmakan' ,TRUE);
      $tutra = $this->input->post('tutra' ,TRUE);

      $data = array(
            'jabatan' => $jabatan,
            'gapok' => $gapok,
            'tukes' => $tukes,
            'uangmakan' => $uangmakan,
            'tutra' => $tutra
      );
      $this->M_admin->insert('tb_jabatan',$data);

      $this->session->set_flashdata('msg_berhasil','Data jabatan Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_jabatan'));
    }else {
      $this->load->view('admin/tabel_jabatan');
    }
  }

  public function proses_jabatan_update()
  {
    $this->form_validation->set_rules('jabatan','Jabatan','trim|required|max_length[100]');
    $this->form_validation->set_rules('gapok','Gaji Pokok','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_jabatan = $this->input->post('id_jabatan' ,TRUE);
      $jabatan = $this->input->post('jabatan' ,TRUE);
      $gapok = $this->input->post('gapok' ,TRUE);
      $tukes = $this->input->post('tukes' ,TRUE);
      $uangmakan = $this->input->post('uangmakan' ,TRUE);
      $tutra = $this->input->post('tutra' ,TRUE);

      $where = array(
            'id_jabatan' => $id_jabatan
      );

      $data = array(
            'id_jabatan' => $id_jabatan,
            'jabatan' => $jabatan,
            'gapok' => $gapok,
            'tukes' => $tukes,
            'uangmakan' => $uangmakan,
            'tutra' => $tutra
      );
      $this->M_admin->update('tb_jabatan',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Jabatan Berhasil Di Update');
      redirect(base_url('admin/tabel_jabatan'));
    }else {
      $this->load->view('admin/form_update_jabatan');
    }
  }

  ####################################
            // END JABATAN
  ####################################

  ####################################
            // DATA PRODUK
  ####################################
  public function form_produk()
  {
    $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_produk',$data);
  }

  public function tabel_produk()
  {
    $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
    $data['join_produk'] = $this->M_admin->join_tbproduk()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_produk',$data);
  }

  public function detail_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_produk',$where);
    $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/detail_produk',$data);
  }

  public function update_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_produk',$where);
    $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_update_produk',$data);
  }

  public function delete_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $this->M_admin->delete('tb_produk',$where);
    redirect(base_url('admin/tabel_produk'));
  }

  public function proses_produk_insert()
  {
    $this->form_validation->set_rules('nama_produk','Nama Produk','required');
    $this->form_validation->set_rules('harga','Harga Produk','required');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_produk = $this->input->post('id_produk' ,TRUE);
      $nama_produk = $this->input->post('nama_produk' ,TRUE);
      $harga = $this->input->post('harga' ,TRUE);
      $brand = $this->input->post('brand' ,TRUE);
      $id_kategori = $this->input->post('id_kategori' ,TRUE);
      $berat = $this->input->post('berat' ,TRUE);
      $deskripsi = $this->input->post('deskripsi' ,TRUE);
      $gambar = $this->input->post('gambar' ,TRUE);

      $data = array(
            'id_produk' => $id_produk,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'brand' => $brand,
            'id_kategori' => $id_kategori,
            'berat' => $berat,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
      );
      $this->M_admin->insert('tb_produk',$data);

      $this->session->set_flashdata('msg_berhasil','Data Produk Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_produk'));
    }else {
      $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
      $this->load->view('admin/tabel_produk');
    }
  }

  public function proses_produk_update()
  {
    $this->form_validation->set_rules('nama_produk','Nama Produk','trim|required');
    $this->form_validation->set_rules('harga','Harga Produk','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_produk = $this->input->post('id_produk' ,TRUE);
      $nama_produk = $this->input->post('nama_produk' ,TRUE);
      $harga = $this->input->post('harga' ,TRUE);
      $brand = $this->input->post('brand' ,TRUE);
      $id_kategori = $this->input->post('id_kategori' ,TRUE);
      $berat = $this->input->post('berat' ,TRUE);
      $deskripsi = $this->input->post('deskripsi' ,TRUE);
      $gambar = $this->input->post('gambar' ,TRUE);

      $where = array(
            'id_produk' => $id_produk
      );

      $data = array(
            'id_produk' => $id_produk,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'brand' => $brand,
            'id_kategori' => $id_kategori,
            'berat' => $berat,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
      );
      $this->M_admin->update('tb_produk',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Produk Berhasil Di Update');
      redirect(base_url('admin/tabel_produk'));
    }else {
      $data['list_kat_barang'] = $this->M_admin->select('tb_kat_barang');
      $this->load->view('admin/form_update_produk');
    }
  }

  ####################################
            // END PRODUK
  ####################################

public function tabel_gaji()
  {
    $data['join_karyawan'] = $this->M_admin->join2table()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_gaji',$data);
  }

  
}
?>