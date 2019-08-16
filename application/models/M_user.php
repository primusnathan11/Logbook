<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    public function __construct()
	{
		$this->db2 = $this->load->database('db2', TRUE);
	}
    public function getTable(){
        $this->db->select('*');
        $this->db->from('master_republika.karyawan');
        $this->db->join('master_republika.level', 'master_republika.level.id_level = master_republika.karyawan.id_level');
        $query = $this->db->get();
        return $query->result();
    }
    public function getLevel(){
        $this->db->select('*');
        $this->db->from('master_republika.level');
        $query = $this->db->get();
        return $query->result();
    }
    public function simpan_user($data, $table){
        $this->db->insert($table, $data);
    }
    public function masuk_db(){
        $scrt = "P3djaten";
        $data_karyawan=array(
            'nama'=>$this->input->post('nama'),
            'email'=>$this->input->post('email'),
            'password'=>sha1($this->input->post('password').$scrt),
            'id_level'=>$this->input->post('nama_level'),
            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
            'no_telepon'=>$this->input->post('no_telepon')
        );
        $masuk=$this->db->insert('master_republika.Karyawan', $data_karyawan);
        return $masuk;
    }
    public function detail_user($id_karyawan=''){
        return $this->db->where('id_karyawan', $id_karyawan)->get('master_republika.karyawan')->row();
    }
    public function update_user(){
        $scrt = "P3djaten";
        $dt_up_user=array(
            'id_karyawan'=>$this->input->post('id_karyawan'),
            'nama'=>$this->input->post('nama'),
            'email'=>$this->input->post('email'),
            'password'=>sha1($this->input->post('password').$scrt),
            'id_level'=>$this->input->post('nama_level'),
            'no_telepon'=>$this->input->post('no_telepon')
        );
        return $this->db->where('id_karyawan', $this->input->post('id_karyawan'))->update('master_republika.karyawan', $dt_up_user);
    }
	public function delete_user($id_karyawan){
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->delete('master_republika.karyawan');
    }
}