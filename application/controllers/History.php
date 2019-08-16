<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_komplain');
	}
	public function index()
	{
		if($this->session->userdata('logged_in')== TRUE){
			$data['konten']="v_history";
			$data['list']=$this->m_komplain->get_history();
            $this->load->view('template', $data);
		}else{
			redirect('login/index');
		}
	}

}
?>