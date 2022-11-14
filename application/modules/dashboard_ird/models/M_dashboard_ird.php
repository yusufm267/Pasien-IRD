<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard_ird extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    function get_data_backup(){
        $query=
        "select no_ird,namard,tglkunjrd,sexrd,xtglkunjrd from drd_pasien_ird where tglkunjrd is not null order by tglkunjrd desc fetch first 10000 rows only
        ";
        return $this->db->query($query)->result();
    }

    public function get_bulan()
    {
        return [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }

    function get_data($month, $year){
        $startDate = date("$year-$month-01");
        $endDate = date("$year-$month-t");
        
        $query="
        select a.no_ird,a.namard,a.cara_kunj,a.carabayarrd,a.jeniskunjrd,a.tglkunjrd,a.id_kontraktor,
        to_char(to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS'),'YYYY-MM-DD HH24:MI:SS') as kunjungan,
        to_char(to_date(a.xtglpjasa,'YYYYMMDDHH24MISS'),'YYYY-MM-DD HH24:MI:SS') as pembayaran,
        to_char(to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS'),'HH24:MI:SS') as waktu,
        to_char(to_date(a.xtglpjasa,'YYYYMMDDHH24MISS'),'HH24:MI:SS') as waktu_bayar,
        systimestamp-to_timestamp(a.xtglkunjrd,'YYYYMMDDHH24MISS') as timediff,
        b.nmkontraktor
        from pasien_ird a
        left join kontraktor b on a.id_kontraktor=b.id_kontraktor
        where a.tglkunjrd is not null and a.tglpjasa is null
        and (a.tglkunjrd >= TO_DATE('$startDate', 'YYYY-MM-DD') and a.tglkunjrd <= TO_DATE('$endDate', 'YYYY-MM-DD')) 
        order by a.tglkunjrd desc
        ";
        return $this->db->query($query)->result();
    }

    function get_count_durasi($month,$year){
        $startDate = date("$year-$month-01");
        $endDate = date("$year-$month-t");
        
        $query="
        select durasi, count(*) as jumlah
        from (select a.no_ird,a.namard,a.cara_kunj,a.carabayarrd,a.jeniskunjrd,a.tglkunjrd,a.tglpjasa,a.id_kontraktor,
            to_char(to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS'),'YYYY-MM-DD HH24:MI:SS') as kunjungan,
            systimestamp-to_timestamp(a.xtglkunjrd,'YYYYMMDDHH24MISS') as timediff,
            --case when to_char((systimestamp-to_timestamp(a.xtglkunjrd,'YYYYMMDDHH24MISS')),'HH24MISS') > 06
            trunc((sysdate - to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS')) * 24) as time_perhitungan,
            case when trunc((sysdate - to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS')) * 24) >= 6 then 'Lebih dari 6 Jam'
                else 'Kurang dari 6 Jam'
                end as durasi,
            b.nmkontraktor
            from pasien_ird a
            left join kontraktor b on a.id_kontraktor=b.id_kontraktor
            where a.tglkunjrd is not null and a.tglpjasa is null
            and (a.tglkunjrd >= TO_DATE('$startDate', 'YYYY-MM-DD') and a.tglkunjrd <= TO_DATE('$endDate', 'YYYY-MM-DD')) 
            order by a.tglkunjrd desc)
            group by durasi";
        return $this->db->query($query)->result();
    }

    function get_tahun(){
        $query=
        "select distinct extract(year from tglkunjrd) as tahun from pasien_ird where tglkunjrd is not null order by tahun desc
        ";
        return $this->db->query($query)->result();
    }

    // function get_data($month, $year){
    //     $startDate = date("$year-$month-01");
    //     $endDate = date("$year-$month-t");
        
    //     $query="
    //     select a.no_ird,a.namard,a.cara_kunj,a.carabayarrd,a.jeniskunjrd,a.tglkunjrd,a.id_kontraktor,
    //     to_char(to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS'),'YYYY-MM-DD HH24:MI:SS') as kunjungan,
    //     to_char(to_date(a.xtglpjasa,'YYYYMMDDHH24MISS'),'YYYY-MM-DD HH24:MI:SS') as pembayaran,
    //     to_char(to_date(a.xtglkunjrd,'YYYYMMDDHH24MISS'),'HH24:MI:SS') as waktu,
    //     to_char(to_date(a.xtglpjasa,'YYYYMMDDHH24MISS'),'HH24:MI:SS') as waktu_bayar,
    //     systimestamp-to_timestamp(a.xtglkunjrd,'YYYYMMDDHH24MISS') as timediff,
    //     b.nmkontraktor
    //     from pasien_ird a
    //     left join kontraktor b on a.id_kontraktor=b.id_kontraktor
    //     where a.tglkunjrd is not null and a.tglpjasa is null
    //     and (a.tglkunjrd >= TO_DATE('$startDate', 'YYYY-MM-DD') and a.tglkunjrd <= TO_DATE('$endDate', 'YYYY-MM-DD')) 
    //     order by a.tglkunjrd desc
    //     ";
    //     return $this->db->query($query)->result();
    // }
    
}