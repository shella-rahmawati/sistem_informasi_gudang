<?php
class M_karyawan extends CI_Model{

  public function get_data_gambar($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
  }

  public function get_data($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->result();
  }

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function sum($tabel,$field)
  {
    $query = $this->db->select_sum($field)
                      ->from($tabel)
                      ->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  function join_tbusers(){
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('tb_upload_gambar_user','tb_upload_gambar_user.username_user = user.username');   
      $query = $this->db->get();
      return $query;
   }

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  function join2table(){
      $this->db->select('*');
      $this->db->from('tb_user');
      $this->db->join('tb_jabatan','tb_jabatan.id_jabatan = tb_user.role');  
      $this->db->order_by('id_karyawan','desc');
      $query = $this->db->get();
      return $query;
   }



#######################################################################################################
#######################################################################################################
#######################################################################################################

}
?>