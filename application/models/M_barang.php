<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

    public function getTable(){
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result();
    }
    public function getKategori(){
        $this->db->select('kategori_barang');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result();
    }
    public function simpan_barang($data, $table){
        $this->db->insert($table, $data);
    }
    public function masuk_db(){
        $data_barang=array(
            'nama_barang'=>$this->input->post('nama_barang'),
            'kategori_barang'=>$this->input->post('kategori_barang')
            );
        $masuk=$this->db->insert('Barang', $data_barang);
        return $masuk;
    }
    public function detail_barang($id_barang=''){
        return $this->db->where('id_barang', $id_barang)->get('barang')->row();
    }
    public function update_barang(){
        $dt_up_barang=array(
            'id_barang'=>$this->input->post('id_barang'),
            'nama_barang'=>$this->input->post('nama_barang'),
            'kategori_barang'=>$this->input->post('kategori_barang')
            #'nama di database'=>$thus->input->post('nama di inputan');
        );
        return $this->db->where('id_barang', $this->input->post('id_barang'))->update('barang', $dt_up_barang);
    }
	public function delete_barang($id_barang){
        $this->db->where('id_barang', $id_barang);
        return $this->db->delete('barang');
    }
}