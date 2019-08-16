<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Komplain extends CI_Model {
  public function __construct()
	{
		$this->db2 = $this->load->database('db2', TRUE);
	}
  function dropdown_karyawan(){
      $query = $this->db2->query('SELECT * FROM karyawan WHERE id_level = 1 or id_level = 3 ORDER BY id_level ASC ');
      return $query->result();
  }
  public function dropdown_kategori_barang(){
      $query = $this->db->query('SELECT DISTINCT kategori_barang FROM barang');
      return $query->result();
  }
  public function detail_kategori($kategori_barang=''){
      return $this->db->select('id_barang, nama_barang')
                      ->where('kategori_barang', $kategori_barang)->get('barang')->result_array();
  }
  public function get_komplain_teknisi(){
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
                    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
                    ->where('nama_teknisi', NULL, TRUE)
                    ->order_by('tgl_activity','asc')
                    ->get('Activity')->result();
  }
  public function get_komplain(){
    if(!empty($_POST['tglmin']) && ['tglmax']){
      $tglmin = $this->input->post('tglmin');
      $tglmax = $this->input->post('tglmax');
      $this->db->where('tgl_activity >=', $tglmin);
      $this->db->where('tgl_activity <=', $tglmax);
    }
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
                    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
                    ->order_by('tgl_activity','asc')
                    ->get('Activity')->result();
  }
  public function get_history(){
    return $this->db->join('History', 'History.id_activity=Activity.id_activity')
                    ->order_by('Activity.id_activity','asc')
                    ->get('Activity')->result();
  }
  //** INSERT KOMPLAIN */
  public function masuk_db(){
    $idkar = ($this->input->post('id_karyawan') ? $this->input->post('id_karyawan') : $this->session->userdata('id_karyawan'));
    $data_activity=array(
      'id_barang'=>$this->input->post('id_barang'),
      'id_karyawan'=>$idkar,
      'id_user'=>$this->session->userdata('id_karyawan'),
      'detail'=>$this->input->post('detail'),
      'tgl_activity'=> date("Y-m-d H:i:s")
    );

    $this->db->insert('activity',$data_activity);
    $id_activity = $this->db->insert_id();
    $this->komplain_history($id_activity);
    return $this->db->select('nama_barang, detail')
    ->from('Barang')
    ->join('Activity', 'barang.id_barang=activity.id_barang')
    ->where('id_activity', $id_activity)
    ->get()->row();
  }
    
  public function userSpesifik($test){
    return $this->db->select('nama')
                    ->from('master_republika.Karyawan')
                    ->where('id_karyawan = ', $test )
                    ->get()->row();
  }
  public function komplain_history($id_activity){
    $data_history=array(
      'id_activity'=>$id_activity,
      'waktu'=>date("Y-m-d H:i:s"),
      'status'=>'Belum Dikerjakan'
    );
    $this->db->insert('history',$data_history);
  }
//** END OF KOMPLAIN */

//** SEDANG DIKERJAKAN */
  public function kerjakan_komplain($id_activity){
    $data_ambil_komplain=array(
      'nama_teknisi'=>$this->session->userdata('nama'),
      'status'=>'Sedang Dikerjakan'
    );
    $this->db->where('id_activity',$id_activity);
    $this->db->update('activity',$data_ambil_komplain );
    $this->kerjakan_history($id_activity);
  }
  
  public function kerjakan_history($id_activity){
    $data_history=array(
      'id_activity'=>$id_activity,
      'waktu'=>date("Y-m-d H:i:s"),
      'status'=>'Sedang Dikerjakan'
    );
    $this->db->insert('history',$data_history);
  }
 //** END OF KERJAKAN */ 

//** SELESAI DIKERJAKAN */
  public function selesai_komplain($id_activity){
      $data_selesai_komplain=array(
        'tgl_selesai'=>date("Y-m-d H:i:s"),
        'keterangan'=>$this->input->post('keterangan'),
        'status'=>'Selesai Dikerjakan'
      );
      $this->db->where('id_activity',$id_activity);
      $this->db->update('activity',$data_selesai_komplain );
      $this->selesai_history($id_activity);
  }
  public function selesai_history($id_activity){
    $data_history=array(
      'id_activity'=>$id_activity,
      'waktu'=>date("Y-m-d H:i:s"),
      'status'=>'Selesai Dikerjakan'
    );
    $this->db->insert('history',$data_history);
  }

//** END OF SELESAI */
//** KONFIRMASI SELESAI */
  public function konfirmasi_selesai($id_activity){
    $data_konfirmasi_selesai=array(
      'status'=>'Laporan Selesai'
    );
    $this->db->where('id_activity',$id_activity);
    $this->db->update('activity',$data_konfirmasi_selesai );
    $this->konfirmasi_history($id_activity);
  }
  public function konfirmasi_history($id_activity){
    $data_history=array(
      'id_activity'=>$id_activity,
      'waktu'=>date("Y-m-d H:i:s"),
      'status'=>'Laporan Selesai'
    );
    $this->db->insert('history',$data_history);
  }

  //** END OF KONFIRMASI */

  // Karyawan
  public function notif_komplain(){
    $session = $this->session->userdata('id_karyawan');
    $tampil = $this->db->query("SELECT * FROM activity WHERE nama_teknisi is NULL AND id_karyawan = '$session'");
    return $tampil->result();
  }
  public function kardone(){
    $session = $this->session->userdata('id_karyawan');
    $tampil = $this->db->query("SELECT * FROM activity WHERE status = 'Sedang Dikerjakan' AND id_karyawan = '$session'");
    return $tampil->result();
  }
  public function karsel(){
    $session = $this->session->userdata('id_karyawan');
    $tampil = $this->db->query("SELECT * FROM activity WHERE status = 'Selesai Dikerjakan' AND id_karyawan = '$session'");
    return $tampil->result();
  }
  // Manajer

  function things(){
    $tampil = $this->db->query('SELECT * FROM barang');  
    return $tampil->result();
  }
  function karyawan(){
    $tampil = $this->db->query('SELECT * FROM master_republika.Karyawan');  
    return $tampil->result();
  }
  function activity(){
    $tampil = $this->db->query('SELECT * FROM activity');  
    return $tampil->result();
  }
  // Teknisi
  function proses(){
    $tampil = $this->db->query('SELECT * FROM activity WHERE status = "Belum Dikerjakan"');  
    return $tampil->result();
  }
  function done(){
    $tampil = $this->db->query('SELECT * FROM activity WHERE status = "Laporan Selesai"');  
    return $tampil->result();
  }
  public function laporan_teknisi(){
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
    ->where_not_in('status', 'Laporan Selesai')
    ->order_by('tgl_activity','asc')
    ->where('nama_teknisi', $this->session->userdata('nama'))->get('Activity')->result();
  }
  public function history_teknisi(){
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
    ->order_by('tgl_activity','asc')
    ->where('status','Laporan Selesai')
    ->where('nama_teknisi', $this->session->userdata('nama'))->get('Activity')->result();
  }
  public function hitung_laporan_teknisi(){
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
    ->order_by('tgl_activity','asc')
    ->where('status', 'Sedang Dikerjakan')->get('Activity')->result();
  }
  public function notif_teknisi(){
    $session = $this->session->userdata('id_karyawan');
    $tampil = $this->db->query("SELECT * FROM activity WHERE nama_teknisi is NULL");
    return $tampil->result();
  }

  public function komplain_karyawan(){
    
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
    ->where('nama', $this->session->userdata('nama'))
    ->where_not_in('status', 'Laporan Selesai')
    ->get('Activity')->result();
  }
  public function history_karyawan(){
    return $this->db->join('Barang', 'Barang.id_barang=Activity.id_barang')
    ->join('master_republika.Karyawan', 'master_republika.Karyawan.id_karyawan=Activity.id_karyawan')
    ->where('nama', $this->session->userdata('nama'))
    ->where('status','Laporan Selesai')
    ->get('Activity')->result();
  }
  public function email_teknisi(){
    $email_teknisi = $this->db->query('SELECT email from master_republika.karyawan WHERE id_level = 2 or id_level = 3');
    return $email_teknisi->result_array();
  }
  public function ambil_email_karyawan($id_activity){
    $this->db->select('master_republika.Karyawan.email')
             ->from('master_republika.Karyawan')
             ->join('Activity', 'Activity.id_karyawan=master_republika.Karyawan.id_karyawan')
             ->where('id_activity', $id_activity);
    $query = $this->db->get();
    $data = $query->result();
    return $data[0]->email;
    echo $this->db->last_query();
  }
}