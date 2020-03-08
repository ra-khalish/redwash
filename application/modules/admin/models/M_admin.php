<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model{
    public function getUser($table, $email)
    {
        return $this->db->get_where($table, ['user_email' => $email])->row_array();
    }

    public function getctqueue($statusQ, $date)
    {
        $where = "status='$statusQ' AND date(ctime)='$date'";
        $query = $this->db
            ->select('COUNT(`status`)as statusq')
            ->from('tbl_washing')
            ->where($where)
            ->get();
        return $query->row();
    }

    public function getctprocess($statusP, $date)
    {
        $where = "status='$statusP' AND date(ctime)='$date'";
        $query = $this->db
            ->select('COUNT(`status`)as statusp')
            ->from('tbl_washing')
            ->where($where)
            ->get();    
        return $query->row();
    }

    public function getmonthly($table,$date)
    {
        $where = "MONTH(ctime) = MONTH('$date')";
        $query = $this->db
            ->select('SUM(`tot_cost`)AS totMonth')
            ->from($table)
            ->where($where)
            ->get();    
        return $query->row();
    }

    public function getannual($table,$date)
    {
        $where = "YEAR(ctime) = YEAR('$date')";
        $query = $this->db
            ->select('SUM(`tot_cost`)AS totYear')
            ->from($table)
            ->where($where)
            ->get();    
        return $query->row();
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

    //generate dataTable serverside method for ordermanagement
    function getOrder() {
        $this->datatables->select('nm_consumer,contact,code_booking,noplat,pay,tot_cost,ch_cost,status');
        $this->datatables->from('tbl_washing');
        $this->datatables->where('date(ctime)',date("Y-m-d"));
        $this->datatables->add_column('view',
        '<a href="javascript:void(0);" class="edit_record border-0 btn-transition btn btn-outline-success btn-sm mb" 
        data-booking="$3" data-noplat="$4" data-status="$8"><i class="fas fa-edit"></i></a> 
        <a href="javascript:void(0);" class="pay_record border-0 btn-transition btn btn-outline-warning btn-sm mb" 
        data-booking="$3" data-noplat="$4" data-tot_cost="$6" data-pay="$5" data-ch_cost="$7"><i class="fas fa-money-check-alt"></i></a> 
        <a href="javascript:void(0);" class="delete_record border-0 btn-transition btn btn-outline-danger btn-sm mb" 
        data-booking="$3"><i class="fas fa-trash"></i></a>',
        'nm_consumer,contact,code_booking,noplat,pay,tot_cost,ch_cost,status');
        return $this->datatables->generate();
    }

    function getOrderarchive() {
        $this->datatables->select('nm_consumer,contact,code_booking,noplat,pay,tot_cost,ch_cost,status,cashier,ctime,etime');
        $this->datatables->from('tbl_washing');
        $this->datatables->add_column('view',
        '<a href="javascript:void(0);" class="pay_record border-0 btn-transition btn btn-outline-warning btn-sm mb" 
        data-booking="$3" data-noplat="$4" data-tot_cost="$6" data-pay="$5" data-ch_cost="$7"><i class="fas fa-money-check-alt"></i></a>
        <a href="javascript:void(0);" class="info_record border-0 btn-transition btn btn-outline-info btn-sm mb" data-nm_consumer="$1" data-contact="$2" 
        data-booking="$3" data-noplat="$4" data-pay="$5" data-tot_cost="$6" data-ch_cost="$7" data-status="$8"><i class="fas fa-info-circle"></i></a>
        <a href="javascript:void(0);" class="delete_record border-0 btn-transition btn btn-outline-danger btn-sm mb"
        data-booking="$3"><i class="fas fa-trash-alt"></i></a>',
        'nm_consumer,contact,code_booking,noplat,pay,tot_cost,ch_cost,status,cashier,ctime,etime');
        return $this->datatables->generate();
    }

    //update data method for ordermanagement
    function updateOrder(){
        $code_booking = $this->input->post('code_booking');
        $data = array(
            'status'        => $this->input->post('status'),
            'cashier'       => $this->session->userdata('name'),
            'etime'         => date("Y-m-d H:i:s")
        );
        $this->db->where('code_booking',$code_booking);
        $result = $this->db->update('tbl_washing', $data);
        $this->session->set_flashdata('alert',success("The status of the motorcycle has changed"));
        return $result;
    }

    //update data method for ordermanagement
    function updatePayment(){
        $code_booking = $this->input->post('code_booking');
        $data = array(
            'pay'       => $this->input->post('pay'),
            'ch_cost'   => $this->input->post('ch_cost'),
            'status'    => 'Paid',
            'cashier' => $this->session->userdata('name'),
            'etime'     => date("Y-m-d H:i:s")
        );
        $this->db->where('code_booking',$code_booking);
        $result = $this->db->update('tbl_washing', $data);
        $this->session->set_flashdata('alert',success("The order was paid successfully"));
        return $result;
    }

    //delete data method for ordermanagement
    function deleteOrder(){
        $code_booking = $this->input->post('code_booking');
        $this->db->where('code_booking',$code_booking);
        $result = $this->db->delete('tbl_washing');
        $this->session->set_flashdata('alert',warning("Motorcycle bookings have been deleted"));
        return $result;
    }

    //Report Model
    function getReport($where) {
        $query = $this
					->db
					->select('code_booking,noplat,pay,tot_cost,ch_cost,status,cashier,date(etime)as etime')
					->from('tbl_washing')
					->where($where)
					->get();

		if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

    function getReportdate($where)
    {
        $query = $this->db
            ->select('monthname(ctime)as month,YEAR(ctime)as year')
            ->distinct()
            ->from('tbl_washing')
            ->where($where)
            ->get();
            
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function getTotal($where)
    {
        $query = $this->db
            ->select('SUM(`tot_cost`)as tcost, COUNT(`id`)as tbook')
            ->from('tbl_washing')
            ->where($where)
            ->get();
            
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return NULL;
        }
    }
    //End Report Model

    public function editUser($table,$data,$useremail)
    {
        $this->db->set($data);
        $this->db->where('user_email',$useremail);
        $this->db->update($table);
    }
}