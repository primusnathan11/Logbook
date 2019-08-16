<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('M_barang');
		$this->load->library('form_validation');
	}
    public function index(){
        if($this->session->userdata('logged_in')== TRUE){
            $data['konten']= 'v_barang';
            $data['barang']= $this->M_barang->getTable();
            $this->load->view('template',$data);
        } else {
            redirect('login/index');
        }
    }	
    public function simpan_barang(){
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', array('required' => 'Nama Barang belum terisi'));
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'trim|required', array('required' => 'Kategori Barang belum dipilih'));
        if($this->form_validation->run()==TRUE){
            $this->load->model('M_barang');
            $masuk=$this->M_barang->masuk_db();
            if($masuk==TRUE){
                $this->session->set_flashdata('pesan', 'Tambah data barang berhasil');
            } else {
                $this->session->set_flashdata('pesan', 'Tambah data barang gagal');            
            } 
            redirect(base_url('index.php/Barang'), 'refresh');
        }   else {
            $this->session->set_flashdata('pesan', validation_errors());
            redirect(base_url('index.php/Barang'), 'refresh');
        }    
    } 
    public function get_detail_barang($id_barang=''){
        $this->load->model('M_barang');
        $data_detail=$this->M_barang->detail_barang($id_barang);
        echo json_encode($data_detail);
    }
    public function update_barang(){
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
        $this->form_validation->set_rules('kategori_barang', 'Kategori Barang', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('pesan', validation_errors());
             redirect(base_url('index.php/Barang'),'refresh');
         }
         else{
             $this->load->model('M_barang');
             $proses_update=$this->M_barang->update_barang();
             if($proses_update){
                $this->session->set_flashdata('pesan', 'Update data barang berhasil');
             }
             else{
                 $this->session->set_flashdata('pesan', 'Update data barang gagal');
             }
             redirect(base_url('index.php/Barang'), 'refresh');
         }
    }
    public function delete_barang($id_barang){
        $this->load->model('M_barang');
        $proses_delete= $this->M_barang->delete_barang($id_barang);
        if($proses_delete){
            $this->session->set_flashdata('pesan', 'Hapus data barang berhasil');
        } else{
            $this->session->set_flashdata('pesan', 'Hapus data barang gagal');
        }
        redirect(base_url('index.php/Barang'), 'refresh');

    }
}
