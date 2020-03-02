<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{
    
    public function getUser($table, $email)
    {
        return $this->db->get_where($table, ['user_email' => $email])->row_array();
    }

    public function getqueue($table, $statusQ, $date)
    {
        $where = "status='$statusQ' AND date(ctime)='$date'";
        return $this->db->get_where($table, $where)->result_array();
    }

    public function getprocess($table, $statusP,$date)
    {
        $where = "status='$statusP' AND date(ctime)='$date'";
        return $this->db->get_where($table, $where)->result_array();
    }

    public function getcompleted($table, $statusC,$date)
    {
        $where = "status='$statusC' AND date(ctime)='$date'";
        return $this->db->get_where($table, $where)->result_array();
    }

    public function gettype()
    {
        return $this->db->get('tbl_typemotor')->result();
    }

    public function bkcode()
    {
        $this->db->select('RIGHT(tbl_washing.code_booking,3) as cbook',FALSE);
        $this->db->order_by('code_booking','DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_washing'); //Check kode pada tabel
        if($query->num_rows() <> 0){
            //Jika kode nya sudah ada
            $data = $query->row();
            $cbook = intval($data->cbook) + 1;
        }else{
            //Jika kode belum ada
            $cbook = 1;
        }
        $cbookmax = str_pad($cbook, 3, "0", STR_PAD_LEFT); //Angka 3 menunjukkan jumlah digit angka 0
        $cdbook = "RWB-".$cbookmax; // Hasil RWB-001 dst.
        return $cdbook;
    }

    public function insertBook($table, $data) {
        $this->db->insert($table, $data);
    }
}