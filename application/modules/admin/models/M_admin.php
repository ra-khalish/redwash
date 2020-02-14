<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model{
    
    public function getUser($table, $email)
    {
        return $this->db->get_where($table, ['user_email' => $email])->row_array();
    }

    public function getqueue($table, $statusQ)
    {
        return $this->db->get_where($table, ['status' => $statusQ])->result_array();
    }

    public function getprocess($table, $statusP)
    {
        return $this->db->get_where($table, ['status' => $statusP])->result_array();
    }

    public function getcompleted($table, $statusC)
    {
        return $this->db->get_where($table, ['status' => $statusC])->result_array();
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

    //generate dataTable serverside method
    function getTransaction() {
        $this->datatables->select('nm_consumer,contact,code_booking,noplat,tot_cost,status,ctime');
        $this->datatables->from('tbl_washing');
        $this->datatables->where('ctime',date("Y-m-d"));
        $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info" data-consumer="$1" data-contact="$2" data-booking="$3" data-noplat="$4" data-cost="$5" data-status="$6" data-ctime="$7">Edit</a>  <a href="javascript:void(0);" class="delete_record btn btn-danger" data-booking="$3">Delete</a>','nm_consumer,contact,code_booking,noplat,tot_cost,status,ctime');
        return $this->datatables->generate();
    // $query = $this->db->get('tbl_washing');
    // return $query->result();
    }

    //update data method
    function updateTransaction(){
        $code_booking = $this->input->post('code_booking');
        $data = array(
            'code_booking'  => $this->input->post('code_booking'),
            'noplat'        => $this->input->post('noplat'),
            'status'        => $this->input->post('status')
        );
        $this->db->where('code_booking',$code_booking);
        $result = $this->db->update('tbl_washing', $data);
        return $result;
    }

    //delete data method
    function deleteTransaction(){
        $code_booking = $this->input->post('code_booking');
        $this->db->where('code_booking',$code_booking);
        $result = $this->db->delete('tbl_washing');
        return $result;
    }
}