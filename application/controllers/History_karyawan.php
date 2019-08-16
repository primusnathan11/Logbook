<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_karyawan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_komplain','',TRUE);
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')== TRUE){
			$data['konten']="v_history_karyawan";
			$data['list']=$this->m_komplain->history_karyawan();
			$this->load->view('template', $data);
		}else{
			redirect('login/index');
		}
	
	
	}

}
?>