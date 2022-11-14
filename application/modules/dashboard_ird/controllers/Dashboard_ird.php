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
		$day = $this->input->get('day') ?: date('d');
		$month = $this->input->get('month') ?: date('m');
		$year = $this->input->get('year') ?: date('Y');
		$data['title']='Reporting Pasien IRD';
		$data['subtitle']='Instalasi Rawat Darurat';
		$data['header']='header/header';
		$data['navbar_ird']='navbar/navbar_ird';
		// $data['sidebar']='sidebar/sidebar';
		$data['footer_ird']='footer/footer';
		$data['body']='v_dashboard_ird';

		// $data['list_data'] = $this->M_dashboard->get_data_dashboard();
		// $this->load->view('template',$data);
		
		$data['tahun_tanggal_kunjungan'] = $this->M_dashboard_ird->get_tahun();
		$data['bulan_tanggal_kunjungan'] = $this->M_dashboard_ird->get_bulan();
		$data['day'] = $day;
		$data['month'] = $month;
		$data['year'] = $year;
        $data['pasien_ird'] = $this->M_dashboard_ird->get_data($month, $year);
		$data['status_durasi'] = $this->M_dashboard_ird->get_count_durasi($month,$year);
		$this->load->view('template_ird',$data);
        // var_dump($data);
        // exit;
	}

	public function get_tahun(){
		$data['tahun_tanggal_kunjungan'] = $this->M_dashboard_ird->get_tahun();
	}

	public function get_status_durasi(){
		$day = $this->input->get('day') ?: date('d');
		$month = $this->input->get('month') ?: date('m');
		$year = $this->input->get('year') ?: date('Y');

		// $data['day'] = $day;
		// $data['month'] = $month;
		// $data['year'] = $year;

		$data['status_durasi'] = $this->M_dashboard_ird->get_count_durasi($month,$year);
		// $this->load->view($data);
		// var_dump($data);
		// exit;
	}

}