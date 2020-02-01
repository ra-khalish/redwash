<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin') {
            redirect('auth/block');
        }
        
        $this->load->model('m_admin');


    }

    public function index()
    {
        $useremail = $this->session->userdata('email');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->m_admin->getUser('users', $useremail);
        
        //$this->db->get_where('users',['user_email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('v_admin', $data);
        $this->load->view('templates/footer');
    }

}