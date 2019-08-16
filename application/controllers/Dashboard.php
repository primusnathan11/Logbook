<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_komplain');
	}
	public function index()
	{
		if($this->session->userdata('logged_in')== TRUE){
			$data['konten']="v_dashboard";
			$data['komplain']=count($this->m_komplain->notif_komplain());
			$data['proses']=count($this->m_komplain->proses());
			$data['done']=count($this->m_komplain->done());
			$data['things']=count($this->m_komplain->things());
			$data['karyawan']=count($this->m_komplain->karyawan());
			$data['activity']=count($this->m_komplain->activity());
			$data['task']=count($this->m_komplain->hitung_laporan_teknisi());
			$data['kardone']=count($this->m_komplain->kardone());
			$data['karsel']=count($this->m_komplain->karsel());
			$data['notif']=count($this->m_komplain->notif_teknisi());

			$this->load->view('template', $data);
		}else{
			redirect('login/index');
		}
			
			
	
	
	}

}
?>