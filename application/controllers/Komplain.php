<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komplain extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_komplain','',TRUE);
		$this->load->library('form_validation');
		$this->load->helper('date');
		error_reporting('E_ALL');
		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data['nama_barang'] = $this->m_komplain->detail_kategori();
		$data['kategori_barang'] = $this->m_komplain->dropdown_kategori_barang();
		$data['konten']="v_komplain";
		$data['dropdown']= $this->m_komplain->dropdown_karyawan();
		$this->load->view('template', $data);
	}
	public function get_detail_kategori($kategori_barang=''){
		$this->load->model('M_Komplain');
		$data_detail =$this->m_komplain->detail_kategori($kategori_barang);
		echo json_encode($data_detail);
	}
	public function simpan_komplain()
		{
		$this->form_validation->set_rules('kategori_barang', 'kategori barang', 'trim|required',
		array('required' => 'kategori harus diisi'));
		$this->form_validation->set_rules('detail', 'Detail', 'trim|required',
		array('required' => 'detail harus diisi'));
		
		if ($this->form_validation->run() == TRUE )
		{
			$this->load->model('M_Komplain');
			$masuk=$this->M_Komplain->masuk_db();
			
			$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_user' => '',    
				'smtp_pass' => '',      
				'smtp_port' => 465,
				'crlf'      => "\r\n",
				'newline'   => "\r\n"
			];
		$dataMail=((array)$masuk);
		$mesg = $this->load->view('v_email', $dataMail, true);
		$this->load->library('email', $config);
		$this->email->from('noreply@tes.com', 'Republika');
		$this->email->to('');
		$ambil_email = $this->m_komplain->email_teknisi();
		//  $this->email->to('helpdesk@rol.republika.co.id');
		$ccbanyak = array();
		foreach($ambil_email as $value){
			// print_r ($value); echo "asdf";
			array_push($ccbanyak,$value['email']);
		}
		$this->email->cc($ccbanyak);
		$this->email->subject('Anda mendapatkan laporan baru');
		$this->email->message($mesg);
		$this->email->send();
			if($this->session->userdata('nama_level') =='Manajer IT'){
			redirect(base_url('index.php/Laporan'), 'refresh');
			}
				else{
				redirect(base_url('index.php/Laporan_karyawan'));
			}
		}
		else{
			echo validation_errors(); 	
			$this->session->set_flashdata('pesan', validation_errors());
			redirect(base_url('index.php/Laporan'), 'refresh');
		}
		
	}
	public function kerjakan_komplain($id_activity)
		{
		$this->load->model('M_Komplain');
		$ambil=$this->m_komplain->kerjakan_komplain($id_activity);
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => '',    
			'smtp_pass' => '',      
			'smtp_port' => 465,
			'crlf'      => "\r\n",
			'newline'   => "\r\n"
		];
		$mesg = $this->load->view('v_emailkerjakan','',true);
		$this->load->library('email', $config);
		$this->email->from('', 'Republika');
		$email_selesai=$this->m_komplain->ambil_email_karyawan($id_activity);
		$this->email->to($email_selesai);
		$this->email->attach('');
		$this->email->subject('Teknisi sedang mengerjakan keluhan anda');
		$this->email->message($mesg);
		$this->email->send();
		redirect(base_url('index.php/Laporan_teknisi'),'refresh');
	}
	public function selesai_komplain($id_activity)
		{
		$this->load->model('M_Komplain');
		$ambil=$this->m_komplain->selesai_komplain($id_activity);
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => '',    
			'smtp_pass' => '',      
			'smtp_port' => 465,
			'crlf'      => "\r\n",
			'newline'   => "\r\n"
		];

		$mesg = $this->load->view('v_emailselesai','',true);
		$this->load->library('email', $config);
		$this->email->from('', 'Republika');
		$email_selesai=$this->m_komplain->ambil_email_karyawan($id_activity);
		$this->email->to($email_selesai);
		$this->email->attach('');
		$this->email->subject('Laporan kerusakan anda telah diselesaikan');
		$this->email->message($mesg);
		$this->email->send();
		redirect(base_url('index.php/Laporan_teknisi'),'refresh');
	}
	public function konfirmasi_selesai($id_activity)
	{
		$this->load->model('M_Komplain');
		$ambil=$this->m_komplain->konfirmasi_selesai($id_activity);
		redirect(base_url('index.php/History_karyawan'),'refresh');
	}
	public function daterange()
	{
		$this->load->model('M_Komplain');
		$ambil=$this->m_komplain->cari_tanggal();
		redirect(base_url('index.php/Laporan'));
	}
}
