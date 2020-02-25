<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin') {
            redirect('block');
        }
        $this->load->model('m_admin');
    }

    public function index()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_admin->getUser('users', $useremail);
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_admin', $data);
        $this->load->view('templates/admin_footer');
    }

    //Motorcycle Queue
    public function mcqueue()
    {
        $useremail      = $this->session->userdata('email');
        $statusQ        = 'Queue';
        $statusP        = 'Processed';
        $statusC        = 'Completed';
        $date           = date("Y-m-d");
        $data['title']  = 'Motorcycle Queue';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        $data['queue']  = $this->m_admin->getqueue('tbl_washing', $statusQ,$date);
        $data['processed']  = $this->m_admin->getprocess('tbl_washing', $statusP,$date);
        $data['completed']  = $this->m_admin->getcompleted('tbl_washing', $statusC,$date);
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_queue', $data);
        $this->load->view('templates/admin_footer');
    }
    //End Motorcycle Queue
    
    //Booking Form
    public function fmbooking()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Booking';
        $data['user'] = $this->m_admin->getUser('users', $useremail);
        $data['typemc'] = $this->m_admin->gettype();
        $data['codebooking'] = $this->m_admin->bkcode();
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $rules = array(
            array(
                    'field' => 'nm_consumer',
                    'label' => 'Consumer',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'contact',
                    'label' => 'Contact',
                    'rules' => 'required|trim|max_length[12]|integer',
                    'errors' => array(
                            'max_length' => 'Your number is too short',
                    ),
            ),
            array(
                    'field' => 'noplat',
                    'label' => 'Plat Number',
                    'rules' => 'required|trim|min_length[3]',
                    'errors' => array(
                        'is_unique' => 'This No Plat has already Booked up!'
                    ),
            ),
            array(
                    'field' => 'typemotor',
                    'label' => 'Type',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'radiotierpl',
                    'label' => 'Tier Polish',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'tot_cost',
                    'label' => 'Total Cost',
                    'rules' => 'required|trim'
            )
        );
        
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<small class="text-danger pl-3">','</small>');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header',$data);
            $this->load->view('templates/admin_sidebar',$data);
            $this->load->view('templates/admin_topbar',$data);
            $this->load->view('v_booking', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = [
                'nm_consumer' => htmlspecialchars($this->input->post('nm_consumer',true)),
                'contact' => htmlspecialchars($this->input->post('contact',true)),
                'code_booking' => htmlspecialchars($this->input->post('code_booking',true)),
                'noplat' => htmlspecialchars($this->input->post('noplat',true)),
                'tot_cost' => htmlspecialchars($this->input->post('tot_cost',true)),
                'status' => 'Queue',
                'cashier' => $this->session->userdata('name'),
                'ctime' => date("Y-m-d")
            ];
            $this->m_admin->insertBook('tbl_washing',$data);
            $this->session->set_flashdata('alert',success("<strong>Congratulation!</strong> Motorcycle is already in the queue."));
            redirect('admin/mcqueue');
        }
    }
    //End Booking Form

    //Order Management
    public function mngbooking()
    {
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Order Management';
        $data['user']   = $this->m_admin->getUser('users', $useremail);
        $data['chstatus'] = ['Queue','Processed','Completed'];

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_mgbooking', $data);
        $this->load->view('templates/admin_footer');
    }

    function get_order()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrder();
    }

    function update_order(){ //update record method
        $this->m_admin->updateOrder();
        redirect('admin/mngbooking');
    }

    function update_payment(){ //update payment record
        $this->m_admin->updatePayment();
        redirect('admin/mngbooking');
    }

    function delete_order(){ //delete record method
        $this->m_admin->deleteOrder();
        redirect('admin/mngbooking');
    }
    //End Order Management

    //Order Archive
    public function order_arc()
    {
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Order Archive';
        $data['user']   = $this->m_admin->getUser('users', $useremail);
        $data['chstatus'] = ['Queue','Processed','Completed'];

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_orderarc', $data);
        $this->load->view('templates/admin_footer');
    }

    public function get_orderarchive()
    {
        header('Content-Type: application/json');
        echo $this->m_admin->getOrderarchive();
    }

    public function data_report()
    {
        $useremail      = $this->session->userdata('email');
        $data['title']  = 'Data Report';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        $startDate  = htmlspecialchars($this->input->post('startDate',true));
        $endDate    = htmlspecialchars($this->input->post('endDate',true));

        $rules = array(
            array(
                    'field' => 'startDate',
                    'label' => 'Start Date',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'endDate',
                    'label' => 'End Date',
                    'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($rules);
        if($this->input->post() == false){
            $this->load->view('templates/admin_header',$data);
            $this->load->view('templates/admin_sidebar',$data);
            $this->load->view('templates/admin_topbar',$data);
            $this->load->view('v_report', $data);
            $this->load->view('templates/admin_footer');
        }else{
            $where = "ctime BETWEEN '$startDate' AND '$endDate'";
            $data['result'] = $this->m_admin->getReport($where);
            $data['date'] = $this->m_admin->getReportdate($where);
            $data['total'] = $this->m_admin->getTotal($where);
            $this->load->view('v_resultreport', $data);
        }
    }
}