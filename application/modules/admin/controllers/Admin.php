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

    public function mcqueue()
    {
        $useremail      = $this->session->userdata('email');
        $statusQ        = 'Queue';
        $statusP        = 'Processed';
        $statusC        = 'Completed';
        $data['title']  = 'Motorcycle Queue';
        $data['user']   = $this->m_admin->getUser('users', $useremail);

        $data['queue']  = $this->m_admin->getqueue('tbl_washing', $statusQ);
        $data['processed']  = $this->m_admin->getqueue('tbl_washing', $statusP);
        $data['completed']  = $this->m_admin->getqueue('tbl_washing', $statusC);
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/admin_header',$data);
        $this->load->view('templates/admin_sidebar',$data);
        $this->load->view('templates/admin_topbar',$data);
        $this->load->view('v_queue', $data);
        $this->load->view('templates/admin_footer');
    }
    
    public function csbooking()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Booking Form';
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
                    'rules' => 'required|trim|min_length[5]|is_unique[tbl_washing.noplat]',
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
                'ctime' => time()
            ];
            $this->m_admin->insertBook('tbl_washing',$data);
            $this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulation!</strong> Your motorcycle is already in the queue.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/mcqueue');
        }
    }

}