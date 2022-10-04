<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_dashboard extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
         $this->db = $this->load->database('default',true);
    }
    public function get_data(){
    	$query="
			select 'Jabatan' as nama, count(*) as total, 'jabatan' link from jabatan
            union all
            select 'Bagian' as nama, count(*) as total, 'bagian' link from bagian
            union all
            select 'Jenis Pegawai' as nama, count(*) as total, 'jenis_pegawai' link from jenis_pegawai
            union all
            select 'Kualifikasi Pendidikan' as nama, count(*) as total, 'qualifikasi_pend' link from qualifikasi_pend
            union all
            select 'PPDS' as nama, count(*) as total, 'ppds' link  from ppds
    	";
    	return $this->db->query($query)->result();
    }

    public function get_data_dashboard(){
        $query="
            select 'User Web Nuklir' as nama,count(*) as total, 'User Login Nuklir' from nkl_user_login_nuklir
            union all
            select 'Dokter Nuklir' as nama,count(*) as total, 'Dokter Periksa Nuklir' from nkl_dokter_periksa_nuk
            union all
            select 'Jenis Hasil Nuklir' as nama, count(*) as total,'Jenis Hasil Nuklir' from nkl_jenis_hasil_nuk
            union all
            select 'User Nuklir' as nama,count(*) as total, 'User Login Nuklir' from nkl_user_login_nuklir where aktif='1'
            union all
            select 'Pemeriksaan Nuklir' as nama, count(*) as total, 'Pemeriksaan Nuklir' from nkl_pemeriksaan_nuk where tgl_kunjungan like '%-22'
        ";
        return $this->db->query($query)->result();
    }
}