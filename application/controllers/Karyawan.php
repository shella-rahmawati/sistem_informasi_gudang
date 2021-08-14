<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
  public function __construct(){
    parent::__construct();
    $this->load->model('M_karyawan');
    $this->load->library('upload');
  }
 
  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 2 or 3 or 4 or 5 or 6){
      $data['avatar'] = $this->M_karyawan->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['title'] = "Karyawan | CV Greenlife Tirta Sentosa";
      $this->load->view('karyawan/index',$data);
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
    $data['join_users'] = $this->M_karyawan->join_tbusers()->result();
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_karyawan->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('karyawan/index',$data);
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

        $this->M_karyawan->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('karyawan/index'));
      }
    }else {
      $this->load->view('karyawan/index');
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
        $this->load->view('karyawan/index',$data);
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
          $this->load->view('karyawan/index',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_karyawan->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
        redirect(base_url('karyawan/index'));
      }
  }
  ########################################################################
                                // Akhir Profile
  ########################################################################

  public function tabel_gaji()
  {
    $data['join_karyawan'] = $this->M_admin->join2table()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel_gaji',$data);
  }


}
?>