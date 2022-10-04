<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard_ird extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    function get_data(){
        $query=
        "select no_ird,namard,sexrd,xtglkunjrd from drd_pasien_ird where tglkunjrd like '%-22'
        ";
        return $this->db->query($query)->result();
    }
}