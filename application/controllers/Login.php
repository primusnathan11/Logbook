<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login'); 
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){

			redirect('dashboard/index');

		} else {
			$this->load->view('login');
		}
	}
	public function cek_login(){
		if($this->session->userdata('logged_in') == FALSE){

			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('password', 'password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->M_login->cek_user() == TRUE){
					redirect('dashboard/index');
				} else {
					$this->session->set_flashdata('notif', 'Email atau password anda salah');
					redirect('login/index');
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
					redirect('login/index');
			}

		} else {
			redirect('dashboard/index');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}
