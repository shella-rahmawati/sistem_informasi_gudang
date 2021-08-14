<?php 

class M_admin extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function cek_jumlah($tabel,$id_transaksi)
  {
    return  $this->db->select('*')
               ->from($tabel)
               ->where('id_transaksi',$id_transaksi)
               ->get();
  }

  public function get_data_array($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->result_array();
  }

  public function get_data($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->result();
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

  public function mengurangi($tabel,$id_transaksi,$jumlah)
  {
    $this->db->set("jumlah","jumlah - $jumlah");
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update($tabel);
  }

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
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

  public function kecuali($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }
  
function join_tbmasuk(){
      $this->db->select('*');
      $this->db->from('tb_barang_masuk');
      $this->db->join('tb_produk','tb_produk.id_produk = tb_barang_masuk.id_produk');    
      $this->db->order_by('id_transaksi','desc');
      $query = $this->db->get();
      return $query;
   }

function join2table(){
      $this->db->select('*');
      $this->db->from('tb_karyawan');
      $this->db->join('tb_jabatan','tb_jabatan.id_jabatan = tb_karyawan.id_jabatan');  
      $this->db->order_by('id_karyawan','desc');
      $query = $this->db->get();
      return $query;
   }

function join_tbproduk(){
      $this->db->select('*');
      $this->db->from('tb_produk');
      $this->db->join('tb_kat_barang','tb_kat_barang.id_kategori = tb_produk.id_kategori');    
      $this->db->order_by('id_produk','desc');
      $query = $this->db->get();
      return $query;
   }

function join_tbusers(){
      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('tb_upload_gambar_user','tb_upload_gambar_user.username_user = user.username');   
      $query = $this->db->get();
      return $query;
   }

  function join_tbkeluar(){
      $this->db->select('*');
      $this->db->from('tb_barang_keluar');
      $this->db->join('tb_produk','tb_produk.id_produk = tb_barang_keluar.id_produk');    
      $this->db->order_by('id_transaksi','desc');
      $query = $this->db->get();
      return $query;
   }

   

}
 ?>
