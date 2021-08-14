<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('M_user');
    $this->load->library('upload');
  }
 
  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 0){
      $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['stokBarangMasuk'] = $this->M_user->sum('tb_barang_masuk','jumlah');
      $data['stokBarangKeluar'] = $this->M_user->sum('tb_barang_keluar','jumlah');      
      $data['dataProduk'] = $this->M_user->numrows('tb_produk');
      $data['dataKaryawan'] = $this->M_user->numrows('tb_karyawan');
      $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
      $this->load->view('user/index',$data);
    }else {
      $this->load->view('login/login');
    }
  }

  public function sigout(){
    session_destroy();
    redirect('login');
  }
  

  ########################################################################
                                // Awal Profile
  ########################################################################
  public function profile()
  {
    $data['join_users'] = $this->M_user->join_tbusers()->result();
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('user/profile',$data);
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
    $this->form_validation->set_rules('nama','Nama Lengkap','required');
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('new_password','New Password','required');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
            'nama'    => $nama,
            'email'    => $email,
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_user->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('user/profile'));
      }
    }else {
      $this->load->view('user/profile');
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
        $this->load->view('user/profile',$data);
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
          $this->load->view('user/profile',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_user->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
        redirect(base_url('user/profile'));
      }
  }
  ########################################################################
                                // Akhir Profile
  ########################################################################


  ########################################################################
                              // AWAL PRODUK
  ########################################################################
  public function form_produk()
  {
    $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name','nama'));
    $this->load->view('user/tabel_produk',$data);
  }

  public function tabel_produk()
  {
    $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
    $data['join_produk'] = $this->M_user->join_tbproduk()->result();
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/tabel_produk',$data);
  }

  public function detail_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $data['list_data'] = $this->M_user->get_data('tb_produk',$where);
    $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/detail_produk',$data);
  }

  public function update_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $data['list_data'] = $this->M_user->get_data('tb_produk',$where);
    $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_update_produk',$data);
  }

  public function delete_produk()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_produk' => $uri);
    $this->M_user->delete('tb_produk',$where);
    redirect(base_url('user/tabel_produk'));
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
      $this->M_user->insert('tb_produk',$data);

      $this->session->set_flashdata('msg_berhasil','Data Produk Berhasil Ditambahkan');
      redirect(base_url('user/tabel_produk'));
    }else {
      $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
      $this->load->view('user/tabel_produk');
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
      $this->M_user->update('tb_produk',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Produk Berhasil Di Update');
      redirect(base_url('user/tabel_produk'));
    }else {
      $data['list_kat_barang'] = $this->M_user->select('tb_kat_barang');
      $this->load->view('user/form_update_produk');
    }
  }

  ########################################################################
                               // AKHIR PRODUK
  ########################################################################

  ########################################################################
        // AWAL SATUAN
  ########################################################################

  public function form_satuan()
  {
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_insert_satuan',$data);
  }

  public function tabel_satuan()
  {
    $data['list_data'] = $this->M_user->select('tb_satuan');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/tabel_satuan',$data);
  }

  public function update_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $data['data_satuan'] = $this->M_user->get_data('tb_satuan',$where);
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_update_satuan',$data);
  }

  public function delete_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $this->M_user->delete('tb_satuan',$where);
    redirect(base_url('user/tabel_satuan'));
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
      $this->M_user->insert('tb_satuan',$data);

      $this->session->set_flashdata('msg_berhasil','Data satuan Berhasil Ditambahkan');
      redirect(base_url('user/form_satuan'));
    }else {
      $this->load->view('user/form_satuan/form_insert');
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
      $this->M_user->update('tb_satuan',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data satuan Berhasil Di Update');
      redirect(base_url('user/tabel_satuan'));
    }else {
      $this->load->view('user/form_satuan/form_update');
    }
  }

  ########################################################################
          // END SATUAN
  ########################################################################

  ########################################################################
                                      // AWAL BARANG MASUK
  ########################################################################

  public function form_barangmasuk() 
  {
    $data['list_satuan'] = $this->M_user->join_tbmasuk()->result();
    $data['list_satuan'] = $this->M_user->select('tb_satuan');
    $data['list_produk'] = $this->M_user->select('tb_produk');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_insert_barangmasuk',$data);
  }

  public function tabel_barangmasuk()
  {
    $data['list_data'] = $this->M_user->join_tbmasuk()->result();
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/tabel_barangmasuk',$data);
  }

  public function update_barang($id_transaksi)
  {
    $where = array('id_transaksi' => $id_transaksi);
    $data['data_barang_update'] = $this->M_user->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_user->select('tb_satuan');
    $data['list_produk'] = $this->M_user->select('tb_produk');
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/form_update_barangmasuk',$data);
  }

  public function delete_barang($id_transaksi)
  {
    $where = array('id_transaksi' => $id_transaksi);
    $this->M_user->delete('tb_barang_masuk',$where);
    redirect(base_url('user/tabel_barangmasuk'));
  }

  public function proses_databarang_masuk_insert()
  {
    $this->form_validation->set_rules('petugas','petugas','required');
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
      $this->M_user->insert('tb_barang_masuk',$data);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
      redirect(base_url('user/tabel_barangmasuk'));
    }else {
      $data['list_satuan'] = $this->M_user->select('tb_satuan');
      $data['list_produk'] = $this->M_user->select('tb_produk');
      $this->load->view('user/tabel_barangmasuk',$data);
    }
  }

  public function proses_databarang_masuk_update()
  {
    $this->form_validation->set_rules('petugas','Lokasi','required');
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
            'petugas'      => $petugas,
            'id_produk'    => $id_produk,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->M_user->update('tb_barang_masuk',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Diupdate');
      redirect(base_url('user/tabel_barangmasuk'));
    }else{
      $data['list_produk'] = $this->M_user->select('tb_produk');
      $this->load->view('user/form_update_barangmasuk');
    }
  }
  ########################################################################
                                             // END BARANG MASUK
  ########################################################################

  ########################################################################
     // DATA MASUK KE DATA KELUAR
  ########################################################################

  public function tabel_barangkeluar()
  {
    $data['list_data'] = $this->M_user->join_tbkeluar()->result();
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/tabel_barangkeluar',$data);
  }
  
  public function barang_keluar()
  {
    $uri = $this->uri->segment(3);
    $where = array( 'id_transaksi' => $uri);
    $data['list_data'] = $this->M_user->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_user->select('tb_satuan');
    $data['list_produk'] = $this->M_user->select('tb_produk');
    $data['title'] = "Admin | CV Greenlife Tirta Sentosa";
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/barang_keluar',$data);
  }

  public function proses_data_keluar()
  {
    $this->form_validation->set_rules('tanggal_keluar','Tanggal Keluar','trim|required');
    if($this->form_validation->run() === TRUE)
    {
      $id_transaksi   = $this->input->post('id_transaksi',TRUE);
      $tanggal_masuk  = $this->input->post('tanggal',TRUE);
      $tanggal_keluar = $this->input->post('tanggal_keluar',TRUE);
      $petugas         = $this->input->post('petugas',TRUE);
      $lokasi         = $this->input->post('lokasi',TRUE);
      $id_produk    = $this->input->post('id_produk',TRUE);
      $satuan         = $this->input->post('satuan',TRUE);
      $jumlah         = $this->input->post('jumlah',TRUE);

      $where = array( 'id_transaksi' => $id_transaksi);
      $data = array(
              'id_transaksi' => $id_transaksi,
              'tanggal_masuk' => $tanggal_masuk,
              'tanggal_keluar' => $tanggal_keluar,
              'lokasi' => $lokasi,
              'petugas' => $petugas,
              'id_produk' => $id_produk,
              'satuan' => $satuan,
              'jumlah' => $jumlah
      );
        $this->M_user->insert('tb_barang_keluar',$data);
        $this->session->set_flashdata('msg_berhasil_keluar','Data Berhasil Keluar');
        redirect(base_url('user/tabel_barangkeluar'));
    }else {
      $this->load->view('user/tabel_barangkeluar'.$id_transaksi);
    }

  }
  ########################################################################
    // END DATA MASUK KE DATA KELUAR
  ########################################################################


}
?>