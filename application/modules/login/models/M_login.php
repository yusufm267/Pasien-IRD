<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class M_login extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->db=$this->load->database('default',true);
	}

	public function cek_user($nip)
	{

		$sql = "SELECT a.nip 
									FROM NKL_USER_LOGIN_NUKLIR a 
									left join NKL_DOKTER_PERIKSA_NUK b on a.nip = b.id_dokter2
									WHERE a.nip = '$nip' or lower(b.alias) = lower('$nip')";

		return $this->db->query($sql)->result_array();		
	}

	public function cek_login($nip,$password)
	{
		// $pass = md5($password);
		// $query = $this->db->query("SELECT * FROM USER_LOGIN_NUKLIR WHERE nip = '$nip' and password = '$password' ");
		$sql = "SELECT b.nip,a.id_dokter,a.nama_dokter as nm_pegawai,a.alias,b.akses,b.aktif
					FROM NKL_DOKTER_PERIKSA_NUK a
					left join NKL_USER_LOGIN_NUKLIR b on a.id_dokter2=b.nip
					left join v_pegawai c on a.id_dokter2=c.nip
					where (a.id_dokter2 = '$nip' OR lower(a.alias)=lower('$nip')) and c.password='$password' and b.aktif='1'";
		$query = $this->db->query($sql);


		/*$query = $this->db->query("select a.nip,a.nip2,a.nm_pegawai,a.password,a.real_password,b.akses,b.aktif,b.status 
									from v_pegawai a 
									left join nkl_user_login_nuklir b on a.nip=b.nip 
									where b.nip ='$nip' AND a.password='$password'");*/

		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return FALSE;
		}
		
	}

}