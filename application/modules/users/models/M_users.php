<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_Users extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->db=$this->load->database('default',true);
		}

		public function insert_data()
		{
			// $this->db->insert('NKL_USER_LOGIN_NUKLIR',$data);
			$this->db->trans_start();
			$this->db->trans_strict(FALSE);

			$getDoctor = $this->M_users->get_data_by_nip($this->input->post('NIP'));

			$userLogin = [
				'NIP' => $this->input->post('NIP',true),
				'AKSES' => $this->input->post('AKSES',true),
				'AKTIF' => $this->input->post('AKTIF',true),
				'STATUS' => $this->input->post('STATUS',true)
			];

			$this->db->insert('NKL_USER_LOGIN_NUKLIR',$user);

			$last_id = $this->db->insert_id();

			$dokterNuklir = [
				'ID_DOKTER2' => $last_id,
				'ALIAS' => $this->input->post('ALIAS',true),
				'F_STAFF' => $this->input->post('F_STAFF',true),
				'NAMA_DOKTER' => $getDoctor->NM_PEGAWAI
			];

			$this->db->insert('NKL_DOKTER_PERIKSA_NUK',$dokterNuklir);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
			}

		}

		public function insert_data_user($data)
		{
			$this->db->insert('NKL_USER_LOGIN_NUKLIR',$data);
		}

		public function insert_data_dokter($data2)
		{

			$q="select seq_dokter_nuk.nextval id from dual";
			$id=$this->db->query($q)->row();

			$data2['ID_DOKTER']=$id->ID;
			$this->db->insert('NKL_DOKTER_PERIKSA_NUK',$data2);
		}

		// public function delete_data($NIP)
		// {
		// 	$this->db->where('NIP',$NIP);
		// 	$this->db->delete('USER_LOGIN_NUKLIR');
		// }

		public function delete_data($NIP)
		{	
			$this->delete_user_login_nuklir($NIP);
			$this->delete_nkl_dokter_periksa_nuk($NIP);
		}

		public function delete_user_login_nuklir($NIP)
		{
			$this->db->where('NIP',$NIP);
			$this->db->delete('NKL_USER_LOGIN_NUKLIR');
		}

		public function delete_nkl_dokter_periksa_nuk($ID_DOKTER2)
		{
			$this->db->where('ID_DOKTER2',$ID_DOKTER2);
			$this->db->delete('NKL_DOKTER_PERIKSA_NUK');
		}

		public function update_data_user($NIP,$data)
		{
			$this->db->where('NIP',$NIP);
			$this->db->update('NKL_USER_LOGIN_NUKLIR',$data);
		}

		public function update_data_dokter_periksa($NIP,$data2)
		{
			$this->db->where('ID_DOKTER2',$NIP);
			$this->db->update('NKL_DOKTER_PERIKSA_NUK',$data2);
		}

		public function get_data()
		{
			// return $this->db->from('NKL_USER_LOGIN_NUKLIR')->get()->result();
			$query="
					select a.nip,a.nip2,a.nm_pegawai,a.password,a.real_password,b.akses,b.aktif,b.status,c.alias,c.f_staff
					from v_pegawai a 
					left join nkl_user_login_nuklir b on a.nip=b.nip
					left join NKL_DOKTER_PERIKSA_NUK c on c.ID_DOKTER2=a.nip 
					where b.nip is not null
					";
			return $this->db->query($query)->result();
		}

		public function get_data_by_nip($nip)
		{
			$query="
					select * from v_pegawai where NIP = '" .$nip. "'
					";
			return $this->db->query($query)->row();
		}

		public function get_data_update($NIP)
		{
			$query="
					select a.nip,a.nip2,a.nm_pegawai,a.password,a.real_password,b.akses,b.aktif,b.status,c.alias,c.f_staff
					from v_pegawai a 
					left join nkl_user_login_nuklir b on a.nip=b.nip
					left join NKL_DOKTER_PERIKSA_NUK c on c.ID_DOKTER2=a.nip
					where a.nip='".$NIP."'
					";
			return $this->db->query($query)->row();
		}

		public function get_data_users()
		{
			return $this->db->from('NKL_USER_LOGIN_NUKLIR')->get()->result();
		}

		public function get_aktif()
		{
			$this->db->distinct();
			$this->db->select('AKTIF');
			return $this->db->from('NKL_USER_LOGIN_NUKLIR')->get()->result();	
		}

		public function get_akses()
		{
			$this->db->distinct();
			$this->db->select('AKSES');
			return $this->db->from('NKL_USER_LOGIN_NUKLIR')->get()->result();	
		}

		public function get_staff()
		{
			$this->db->distinct();
			$this->db->select('F_STAFF');
			return $this->db->from('NKL_DOKTER_PERIKSA_NUK')->get()->result();
		}

		public function get_data_profile($NIP)
		{
			$query="
					select a.nip,a.nip2,a.nm_pegawai,a.password,a.real_password,b.akses,b.aktif,b.status,c.alias,c.f_staff
					from v_pegawai a 
					left join nkl_user_login_nuklir b on a.nip=b.nip
					left join NKL_DOKTER_PERIKSA_NUK c on c.ID_DOKTER2=a.nip
					where a.nip='".$NIP."'
					";
			return $this->db->query($query)->row();
		}

	}

	