<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Hasil_nuklir extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_hasil_nuklir');

		// $session_data= @$this->session->userdata()['nip'];

		// if ($session_data) {
		// 	$this->load->model('M_hasil_nuklir');
		// } else {
		// 	$this->session->set_flashdata('message',array('message'=>'Silahkan Login Terlebih Dahulu','type'=>'error','head'=>'Akses Ditolak'));
		// 	redirect('login','refresh');
		// }
	}

	public function index()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA HASIL NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_hasil_nuklir';

		$data['data_hasil_nuklir'] = $this->M_hasil_nuklir->get_data();
		// var_dump($data);
		// exit();
		$this->load->view('template',$data);
	}


	public function view_insert_hasil_nuklir()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='INPUT HASIL NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_insert_hasil_nuklir';

		$this->load->view('template', $data);
	}

	public function view_insert()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA Hasil Nuklir';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_insert';

		$this->load->view('template',$data);
	}

	public function insert()
	{
		$NM_HASIL = $this->input->post('NM_HASIL');
		$KADAR = $this->input->post('KADAR_NORMAL');
		$SATUAN = $this->input->post('SATUAN');
		$ID_JNS_P = $this->input->post('ID_JNS_PEMERIKSAAN');

		$data = array(
			'NM_HASIL' => $NM_HASIL,
			'KADAR_NORMAL' => $KADAR,
			'SATUAN' => $SATUAN,
			'ID_JNS_PEMERIKSAAN' => $ID_JNS_P
		);

		// var_dump($data);
		// exit;

		// $this->M_hasil_nuklir->insert_data($data);

		$insert = $this->M_hasil_nuklir->insert_data('NKL_JENIS_HASIL_NUK',$data);
		$data = $insert ? ['message'=>'Data Berhasil Disimpan','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Disimpan','type'=>'error','head'=>'error'];
		$this->session->set_flashdata('message',$data);
		redirect('hasil_nuklir','refresh');
		// $this->M_hasil_nuklir->insert_data('NKL_JENIS_HASIL_NUK',$data);
		// $this->session->set_flashdata('message',array('message'=>'Data Berhasil Disimpan','type'=>'success','head'=>'Success'));
		// redirect('hasil_nuklir','refresh');
	}

	public function view_update($ID_JENIS)
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='Update Data Nuklir';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_update';

		$data['data_hasil_jenis_nuklir'] = $this->M_hasil_nuklir->get_data_update($ID_JENIS);
		
		$this->load->view('template',$data);
	}

	public function update($ID_JENIS)
	{
		$NM_HASIL = $this->input->post('NM_HASIL');
		$KADAR = $this->input->post('KADAR_NORMAL');
		$SATUAN = $this->input->post('SATUAN');
		$ID_JNS_P = $this->input->post('ID_JNS_PEMERIKSAAN');
		// $ID_JENIS = $this->input->post('ID_JENIS');

		$data = array(
			'NM_HASIL' => $NM_HASIL,
			'KADAR_NORMAL' => $KADAR,
			'SATUAN' => $SATUAN,
			'ID_JNS_PEMERIKSAAN' => $ID_JNS_P
			// 'ID_JENIS' => $ID_JENIS
		);

		// $this->M_hasil_nuklir->update_data($ID_JENIS,$data);
		// $this->session->set_flashdata('message',array('message'=>'Data Berhasil Diperbaharui','type'=>'success','head'=>'Success'));
		// redirect('hasil_nuklir','refresh');
 
		$update = $this->M_hasil_nuklir->update_data($ID_JENIS,$data);
		$data = $update ? ['message'=>'Data Berhasil Diperbaharui','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Diperbaharui','type'=>'error','head'=>'error'];
		$this->session->set_flashdata('message',$data);
		// var_dump($data);
		// exit;
		redirect('hasil_nuklir','refresh');
	}

	public function delete($ID_JENIS)
	{
		// var_dump($this->M_hasil_nuklir->delete_data($ID_JENIS));
		// exit;
		// if ($this->M_hasil_nuklir->delete_data($ID_JENIS)) {
		// 	$this->session->set_flashdata('message',array('message'=>'Data Berhasil Dihapus','type'=>'success','head'=>'Success'));
		// 	redirect('hasil_nuklir','refresh');
		// } else {
		// 	$this->session->set_flashdata('message',array('message'=>'Data Gagal Dihapus','type'=>'error','head'=>'error'));
		// 	redirect('hasil_nuklir','refresh');
		// }

		$delete = $this->M_hasil_nuklir->delete_data($ID_JENIS);
		$data = $delete ? ['message'=>'Data Berhasil Dihapus','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Dihapus','type'=>'error','head'=>'error'];
		$this->session->set_flashdata('message',$data);
		redirect('hasil_nuklir','refresh');
		
		// $this->M_hasil_nuklir->delete_data($ID_JENIS);
		// $this->session->set_flashdata('message',array('message'=>'Data Berhasil Dihapus','type'=>'success','head'=>'Success'));
		// redirect('hasil_nuklir','refresh');
	}

	public function getMedrecAutoComplete()
	{
		$keyword=$this->input->post('keyword');
		$data=$this->M_hasil_nuklir->getMedrecAutoComplete($keyword);
		array_push($data,(object)array(
			"NO_MEDREC"=>'MEDREC',
			"NAMA"=>'NAMA',
			"UMUR"=>'UMUR',
			"TGL_LAHIR"=>'LAHIR'
		));
		echo json_encode($data);
	}

	public function getDokterPeriksaAutoComplete()
	{
		$keyword=$this->input->post('keyword');
		$data=$this->M_hasil_nuklir->getDokterPeriksaAutoComplete($keyword);
		array_push($data,(object)array(
			"ID_DOKTER"=>'ID DOKTER',
			"NM_DOKTER"=>'NAMA DOKTER'
		));
		echo json_encode($data);
	}

	public function getNamaHasilAutoComplete()
	{
		$keyword=$this->input->post('keyword');
		$data=$this->M_hasil_nuklir->search_hasil($keyword);
		array_push($data,(object)array(
			"ID_JENIS"=>'ID JENIS',
			"NM_HASIL"=>'NAMA HASIL',
			"KADAR_NORMAL" => "KADAR NORMAL"
		));
		echo json_encode($data);
	}

	public function getJenisRfAutoComplete()
	{
		$keyword=$this->input->post('keyword');
		$data=$this->M_hasil_nuklir->getJenisRfAutoComplete($keyword);
		array_push($data,(object)array(
			"JENIS_RF"=>'JENIS RF'
		));
		echo json_encode($data);
	}

	public function getHasilPemeriksaan()
	{
		$medrec = $this->input->get('medrec');
		$nama = $this->input->get('nama');
		$tanggal = $this->input->get('tanggal');
		$namaHasils = $this->M_hasil_nuklir->get_data();

		$hasil = [];

		if (strlen($medrec)==10) { // Rawat Jalan
			$hasil = $this->M_hasil_nuklir->getHasilNuklirIRJ($tanggal, $medrec);
			$this->load->view('v_hasil_pemeriksaan',['hasil' => $hasil, 'namaHasils' => $namaHasils]);
			return;

		}else if (strlen($medrec)==8) { //Rawat Inap
			$hasil = $this->M_hasil_nuklir->getHasilNuklirIRI($tanggal, $medrec);

			$this->load->view('v_hasil_pemeriksaan', ['hasil' => $hasil, 'namaHasils' => $namaHasils]);
			return;
		}
	}

	public function pemeriksaan_nuklir()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA PEMERIKSAAN KEDOKTERAN NUKLIR';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_pemeriksaan_nuklir';

		$data['data_pemeriksaan_nuklir'] = $this->M_hasil_nuklir->getPemeriksaanNuklir();
		// var_dump($data);
		// exit;

		$this->load->view('template', $data);
	}

	public function jenis_rf()
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA MASTER JENIS RADIOFARMA';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_jenis_rf';

		$data['data_jenis_rf'] = $this->M_hasil_nuklir->getDataJenisRF();

		$this->load->view('template',$data);
	}

	public function view_update_jenis_rf($JENIS_RF)
	{
		$data['title']='Kelola Nuklir';
		$data['subtitle']='DATA DETAIL JENIS RADIOFARMA';
		$data['header']='header/header';
		$data['navbar']='navbar/navbar';
		$data['sidebar']='sidebar/sidebar';
		$data['footer']='footer/footer';
		$data['body']='v_update_jenis_rf';

		$data['data_jenis_rf'] = $this->M_hasil_nuklir->getDataDetailJenisRF($JENIS_RF);

		$this->load->view('template',$data);
	}

	public function insert_jenis_rf()
	{
		$JENIS_RF = $this->input->post('JENIS_RF');

		$data = array(
			'JENIS_RF' => $JENIS_RF
		);

		$insert = $this->M_hasil_nuklir->insertJenisRF('NKL_JENIS_RF_NUK',$data);
		$data = $insert ? ['message'=>'Data Berhasil Disimpan','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Disimpan','type'=>'error','head'=>'Failed'];
		$this->session->set_flashdata('message',$data);
		redirect('hasil_nuklir/jenis_rf','refresh');
	}

	public function delete_jenis_rf($JENIS_RF)
	{
		$delete = $this->M_hasil_nuklir->deleteJenisRF($JENIS_RF);
		$data = $delete ? ['message'=>'Data Berhasil Dihapus','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Dihapus','type'=>'error','head'=>'Failed'];
		$this->session->set_flashdata('message',$data);
		// var_dump($data);
		// exit;
		redirect('hasil_nuklir/jenis_rf','refresh');
	}

	public function insert_pemeriksaan_nuklir()
	{
		$NM_HASIL = $this->input->post('nm_hasil');
		$KADAR_HASIL = $this->input->post('kadar_hasil');
		$KADAR_NORMAL = $this->input->post('kadar_normal');
		$JENIS_RF = $this->input->post('jenis_rf');
		$DOSIS_RF = $this->input->post('dosis_rf');

		$data = array(
			'NM_HASIL' => $NM_HASIL,
			'KADAR_HASIL' => $KADAR_HASIL,
			'KADAR_NORMAL' => $KADAR_NORMAL,
			'JENIS_RF' => $JENIS_RF,
			'DOSIS_RF' => $DOSIS_RF
		);

		$insert = $this->M_hasil_nuklir->insertPemeriksaanNuklir($data);
		$data = $insert ? ['message' => 'Data Berhasil Disimpan','type'=>'success','head'=>'Success'] : ['message'=>'Data Gagal Disimpan','type'=>'error','head'=>'error'];
		$this->session->set_flashdata('message',$data);
		redirect('hasil_nuklir','refresh'); 
	}

	public function cetakHasilPemeriksaan($NO_MEDREC)
	{
		$data['data_hasil_pemeriksaan']=$this->M_hasil_nuklir->getDetailHasilPemeriksaan($NO_MEDREC);
		// var_dump($data);
		// exit;

		$this->load->view('laporan_hasil_pemeriksaan',$data);
	}

	public function cetakJenisHasilPemeriksaan($ID_JENIS)
	{
		$data['data_jenis_hasil_nuklir']=$this->M_hasil_nuklir->getJenisHasilPemeriksaan($ID_JENIS);

		$this->load->view('laporan_jenis_hasil', $data);
	}

	public function simpanHasilPemeriksaan()
	{
		try {
			$idJenisPelayanan = $this->input->post('id_jenis_layanan');
			if (is_array($idJenisPelayanan)) {
				foreach ($idJenisPelayanan as $key => $idJenis) {
					$noMedrec = $this->input->post('no_medrec')[$key];
					$tglKunjungan = $this->input->post('tgl_kunjungan')[$key];
					
					$update = $this->M_hasil_nuklir->updatePemeriksaanNuk($idJenis, $noMedrec, $tglKunjungan, [
						'NM_HASIL' => $this->input->post('nm_hasil')[$key],
						'KADAR_HASIL' => $this->input->post('kadar_hasil')[$key],
						'JENIS_RF' => $this->input->post('jenis_rf')[$key],
						'DOSIS_RF' => $this->input->post('dosis_rf')[$key]
					]);
					
				}
			}

			return redirect('hasil_nuklir/cekHasilPemeriksaan/'. $noMedrec . '/' . $tglKunjungan . '/' .$dokter);
		} catch (Exception $e) {
			//gagal
			var_dump($e->getMessage());	
		}
	}

	public function cekHasilPemeriksaan($noMedrec, $tglKunjungan)
	{

		$pasien = $this->M_hasil_nuklir->cek_medrec($noMedrec);
		// var_dump($pasien);
		// die;
		$data['title'] = 'Kelola Nuklir';
		$data['subtitle'] = 'Form Hasil Pemeriksaan Kedokteran Nuklir';
		$data['header'] = 'header/header';
		$data['navbar'] = 'navbar/navbar';
		$data['sidebar'] = 'sidebar/sidebar';
		$data['footer'] = 'footer/footer';
		$data['body'] = 'v_form_hasil_pemeriksaan';
		$data['pasien'] = $pasien;
		$data['hasil'] = (strlen($noMedrec)==10) ? $this->M_hasil_nuklir->getHasilNuklirIRJ($tglKunjungan, $noMedrec) : $this->M_hasil_nuklir->getHasilNuklirIRI($tglKunjungan, $noMedrec);
		$data['tglKunjungan'] = $tglKunjungan;
	
		// var_dump($data);
		// die;
		$this->load->view('template', $data);
	}

	public function cetakHasilPemeriksaanNuk($NO_MEDREC, $tglKunjungan,$dokter)
	{
		$data['data_hasil_pemeriksaan']=$this->M_hasil_nuklir->getDetailHasilPemeriksaan($NO_MEDREC);
		$pasien = $this->M_hasil_nuklir->cek_medrec($NO_MEDREC);
		$data['pasien'] = $pasien;
		$data['hasil'] = (strlen($NO_MEDREC)==10) ? $this->M_hasil_nuklir->getHasilNuklirIRJ($tglKunjungan, $NO_MEDREC) : $this->M_hasil_nuklir->getHasilNuklirIRI($tglKunjungan, $NO_MEDREC);
		$data['tglKunjungan'] = $tglKunjungan;
		$data['ttd'] = $this->session->userdata('alias');
		
		// var_dump($pasien);
		// exit;

		$this->load->view('v_laporan_hasil_pemeriksaan',$data);
	}
}