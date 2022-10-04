<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_data()
	{
		return $this->db->from('NKL_JENIS_HASIL_NUK')->get()->result();
	}

	public function getJenisHasilPemeriksaan($ID_JENIS)
	{
		$query="select * from NKL_JENIS_HASIL_NUK where ID_JENIS= '".$ID_JENIS."' ";
		return $this->db->query($query)->row();
	}
}