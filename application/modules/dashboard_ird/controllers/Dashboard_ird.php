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
		// $data['title']='Kelola Nuklir';
		// $data['subtitle']='dashboard';
		// $data['header']='header/header';
		// $data['navbar']='navbar/navbar';
		// $data['sidebar']='sidebar/sidebar';
		// $data['footer']='footer/footer';
		// $data['body']='v_dashboard';

		// $data['list_data'] = $this->M_dashboard->get_data_dashboard();
		// $this->load->view('template',$data);
        $data['pasien_ird'] = $this->M_dashboard_ird->get_data();
        var_dump($data);
        exit;
	}

	public function get_value()
	{
		
	}

}