<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
	}

	public function index()
	{
		$this->load->view('template_login');
	}

	public function proses_login()
	{

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_message('required','* %s tidak boleh kosong !');
		// $this->form_validation->set_message('min_length','* %s Minimal Berisi 4 Karakter !');

		$this->form_validation->set_error_delimiters('<span style="color:red">','</span>'); 

		if ($this->form_validation->run()== FALSE) {
			$this->load->view('template_login');
		} else {
			$nip=$this->input->post('nip');
			$password=md5($this->input->post('password'));

			$cek=$this->M_login->cek_user($nip); 
			if ($cek) {
				$ceklogin = $this->M_login->cek_Login($nip,$password);
				if ($ceklogin) {
					foreach ($ceklogin as $value)

					if ($value->AKTIF == "1") {
						
						$this->session->set_userdata('nip',$value->NIP);
						$this->session->set_userdata('nm_pegawai',$value->NM_PEGAWAI);
						$this->session->set_userdata('akses',$value->AKSES);
						$this->session->set_userdata('alias',$value->ALIAS);


						if ($this->session->userdata('akses')=="1" OR
						 	$this->session->userdata('akses')=="2" OR
						 	$this->session->userdata('akses')=="3" 
						 	 ) {

							// echo "<script language='javascript'>";
							// echo "alert('Selamat Datang ".$value->NM_PEGAWAI."')";
							// echo "</script>";
							// $this->session->set_flashdata('message',array('message'=>'Selamat Datang '.$value->NM_PEGAWAI,'type'=>'success','head'=>'Login Berhasil'));
							redirect('dashboard','refresh');
							}else{
								// echo "<script language='javascript'>";
								// echo "alert('Maaf anda tidak memiliki hak akses')";
								// echo "</script>";
								$this->session->set_flashdata('message',array('message'=>'Maaf Anda Tidak Memiliki Hak Akses','type'=>'error','head'=>'Login Gagal'));
								redirect('login','refresh');
							}
								}else{
									// echo "<script language='javascript'>";
									// echo "alert('Maaf akun tidak aktif')";
									// echo "</script>";
									$this->session->set_flashdata('message',array('message'=>'Maaf Akun Anda Tidak Aktif','type'=>'error','head'=>'Login Gagal'));
									redirect('login','refresh');
								}		
									}else{
										// echo "<script language='javascript'>";
										// echo "alert('Maaf NIP atau PASSWORD anda salah')";
										// echo "</script>";
											$this->session->set_flashdata('message',array('message'=>'Maaf NIP atau Password anda salah','type'=>'error','head'=>'Login Gagal'));
											redirect('login','refresh');
									}
			}else{
				// echo "<script language='javascript'>";
				// echo "alert('Maaf NIP anda belum terdaftar')";
				// echo "</script>";
						$this->session->set_flashdata('message',array('message'=>'Maaf NIP anda belum terdaftar','type'=>'error','head'=>'Login Gagal'));
						redirect('login','refresh');
			}
			
		}
		

	}

	public function logout()
	{
		$this->session->sess_destroy();
	
		redirect('login', 'refresh');
	}


}