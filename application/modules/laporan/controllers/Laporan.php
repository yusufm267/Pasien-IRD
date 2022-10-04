<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_laporan');
	}

	public function index()
	{
		echo "tes";
	}

	public function cetak()
	{
		$this->load->view('laporan_dummy');
	}

	public function cetakJenisHasilPemeriksaan($ID_JENIS)
	{
		$data['data_jenis_hasil_nuklir']=$this->M_laporan->getJenisHasilPemeriksaan($ID_JENIS);

		$this->load->view('laporan_dummy', $data);
	}
}