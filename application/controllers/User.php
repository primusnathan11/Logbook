<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->library('form_validation');
	}
	public function index(){
        if($this->session->userdata('logged_in')== TRUE){
            $data['konten']="v_user";
			$data['user'] = $this->M_user->getTable();
			$data['level'] = $this->M_user->getLevel();
			#$data_detail['update'] = $this->M_user->detail_user();
            #$data['user'] = $this->M_user->();
			$this->load->view('template', $data);
		}else{
			redirect('login/index');
		}
    }
    public function getUser(){
        $data['konten'] = 'v_user';
        $data['user'] = $this->M_user->getTable();
        $this->load->view('template', $data);
    }
    function simpan_user() {
	    $this->form_validation->set_rules('nama', 'Nama User', 'trim|required',
        array('required' => 'Nama User belum terisi!'));
    	$this->form_validation->set_rules('email', 'Alamat Email', 'trim|required',
	    array('required' => 'Alamat Email belum terisi!'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required',
		array('required' => 'Password harus diisi'));
		$this->form_validation->set_rules('nama_level', 'Jabatan', 'trim|required',
        array('required' => 'Jabatan belum terisi!'));
        
    	if ($this->form_validation->run() == TRUE ) {
			$this->load->model('M_user', 'dt');
	    	$masuk=$this->dt->masuk_db();
				if($masuk==true){
		    		$this->session->set_flashdata('pesan', 'Tambah data berhasil');
    				} else{
		    		$this->session->set_flashdata('gagal', 'Tambah data gagal');
				}
		    redirect(base_url('index.php/User'), 'refresh');
		} else{
		    $this->session->set_flashdata('pesan', validation_errors());
		    redirect(base_url('index.php/User'), 'refresh');
	    }
	}
	public function get_detail_user($id_karyawan='')
	{
		$this->load->model('M_user');
		$data_detail=$this->M_user->detail_user($id_karyawan);
		echo json_encode($data_detail);
	}
	public function update_user(){
		$this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
		$this->form_validation->set_rules('email', 'Alamat Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama_level', 'nama_level', 'trim|required');
		$this->form_validation->set_rules('no_telepon', 'no_telepon', 'trim|required');
		if($this->form_validation->run() == FALSE){
		   $this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/User'),'refresh');
		}
		else{
			$this->load->model('M_user');
			$proses_update=$this->M_user->update_user();
			if($proses_update){
			   $this->session->set_flashdata('pesan', 'Update user berhasil');
			}
			else{
				$this->session->set_flashdata('pesan', 'Update user gagal');
			}
			redirect(base_url('index.php/User'), 'refresh');
		}
	}


    public function delete_user($id_karyawan){
            $this->load->model('M_user');
			$hapus = $this->M_user->delete_user($id_karyawan);
			if(($hapus)==TRUE){
				$this->session->set_flashdata('pesan', 'Hapus data user berhasil');
			} else{
				$this->session->set_flashdata('gagal', 'Hapus data user gagal');
			}
            redirect(base_url('index.php/User'), 'refresh');
    }	
}
