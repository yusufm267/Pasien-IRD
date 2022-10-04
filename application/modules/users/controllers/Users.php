<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users');

		$session_data = @$this->session->userdata()['nip'];

		if ($session_data) {
			$this->load->model('M_users');
		} else {
			$this->session->set_flashdata('message',array('message'=>'Silahkan Login terlebih Dahulu','type'=>'error','head'=>'Akses Ditolak'));
			redirect('login','refresh');
		}
	}

	public function index()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA USERS NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_users';

		$data['data_users_nuklir'] = $this->M_users->get_data();
		// $data['user_login'] = $this->session->userdata();
		// var_dump($data['data_users_nuklir']);
		// die;
		$this->load->view('template',$data);
	}

	public function view_insert()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='TAMBAH DATA USERS NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_insert';

		$this->load->view('template',$data);
	}

	public function insert_user()
	{

		$this->form_validation->set_rules('NIP' , 'NIP' , 'required|is_unique[NKL_USER_LOGIN_NUKLIR.NIP]');
		// $this->form_validation->set_rules('NIP' , 'NIP' , 'required|is_unique[NKL_DOKTER_PERIKSA_NUK.ID_DOKTER2]'); 
		$this->form_validation->set_rules('ALIAS' , 'Nama Alias' , 'required|is_unique[NKL_DOKTER_PERIKSA_NUK.ALIAS]');

		$this->form_validation->set_message('is_unique', '* %s tidak boleh sama atau data sudah terdaftar');
		$this->form_validation->set_message('required', '* %s tidak boleh kosong');

		$this->form_validation->set_error_delimiters('<div style="color:red">','</div>');
		// $this->form_validation->set_error_delimiters('<div class="error">','</div>');

		if ($this->form_validation->run() == FALSE) {
			$data['title']='Kelola Nuklir';
			$data['subtitle']='TAMBAH DATA USERS NUKLIR';
			$data['header']='header/header';
			$data['navbar']='navbar/navbar';
			$data['sidebar']='sidebar/sidebar';
			$data['footer']='footer/footer';
			$data['body']='v_insert';
			$this->load->view('template',$data); 
		} else {

			$getDoctor = $this->M_users->get_data_by_nip($this->input->post('NIP'));
				
			$dataPost = $this->input->post();
			$data = [
				'NIP' => $dataPost['NIP'],
				'AKSES' => $dataPost['AKSES'],
				'AKTIF' => $dataPost['AKTIF'],
				'STATUS' => $dataPost['STATUS'],
			];

			// $NIP=$this->input->post('NIP');
			// $AKSES=$this->input->post('AKSES');
			// $AKTIF=$this->input->post('AKTIF');
			// $STATUS=$this->input->post('STATUS');

			// $data = array(
			// 	'NIP' => $NIP,
			// 	'AKSES' => $AKSES,
			// 	'AKTIF' => $AKTIF,
			// 	'STATUS' => $STATUS
			// );

			$ID_DOKTER2=$this->input->post('NIP');
			$ALIAS=$this->input->post('ALIAS');
			$STAF=$this->input->post('STAF');

			$data2 = array(
				'ALIAS' => $ALIAS,
				'F_STAFF' => $STAF,
				'ID_DOKTER2' => $ID_DOKTER2,
				'NAMA_DOKTER' => $getDoctor->NM_PEGAWAI
			);


			$this->M_users->insert_data_user($data,'NKL_USER_LOGIN_NUKLIR');
			$this->M_users->insert_data_dokter($data2,'NKL_DOKTER_PERIKSA_NUK');
			$this->session->set_flashdata('message',array('message'=>'Data Berhasil Disimpan','type'=>'success','head'=>'Success'));
			// var_dump($data,$data2);
			// exit;
			redirect('users','refresh');
		}
	}



	public function view_update($NIP)
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA USERS NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_update';

		$data['data_users_nuklir'] = $this->M_users->get_data_update($NIP);
		$data['users_nuklir_akses'] = $this->M_users->get_akses();
		$data['users_nuklir_aktif'] = $this->M_users->get_aktif();
		$data['users_nuklir_staff'] = $this->M_users->get_staff();
		// var_dump($data['users_nuklir']);
		// exit;
		$this->load->view('template',$data);
	}

	public function update($NIP)
	{
		$AKSES=$this->input->post('AKSES');
		$AKTIF=$this->input->post('AKTIF');
		$STATUS=$this->input->post('STATUS');

		$data = array(
			'AKSES' => $AKSES,
			'STATUS' => $STATUS,
			'AKTIF' => $AKTIF
		);

		$STAFF = $this->input->post('F_STAFF');

		$data2 = array(
			'F_STAFF' => $STAFF
		);

		$this->M_users->update_data_user($NIP,$data);
		$this->M_users->update_data_dokter_periksa($NIP,$data2);
		$this->session->set_flashdata('message',array('message'=>'Data Berhasil Diperbaharui','type'=>'success','head'=>'Success'));
		// var_dump($data);
		// exit();
		redirect('users','refresh');
	}

	public function delete($NIP)
	{
		$this->M_users->delete_data($NIP);
		$this->session->set_flashdata('message',array('message'=>'Data Berhasil Dihapus','type'=>'success','head'=>'Success'));
		redirect('users','refresh');
	}

	public function profile($NIP)
	{

		$data['title']='Kelola Nuklir';
		$data['subtitle']='PROFILE';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_user_profile';

		$data['data_profile'] = $this->M_users->get_data_profile($NIP);
		// var_dump($data);
		// exit;


		$this->load->view('template', $data);
	}
	
	// public function insert()
	// {
	// 	$this->form_validation->set_rules('NIP' , 'NIP' , 'required|is_unique[NKL_USER_LOGIN_NUKLIR.NIP]');

	// 	$this->form_validation->set_message('is_unique', '* %s tidak boleh sama atau NIP sudah terdaftar');


	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data['title']='Kelola Nuklir';
	// 		$data['subtitle']='TAMBAH DATA USERS NUKLIR';
	// 		$data['header']='header/header';
	// 		$data['navbar']='navbar/navbar';
	// 		$data['sidebar']='sidebar/sidebar';
	// 		$data['footer']='footer/footer';
	// 		$data['body']='v_insert';
	// 		$this->load->view('template',$data); 
	// 	} else {
			
	// 	$NIP=$this->input->post('NIP');
	// 	$AKSES=$this->input->post('AKSES');
	// 	$AKTIF=$this->input->post('AKTIF');
	// 	$STATUS=$this->input->post('STATUS');

	// 	$data = array(
	// 		'NIP' => $NIP,
	// 		'AKSES' => $AKSES,
	// 		'AKTIF'=> $AKTIF,
	// 		'STATUS'=>$STATUS 
	// 	);

	// 	// var_dump($data);
	// 	// exit;
	// 	$this->M_users->insert_data($data,'NKL_USER_LOGIN_NUKLIR');
	// 	// $this->session->set_flashdata('message',array('message'=>'Data Berhasil Disimpan','type'=>'success','head'=>'Success'));
	// 	redirect('users','refresh');
	// 	}
	// }


}