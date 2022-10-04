<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dashboard_ird extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dashboard_ird');

		// $session_data = @$this->session->userdata()['nip'];

		// if ($session_data) {
		// 	$this->load->model('M_dashboard');
		// } else {
		// 	$this->session->set_flashdata('message',array('message'=>'Silahkan Login Terlebih Dahulu','type'=>'error','head'=>'Akses Ditolak'));
		// 	redirect('login','refresh');
		// }
	}

	public function index()
	{
		$data['title']='Dashboard Pasien IRD';
		$data['subtitle']='Instalasi Rawat Darurat';
		$data['header']='header/header';
		$data['navbar_ird']='navbar/navbar_ird';
		// $data['sidebar']='sidebar/sidebar';
		$data['footer_ird']='footer/footer';
		$data['body']='v_dashboard_ird';

		// $data['list_data'] = $this->M_dashboard->get_data_dashboard();
		// $this->load->view('template',$data);
        $data['pasien_ird'] = $this->M_dashboard_ird->get_data();
		$this->load->view('template_ird',$data);
        // var_dump($data);
        // exit;
	}

	public function get_value()
	{
		
	}

}